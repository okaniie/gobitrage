<?php

namespace App\Http\Controllers\Admin;

use App\Handlers\PaymentHandler;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Setting;
use Illuminate\Http\Request;

class ProcessingsController extends Controller
{
    public function index()
    {
        return view('pages.admin.processings.index', [
            'currencies' => Currency::select(['id', 'display_name', 'code', 'status'])
                ->orderBy('status', 'DESC')
                ->get()
                ->all()
        ]);
    }

    public function create()
    {
        return view('pages.admin.processings.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'display_name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:currencies,code',
            'status' => 'required|in:0,1',
            'deposit_from_balance' => 'required|in:0,1',
            'deposit_from_processor' => 'required|in:0,1',
            'deposit_processor' => 'nullable|string|max:255',
            'deposit_address' => 'nullable|string|max:255',
            'deposit_min' => 'nullable|numeric|min:0',
            'deposit_max' => 'nullable|numeric|min:0',
            'deposit_fees_percentage' => 'nullable|numeric|min:0',
            'deposit_fees_additional' => 'nullable|numeric|min:0',
            'deposit_fees_min' => 'nullable|numeric|min:0',
            'deposit_fees_max' => 'nullable|numeric|min:0',
            'withdrawal_processor' => 'nullable|string|max:255',
            'withdrawal_min' => 'nullable|numeric|min:0',
            'withdrawal_max' => 'nullable|numeric|min:0',
            'withdrawal_fees_percentage' => 'nullable|numeric|min:0',
            'withdrawal_fees_additional' => 'nullable|numeric|min:0',
            'withdrawal_fees_min' => 'nullable|numeric|min:0',
            'withdrawal_fees_max' => 'nullable|numeric|min:0',
            'auto_withdrawal' => 'required|in:0,1',
            'auto_withdrawal_min' => 'nullable|numeric|min:0',
            'auto_withdrawal_max' => 'nullable|numeric|min:0',
        ]);

        Currency::create($validated);

        return redirect()->route('admin.processings')->with('success', 'Processing record created successfully.');
    }

    public function view(PaymentHandler $payment, $id)
    {
        $currency = Currency::findOrFail($id);

        $deposit = $payment->getDepositProvidersFullDetails($currency->code);
        $withdrawal = $payment->getWithdrawProvidersFullDetails($currency->code);

        return view('pages.admin.processings.view', [
            'currency' => $currency,
            'withdrawal' => $withdrawal,
            'deposit' => $deposit
        ]);
    }

    public function update(Request $request, $id)
    {
        $currency = Currency::findOrFail($id);

        $submitted = $request->all();
        // general settings
        if (!empty($submitted['settings'])) {
            foreach ($submitted['settings'] as $key => $value) {
                Setting::set($key, $value);
            }
        }

        // fix deposit things
        if (empty($submitted['currency']['deposit_from_balance']))
            $submitted['currency']['deposit_from_balance'] = '0';

        if (empty($submitted['currency']['deposit_from_processor']))
            $submitted['currency']['deposit_from_processor'] = '0';

        // currency settings
        $currency->update($submitted['currency']);

        return back()->with('success', 'Record saved successfully.');
    }
}
