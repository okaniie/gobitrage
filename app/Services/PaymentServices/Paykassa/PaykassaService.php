<?php

namespace App\Services\PaymentServices\Paykassa;

use App\Interfaces\CheckStatusResponse;
use App\Interfaces\CreateChargeInput;
use App\Interfaces\CreateChargeResponse;
use App\Interfaces\CreateWithdrawalInput;
use App\Interfaces\CreateWithdrawalResponse;
use App\Interfaces\DepositIpnCallbackResponse;
use App\Interfaces\GetMetaResponse;
use App\Interfaces\PaymentHandlerInterface;
use App\Interfaces\WithdrawalIpnCallbackResponse;
use App\Models\Setting;
use Exception;
use Illuminate\Http\Request;

class PaykassaService implements PaymentHandlerInterface
{
    private string $code = "paykassa";
    private string $displayName = "Paykassa.pro";
    private string $logo = "paykassa.logo";
    private array $withdrawCurrencies = ['BTC', 'ETH', 'LTC', 'DOGE', 'DASH', 'BCH', 'ZEC', 'ETC', 'XRP', 'TRX', 'BNB', 'USDT'];
    private array $depositCurrencies = ['BTC', 'ETH', 'LTC', 'DOGE', 'DASH', 'BCH', 'ZEC', 'ETC', 'XRP', 'TRX', 'BNB', 'USDT'];
    private $convertEndpoint = "https://min-api.cryptocompare.com/data/price?fsym=%s&tsyms=%s";
    private array $systemId = [
        "BTC" => 11, // supported currencies BTC    
        "ETH" => 12, // supported currencies ETH    
        "LTC" => 14, // supported currencies LTC    
        "DOGE" => 15, // supported currencies DOGE    
        "DASH" => 16, // supported currencies DASH    
        "BCH" => 18, // supported currencies BCH    
        "ZEC" => 19, // supported currencies ZEC    
        "ETC" => 21, // supported currencies ETC    
        "XRP" => 22, // supported currencies XRP    
        "TRX" => 27, // supported currencies TRX    
        "XLM" => 28, // supported currencies XLM    
        "BNB" => 29, // supported currencies BNB    
        "USDT" => 30, // supported currencies TRON USDT
    ];

    private PayKassaSCI $depositClient;
    private PayKassaAPI $withdrawalClient;

    public function __construct()
    {
    }

    public function configureWithdraw(): void
    {
        try {
            $paykassa_api_id = Setting::get('WITHDRAW__PAYKASSA_API_ID');
            $paykassa_api_password = Setting::get('WITHDRAW__PAYKASSA_API_PASSWORD');

            $this->withdrawalClient = new PayKassaAPI($paykassa_api_id, $paykassa_api_password);
        } catch (Exception $e) {
            throw new \Error($e->getMessage());
        }
    }

    public function configureDeposit(): void
    {
        try {
            $paykassa_merchant_id = Setting::get('DEPOSIT__PAYKASSA_MERCHANT_ID');
            $paykassa_merchant_password = Setting::get('DEPOSIT__PAYKASSA_MERCHANT_PASSWORD');

            $this->depositClient = new PayKassaSCI($paykassa_merchant_id, $paykassa_merchant_password);
        } catch (Exception $e) {
            throw new \Error($e->getMessage());
        }
    }

    public function getMetaData(): GetMetaResponse
    {
        return new GetMetaResponse($this->code, $this->displayName, $this->logo);
    }

    public function getDepositInstructions(): string
    {
        // deposit instructions
        return '
        <div class="alert alert-warning">
        1. Login to your PayKassa.pro account - <a href="https://paykassa.pro/en/login/" target="blank">https://paykassa.pro/en/login/</a><br> 
        2. Enter your Profile page -&gt; <strong>"Merchants"</strong><br> 
        3. Click button <strong>"Add merchant"</strong><br> 
        4. Fill the form:<br>
        <strong>Title</strong> - any name (one string no spaces and special chars.)<br>
        <strong>Domain</strong> - your site URL without (http:// or https:// and slashes)<br> 
        <strong>The secret key(Merchant Password)</strong> - copy generated password or define a strong password and save it locally for further steps<br>
        <strong>URL notification</strong> - ' . route('ipn.callback.deposit', ['processor' => 'paykassa']) . '<br>
        <strong>URL successful payment</strong> - ' . route('page', ['page' => 'deposit-successful']) . '<br>
        <strong>URL unsuccessful payment</strong> - ' . route('page', ['page' => 'deposit-unsuccessful']) . '<br>
        <strong>URL of the transaction handler (optional)</strong> - ' . route('ipn.callback.deposit', ['processor' => 'paykassa']) . '<br>
        <strong>Shop description</strong> - any description of you site<br>
        5. Click button "Add merchant"<br>
        6. Save "Merchant ID" and "Merchant Password" on this page.<br>
        </div>
        ';
    }

    public function getWithdrawalInstructions(): string
    {
        // withdrawal instructions
        return '
        <div class="alert alert-warning">
        1. Login to your PayKassa.pro account - https://paykassa.pro/en/login/<br>
        2. Enter your Profile page -&gt; <strong>"API"</strong> https://paykassa.pro/en/user/api/<br> 
        3. Click <strong>"Create API"</strong><br>
        4. Fill the form:<br>
        <strong>Name API</strong> - any word<br>
        <strong>The secret key(API Password)</strong> - define a strong password and save it locally for futher steps<br>
        <strong>Description API</strong> - any description of you site<br>
        <strong>Available IP:</strong> set your server outgoing IP address (optional but recommended)<br>
        5. Click button <strong>"Create API"</strong><br>
        6. Save <strong>"API ID"</strong> and <strong>"API Password"</strong> on this page.<br>
        7. Save your <strong>"Merchant ID"</strong> too.
        </div>
        ';
    }

    public function createCharge(CreateChargeInput $input): CreateChargeResponse
    {

        $this->configureDeposit();

        // need to calculate amount outside
        $cryptoAmount = $this->fiatToCrypto($input->amount, $input->cryptoCurrency);

        $res = $this->depositClient
            ->sci_create_order_get_data(
                $cryptoAmount,    // required parameter the payment amount example: 1.0433
                $input->cryptoCurrency,  // mandatory parameter, currency, example: BTC
                $input->transactionId,  // mandatory parameter, the unique numeric identifier of the payment in your system, example: 150800
                $input->description,   // mandatory parameter, text commentary of payment example: service Order #150800
                $this->systemId[$input->cryptoCurrency] // a required parameter, for example: 12 - Ethereum
            );

        if ($res['error']) {        // $res['error'] - true if the error
            return new CreateChargeResponse(false, $res['message']);   // $res['message'] - the text of the error message
            // actions in case of an error
        } else {
            $invoice = $res['data']['invoice'];     // The operation number in the system Paykassa.pro
            $wallet = $res['data']['wallet'];       // Address for payment
            $amount = $res['data']['amount'];       // The amount to payment may change if the commission is transferred to the client
            $url = $res['data']['url'];             // The link to proceed for payment
            // $tag = $res['data']['tag'];             // Tag to indicate the translation to ripple


            return new CreateChargeResponse(
                true,
                "",
                $url,
                $url,
                $wallet,
                $amount,
                $invoice
            );
        }
    }

    public function checkStatus(string $transactionId): CheckStatusResponse
    {
        return new CheckStatusResponse();
    }

    public function refund()
    {
    }

    public function getWithdrawCurrencies(): array
    {
        return $this->withdrawCurrencies;
    }

    public function getDepositCurrencies(): array
    {
        return $this->depositCurrencies;
    }

    public function canWithdraw(string $currencyCode): bool
    {
        return in_array($currencyCode, $this->withdrawCurrencies);
    }

    public function canDeposit(string $currencyCode): bool
    {
        return in_array($currencyCode, $this->depositCurrencies);
    }

    public function canAutoWithdraw(): bool
    {
        return true;
    }

    public function getWithdrawFields(): array
    {
        return [
            [
                'type' => 'text',
                'field_name' => 'WITHDRAW__PAYKASSA_API_ID',
                'display_name' => 'API ID',
                'value' => Setting::get('WITHDRAW__PAYKASSA_API_ID')
            ],
            [
                'type' => 'text',
                'field_name' => 'WITHDRAW__PAYKASSA_API_PASSWORD',
                'display_name' => 'API Password',
                'value' => Setting::get('WITHDRAW__PAYKASSA_API_PASSWORD')
            ],
            [
                'type' => 'text',
                'field_name' => 'WITHDRAW__PAYKASSA_MERCHANT_ID',
                'display_name' => 'Merchant ID',
                'value' => Setting::get('WITHDRAW__PAYKASSA_MERCHANT_ID')
            ],
        ];
    }

    public function getDepositFields(): array
    {
        return [
            [
                'type' => 'text',
                'field_name' => 'DEPOSIT__PAYKASSA_MERCHANT_ID',
                'display_name' => 'Merchant ID',
                'value' => Setting::get('DEPOSIT__PAYKASSA_MERCHANT_ID')
            ],
            [
                'type' => 'text',
                'field_name' => 'DEPOSIT__PAYKASSA_MERCHANT_PASSWORD',
                'display_name' => 'Merchant Password',
                'value' => Setting::get('DEPOSIT__PAYKASSA_MERCHANT_PASSWORD')
            ],
        ];
    }

    public function createWithdrawal(CreateWithdrawalInput $input): CreateWithdrawalResponse
    {
        $this->configureWithdraw();
        $paykassa_merchant_id = Setting::get('WITHDRAW__PAYKASSA_MERCHANT_ID');

        $amount = $this->fiatToCrypto($input->amount, $input->cryptoCurrency);
        $paid_commission = '';
        $tag = '';
        $real_fee = true; // supported - BTC, LTC, DOGE, DASH, BSV, BCH, ZEC, ETH
        $priority = "high"; // low - slowly, medium - medium, high - quickly

        $res = $this->withdrawalClient->api_payment(
            $paykassa_merchant_id,  // required parameter merchant id from which you want to make a withdrawal
            $this->systemId[$input->cryptoCurrency],    // mandatory parameter, the id of the payment method
            $input->wallet,                // mandatory parameter, the number of wallet which sent the money
            (float)$amount,         // required parameter the payment amount, how much to send
            $input->cryptoCurrency,  // mandatory parameter, the currency of payment
            $input->description,               // mandatory parameter, review the payment, you can pass a null
            $paid_commission,       // an optional parameter that who pays the fee for transfer, shop or client
            $tag,                   // optional, the tag for payment, you can pass empty
            $real_fee,              // deprecated parameter, always set to true
            $priority               // optional parameter(default is medium), is used to set
            // priority inclusion in the unit along with a $real_fee === true
        );

        if ($res['error']) {        // $res['error'] - true if the error
            return new CreateWithdrawalResponse(false, $res['message']);   // $res['message'] - the text of the error message
            //actions in case of an error
        } else {
            //actions in case of success
            $trxId = $res['data']['transaction'];                 // transaction number of the payment, example 130236
            $trxHash = $res['data']['txid'];                               // txid 70d6dc6841782c6efd8deac4b44d9cc3338fda7af38043dd47d7cbad7e84d5dd , may be empty,
            // in this case, transaction information can be obtained using a universal link from the explorer_transaction_link field, see below
            $amount = $res['data']['amount'];                           // the amount of the payment, how much was written off from the balance of the merchant 0.42
            $cryptoAmount = $res['data']['amount_pay'];                   // the amount of the payment, as it is the user, example: 0.41
            $fiatAmount = $this->cryptoToFiat($cryptoAmount, $input->cryptoCurrency);

            $addressLink =
                $res["data"]["explorer_address_link"];          // A link to view information about the address
            $transactionLink =
                $res["data"]["explorer_transaction_link"];      // Link to view transaction information

            return new CreateWithdrawalResponse(
                true,
                "Successful",
                $trxId,
                $trxHash,
                $addressLink,
                $transactionLink,
                $input->amount,
                $cryptoAmount
            );
        }
    }

    public function getDepositIpn(): string
    {
        return route('ipn.callback.deposit', ['processor' => $this->getMetaData()->code]);
    }

    public function getWithdrawalIpn(): string
    {
        return route('ipn.callback.withdrawal', ['processor' => $this->getMetaData()->code]);
    }

    public function fiatToCrypto($amount, $cryptoCurrency)
    {
        $coin = strtolower($cryptoCurrency);

        $fetch = json_decode(file_get_contents(sprintf($this->convertEndpoint, $_ENV['BASE_FIAT_CURRENCY'] ?? "USD", $coin)), true);

        if (!empty($fetch["Response"])) throw new Exception("Selected currency not valid or supported.");

        $amount = $fetch[strtoupper($coin)] * $amount;

        return $amount;
    }

    public function cryptoToFiat($amount, $cryptoCurrency)
    {
        $coin = strtolower($cryptoCurrency);
        $fiat = $_ENV['BASE_FIAT_CURRENCY'] ?? "USD";
        $fetch = json_decode(file_get_contents(sprintf($this->convertEndpoint, $coin, $fiat)), true);
        if (!empty($fetch["Response"])) throw new Exception("Selected currency not valid or supported.");
        $amount = round($fetch[$fiat] * $amount, 2);
        return $amount;
    }

    public function handleDepositIpnCallback(Request $request): DepositIpnCallbackResponse
    {

        $this->configureDeposit();

        $res = $this->depositClient
            ->sci_confirm_transaction_notification($request->private_hash);

        if ($res['error']) {        // $res['error'] - true if the error
            return new DepositIpnCallbackResponse(false, $res['message']);     // $res['message'] - the text of the error message
            // actions in case of an error
        } else {
            // actions in case of success
            $generatedTransactionId = $res["data"]["transaction"];         // transaction number in the system paykassa: 2431548
            $transactionHash = $res["data"]["txid"];                       // A transaction in a cryptocurrency network, an example: 0xb97189db3555015c46f2805a43ed3d700a706b42fb9b00506fbe6d086416b602
            $transactionId = $res["data"]["order_id"];                     // unique numeric identifier of the payment in your system, example: 150800
            $cryptoAmount = (float)$res["data"]["amount"];            // received amount, example: 1.0000000
            $fee = (float)$res["data"]["fee"];                  // payment processing fee: 0.0000000
            $currency = $res["data"]["currency"];               // the currency of payment, for example: DASH

            $address_from = $res["data"]["address_from"];       // address of the payer's cryptocurrency wallet, example: 0x5d9fe07813a260857cf60639dac710ebb9531a20
            $address = $res["data"]["address"];                 // a cryptocurrency wallet address, for example: Xybb9RNvdMx8vq7z24srfr1FQCAFbFGWLg
            $tag = $res["data"]["tag"];                         // Tag for Ripple and Stellar is an integer
            $confirmations = $res["data"]["confirmations"];     // Current number of network confirmations
            $required_confirmations =
                $res["data"]["required_confirmations"];         // Required number of network confirmations for crediting
            $status = $res["data"]["status"];                   // yes - if the payment is credited
            $static = $res["data"]["static"];                   // Always yes
            $date_update = $res["data"]["date_update"];         // last updated information, example: "2018-07-23 16:03:08"

            $explorer_address_link =
                $res["data"]["explorer_address_link"];          // A link to view information about the address
            $explorer_transaction_link =
                $res["data"]["explorer_transaction_link"];      // Link to view transaction information

            $amount = $this->cryptoToFiat($cryptoAmount, $currency);

            if ($status !== 'yes') {
                //the payment has not been credited yet
                // your code...
                return new DepositIpnCallbackResponse(false, "Payment not confirmed yet.");
            } else {
                //the payment is credited
                return new DepositIpnCallbackResponse(
                    true,
                    "{$transactionId}|success",
                    $transactionId,
                    $generatedTransactionId,
                    $transactionHash,
                    $amount,
                    $cryptoAmount,
                    $currency,
                    [
                        'explorer_transaction_link' => $explorer_transaction_link,
                        'explorer_address_link' => $explorer_address_link,
                        'required_confirmations' => $required_confirmations,
                        'confirmations' => $confirmations,
                        'address' => $address,
                        'address_from' => $address_from,
                        'fee' => $fee,
                        'date_update' => $date_update
                    ],

                );
            }
        }
    }

    public function handleWithdrawalIpnCallback(Request $request): WithdrawalIpnCallbackResponse
    {
        return new WithdrawalIpnCallbackResponse();
    }
}
