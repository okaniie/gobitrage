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
            'addresses' => $addresses
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
        ]);

        $profile = $request->profile;
        $addresses = $request->address ?? [];

        if (empty($profile['password'])) {
            unset($profile['password']);
        }

        if (!empty($profile['password'])) {
            $profile['password'] = Hash::make($profile['password']);
        }

        // update user info
        $user = User::find($id);
        $user->update($profile);

        // update the wallets
        foreach ($addresses as $code => $address) {
            $wallet = Wallet::whereBelongsTo($user)
                ->where('currency_code', $code)->get()->first();

            if (!empty($wallet)) {
                $wallet->update(['deposit_address' => $address]);
            } else {
                $currency = Currency::where('code', $code)->get()->first();
                Wallet::create([
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'currency_id' => $currency->id,
                    'currency_code' => $currency->code,
                ]);
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
        // save the request
        $validated = $request->validated();

        $validated['token'] = Uuid::generate()->string;
        $validated['user_id'] = $id;


        $bonus = UserBonus::create($validated);

        // dispatch
        event(new AddBonusRequestEvent($bonus));

        // redirect
        return back()->with('success', 'Bonus confirmation link sent to admin email. Click on the link to confirm action. Link will expire in 10 minutes.');
    }

    public function bonusConfirm($token)
    {
        $bonus = UserBonus::where('token', $token)->where('status', 'pending')->get()->first();

        // 
        if (!$bonus || strtotime($bonus->created_at) < (time() - (10 * 60))) {
            if ($bonus) $bonus->update('status', 'cancelled');
            die("Link expired.");
        }

        $user = User::findOrFail($bonus->user_id);
        $currency = Currency::where('code', $bonus->currency_code)->get()->first();

        // check if bonus is to go as deposit
        if ($bonus->type == "invest" && !empty($bonus->plan_id)) {

            $plan = Plan::findOrFail($bonus->plan_id);
            Deposit::create([
                'user_id' => $user->id,
                'username' => $user->username,
                'plan_id' => $plan->id,
                'plan_title' => $plan->title,
                'transaction_id' => Uuid::generate()->string,
                'percentage' => $plan->percentage,
                'profit_frequency' => $plan->profit_frequency,
                'address' => "",
                'amount' => $bonus->amount,
                'charges' => 0,
                'crypto_currency' => $bonus->currency_code,
            ]);

            // check if you can pay referral commission on it
            if (!empty($bonus->pay_referral) && !empty(Setting::get('pay_referral'))) {
                Referral::payReferral($bonus->user_id, $bonus->amount, $plan->referral_percentage, $bonus->currency_code);
            }
        }

        if ($bonus->type == "balance") {
            $wallet = Wallet::where('user_id', $bonus->user_id)
                ->where('currency_code', $currency->code)
                ->get()->first();

            if ($wallet) {
                $wallet->increment('balance', $bonus->amount);
            } else {
                Wallet::create([
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'currency_code' => $currency->code,
                    'currency_id' => $currency->id,
                    'balance' => $bonus->amount,
                ]);
            }
        }

        // register transaction
        Transaction::create([
            'user_id' => $user->id,
            'username' => $user->username,
            'log_type' => 'bonus',
            'transaction_details' => "Bonus of " . $bonus->amount . " added",
            'transaction_id' => $bonus->token,
            'amount' => $bonus->amount,
            'crypto_currency' => $bonus->currency_code
        ]);

        $bonus->update(['status', 'completed']);

        // check if you can send notification 
        event(new AddBonusConfirmedEvent($bonus));

        echo "Bonus processed successfully.";
        return;
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
