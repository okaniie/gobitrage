<?php

namespace App\Http\Controllers\Admin;

use App\Events\AddBonusConfirmedEvent;
use App\Events\AddBonusRequestEvent;
use App\Events\AddPenaltyConfirmedEvent;
use App\Events\AddPenaltyRequestEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\AddBonusRequest;
use App\Http\Requests\Admin\Users\AddPenaltyRequest;
use App\Http\Requests\Admin\Users\CreateUserRequest;
use App\Http\Requests\Admin\Users\UpdateUserRequest;
use App\Mail\UserEmail;
use App\Models\Currency;
use App\Models\Deposit;
use App\Models\EmailTemplate;
use App\Models\Plan;
use App\Models\Referral;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserBonus;
use App\Models\UserPenalty;
use App\Models\Wallet;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Webpatser\Uuid\Uuid;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->where('user_type', 'user')
            ->where(function ($handler) {
                if (request()->has('query'))
                    $handler->where('name', 'LIKE', '%' . request()->get('query') . '%')
                        ->orWhere('username', 'LIKE', '%' . request()->get('query') . '%')
                        ->orWhere('email', 'LIKE', '%' . request()->get('query') . '%');
            })
            ->orderByDesc('created_at')
            ->cursorPaginate(request()->get('rpp', 20));

        return view('pages.admin.users.index', ['users' => $users]);
    }

    public function store()
    {
        return view('pages.admin.users.new');
    }

    public function create(CreateUserRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        $validated['email_verified_at'] = now();

        User::create($validated);

        return back()->with('success', "User created successfully");
    }

    public function viewSingle($id)
    {
        $user = User::findOrFail($id);

        $addresses = [];
        $currencies = Currency::where('status', '1')->get()->all();
        $wallets = $user->wallets()->get();

        foreach ($currencies as $currency) {

            $address = new \stdClass;

            $address->currency_code = $currency->code;
            $address->deposit_address = "";

            $wallet = Wallet::whereBelongsTo($user)
                ->where('currency_id', $currency->id)->get()->first();

            if ($wallet) $address->deposit_address = $wallet->deposit_address;

            $addresses[] = $address;
        }

        return view('pages.admin.users.edit', [
            'user' => $user,
            'addresses' => $addresses,
            'wallets' => $wallets,

        ]);
    }

    public function userFunds($id)
    {

        $total_balance =
            $total_deposit =
            $active_deposit =
            $total_earning =
            $total_withdrawal =
            $pending_withdrawal =
            $total_bonus =
            $total_penalty =
            $total_referral =
            $referral_commission = 0;

        $user = User::find($id);

        // total_balance
        $total_balance = Wallet::whereBelongsTo($user)
            ->sum('balance');

        // deposits
        $d = Deposit::whereBelongsTo($user)
            ->where('status', 'approved')
            ->select(['status as status'])
            ->selectRaw('SUM(amount) as amount')
            ->groupBy('status')
            ->orderBy('status')->get()->first();

        $active_deposit = $d ? $d->amount : 0;

        // withdrawals
        $w = Withdrawal::whereBelongsTo($user)
            ->where('status', 'pending')
            ->select(['status as status'])
            ->selectRaw('SUM(amount) as amount')
            ->groupBy('status')
            ->orderBy('status')->get()->first();

        $pending_withdrawal = $w ? $w->amount : 0;

        // referrals
        $r = Referral::whereBelongsTo($user)
            ->select(['referral_user_id'])
            ->selectRaw('COUNT(*) as total, SUM(referral_bonus) as amount')
            ->groupBy('referral_user_id')
            ->orderBy('referral_user_id')->get()->first();

        if ($r) {
            $total_referral = $r->total;
            $referral_commission = $r->amount;
        }

        // transactions
        $d = Transaction::whereBelongsTo($user)
            ->select(['log_type as type'])
            ->selectRaw('SUM(amount) as amount')
            ->groupBy('type')
            ->orderBy('type')->get()->all();

        foreach ($d as $dd) {
            if ($dd->type == 'bonus') $total_bonus = $dd->amount;
            if ($dd->type == 'deposit') $total_deposit = $dd->amount;
            if ($dd->type == 'withdrawal') $total_withdrawal = $dd->amount;
            if ($dd->type == 'penalty') $total_penalty = $dd->amount;
            if ($dd->type == 'referral') $total_referral = $dd->amount;
            if ($dd->type == 'deposit-earning') $total_earning = $dd->amount;
        }

        $wallets = Wallet::whereBelongsTo($user)
            ->select(['currency_code', 'balance', 'deposit_address'])
            ->get()->all();

        // get upline
        $ref = $user->upliner;

        return view('pages.admin.users.profile', [
            'total_balance' => $total_balance,
            'total_deposit' => $total_deposit,
            'active_deposit' => $active_deposit,
            'total_earning' => $total_earning,
            'total_withdrawal' => $total_withdrawal,
            'pending_withdrawal' => $pending_withdrawal,
            'total_bonus' => $total_bonus,
            'total_penalty' => $total_penalty,
            'total_referral' => $total_referral,
            'referral_commission' => $referral_commission,
            'user' => $user,
            'wallets' => $wallets
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'profile.name' => 'required',
            'profile.username' => ['required', 'string', 'max:255', 'unique:users,username,' . $id],
            'profile.email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'profile.secret_question' => 'nullable|string',
            'profile.secret_answer' => 'nullable|string',
            'profile.auto_withdrawal' => 'required',
            'profile.status' => 'required',
            'address' => 'array',
            'address.*' => 'nullable|string|min:26|max:100',
            'wallets' => 'array',
            'wallets.*.balance' => 'required|numeric|min:0',
        ]);

        $profile = $request->profile;
        $addresses = $request->address ?? [];


        if (empty($profile['password'])) {
            unset($profile['password']);
        }

        if (!empty($profile['password'])) {
            $profile['password'] = Hash::make($profile['password']);
        }
         $user = User::find($id);

        // update user profile
        foreach ($addresses as $currencyCode => $depositAddress) {
    $currency = Currency::where('code', $currencyCode)->first();

    if (!$currency) continue;

    $wallet = Wallet::where('user_id', $user->id)
        ->where('currency_code', $currencyCode)
        ->first();

    if ($wallet) {
        $wallet->update(['deposit_address' => $depositAddress]);
    } else {
        Wallet::create([
            'user_id' => $user->id,
            'username' => $user->username,
            'currency_id' => $currency->id,
            'currency_code' => $currencyCode,
            'balance' => 0,
            'deposit_address' => $depositAddress,
        ]);
    }
}

        // update user info
        $user = User::find($id);
        $user->update($profile);

       if ($request->has('wallets')) {
    foreach ($request->wallets as $currencyCode => $walletData) {
        $currency = Currency::where('code', $currencyCode)->first();

        if (!$currency) continue;

        $wallet = Wallet::where('user_id', $user->id)
            ->where('currency_code', $currencyCode)
            ->first();

        if ($wallet) {
            $wallet->update(['balance' => $walletData['balance']]);
        } else {
            Wallet::create([
                'user_id' => $user->id,
                'username' => $user->username,
                'currency_id' => $currency->id,
                'currency_code' => $currency->code,
                'balance' => $walletData['balance'],
                'deposit_address' => '', // or null if preferred
            ]);
        }
    }
    }

        return back()->with('success', "User saved successfully");
    }

    public function delete($id)
    {
        $user = User::find($id);

        Wallet::whereBelongsTo($user)->delete();
        Deposit::whereBelongsTo($user)->delete();
        Withdrawal::whereBelongsTo($user)->delete();
        Transaction::whereBelongsTo($user)->delete();

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }

    public function addBonusView($id)
    {
        $user = User::findOrFail($id);
        return view('pages.admin.users.add-bonus', [
            'user' => $user,
            'plans' => Plan::all(),
            'currencies' => Currency::where('status', '1')->get()->all()
        ]);
    }

  public function addBonusAction(AddBonusRequest $request, $id)
    {
        // 1. Validate the incoming request data
        $validated = $request->validated();

        // 2. Prepare bonus data for immediate creation and completion
        $validated['user_id'] = $id;
        $validated['status'] = 'completed'; // Set status to 'completed' immediately
        // Set 'token' to null as it's no longer used for confirmation.
        // IMPORTANT: Ensure the 'token' column in your 'user_bonuses' table is nullable.
        $validated['token'] = null;

        // 3. Create the UserBonus record in the database
        // This record now directly reflects a completed bonus.
        $bonus = UserBonus::create($validated);

        // 4. Retrieve necessary related models for applying the bonus
        // Use findOrFail to automatically throw a 404 if the user is not found
        $user = User::findOrFail($id);
        // Find the currency details based on the bonus's currency code
        $currency = Currency::where('code', $bonus->currency_code)->first();

        // 5. Apply the bonus based on its type ('invest' or 'balance')
        // Check if the bonus type is 'invest' and a plan ID is provided
        if ($bonus->type == "invest" && !empty($bonus->plan_id)) {
            // Retrieve the investment plan details
            $plan = Plan::findOrFail($bonus->plan_id);

            // Create a new deposit record for the user based on the bonus
            Deposit::create([
                'user_id' => $user->id,
                'username' => $user->username,
                'plan_id' => $plan->id,
                'plan_title' => $plan->title,
                'transaction_id' => Uuid::generate()->string, // Generate a unique transaction ID for the deposit
                'percentage' => $plan->percentage,
                'profit_frequency' => $plan->profit_frequency,
                'address' => "", // Assuming 'address' is not relevant for bonus-based deposits
                'amount' => $bonus->amount,
                'charges' => 0, // Assuming no charges for bonus deposits
                'crypto_currency' => $bonus->currency_code,
            ]);

            // Check if referral commission should be paid for this bonus/deposit
            // Ensure 'pay_referral' is a property on the bonus or a relevant setting
            if (!empty($bonus->pay_referral) && Setting::get('pay_referral')) {
                // Call the static method to pay referral commissions
                Referral::payReferral($bonus->user_id, $bonus->amount, $plan->referral_percentage, $bonus->currency_code);
            }
        }

        // Check if the bonus type is 'balance'
        if ($bonus->type == "balance") {
            // Find the user's wallet for the specific currency
            $wallet = Wallet::where('user_id', $bonus->user_id)
                ->where('currency_code', $currency->code)
                ->first();

            if ($wallet) {
                // If the wallet exists, increment its balance by the bonus amount
                $wallet->increment('balance', $bonus->amount);
            } else {
                // If no wallet exists for this currency, create a new one for the user
                Wallet::create([
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'currency_code' => $currency->code,
                    'currency_id' => $currency->id,
                    'balance' => $bonus->amount, // Initialize with the bonus amount
                ]);
            }
        }

        // 6. Register the bonus as a transaction in the system's transaction log
        Transaction::create([
            'user_id' => $user->id,
            'username' => $user->username,
            'log_type' => 'bonus', // Indicate that this is a bonus transaction
            'transaction_details' => "Bonus of " . $bonus->amount . " " . $bonus->currency_code . " added",
            'transaction_id' => Uuid::generate()->string, // Generate a unique ID for this specific transaction log entry
            'amount' => $bonus->amount,
            'crypto_currency' => $bonus->currency_code
        ]);

        // 7. Redirect the user back to the previous page with a success message
        // This provides immediate feedback that the bonus has been processed.
        return back()->with('success', 'Bonus added and applied to user balance immediately!');
    }

    public function addPenaltyView($id)
    {
        $user = User::findOrFail($id);
        return view('pages.admin.users.add-penalty', [
            'user' => $user,
            'wallets' => Wallet::whereBelongsTo($user)->get()->all(),
        ]);
    }

    public function addPenaltyAction(AddPenaltyRequest $request, $id)
    {
        // save the request
        $validated = $request->validated();

        $validated['token'] = Uuid::generate()->string;
        $validated['user_id'] = $id;

        $penalty = UserPenalty::create($validated);

        // dispatch
        event(new AddPenaltyRequestEvent($penalty));

        return back()->with('success', 'Penalty confirmation link sent to admin email. Click on the link to confirm action. Link will expire in 10 minutes.');
    }

    public function penaltyConfirm($token)
    {

        $penalty = UserPenalty::where('token', $token)->where('status', 'pending')->get()->first();

        // 
        if (!$penalty || strtotime($penalty->created_at) < (time() - (10 * 60))) {
            if ($penalty) $penalty->update('status', 'cancelled');
            die("Link expired.");
        }

        $user = User::findOrFail($penalty->user_id);
        $wallet = Wallet::whereBelongsTo($user)->where('currency_code', $penalty->currency_code)->get()->first();
        $wallet->decrement('balance', $penalty->amount);

        // register transaction
        Transaction::create([
            'user_id' => $user->id,
            'username' => $user->username,
            'log_type' => 'penalty',
            'transaction_details' => "Penalty of " . $penalty->amount . " subtracted",
            'transaction_id' => $penalty->token,
            'amount' => $penalty->amount,
            'crypto_currency' => ''
        ]);

        $penalty->update(['status', 'completed']);

        // check if you can send notification 
        event(new AddPenaltyConfirmedEvent($penalty));

        echo "Penalty processed successfully.";
        return;
    }

    public function blockUser()
    {
    }
}
