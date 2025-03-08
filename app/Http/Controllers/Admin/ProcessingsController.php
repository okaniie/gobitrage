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
