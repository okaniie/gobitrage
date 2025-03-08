<?php

namespace App\Services\PaymentServices;

use App\Interfaces\CheckStatusResponse;
use App\Interfaces\CreateChargeInput;
use App\Interfaces\CreateChargeResponse;
use App\Interfaces\CreateWithdrawalInput;
use App\Interfaces\CreateWithdrawalResponse;
use App\Interfaces\GetMetaResponse;
use App\Interfaces\PaymentHandlerInterface;
use App\Models\Setting;
use CoinpaymentsAPI;
use Exception;

class CoinpaymentsService implements PaymentHandlerInterface
{
    private string $code = "coinpayments";
    private string $displayName = "Coinpayments";
    private string $logo = "coinpayments.logo";
    private array $withdrawCurrencies = ['BTC', 'ETH', 'DOGE', 'LTC', 'USDT', 'BCH', 'BNB'];
    private array $depositCurrencies = ['BTC', 'ETH', 'DOGE', 'LTC', 'USDT', 'BCH', 'BNB'];
    private string $depositInstructions = "A very serious <br> mutliline description text and instruction.";
    private string $withdrawalInstructions = "A very serious <br> mutliline description text and instruction.";

    private CoinpaymentsAPI $apiClient;

    public function __construct()
    {
    }

    public function configureWithdraw(): void
    {
        try {
            $privateKey = Setting::get('WITHDRAW__COINPAYMENTS_API_PRIVATE_KEY');
            $publicKey = Setting::get('WITHDRAW__COINPAYMENTS_API_PUBLIC_KEY');
            $this->apiClient = new CoinpaymentsAPI($privateKey, $publicKey, 'json');
        } catch (Exception $e) {
            throw new \Error($e->getMessage());
        }
    }

    public function configureDeposit(): void
    {
        try {
            $privateKey = Setting::get('DEPOSIT__COINPAYMENTS_API_PRIVATE_KEY');
            $publicKey = Setting::get('DEPOSIT__COINPAYMENTS_API_PUBLIC_KEY');
            $this->apiClient = new CoinpaymentsAPI($privateKey, $publicKey, 'json');
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
        return $this->depositInstructions;
    }

    public function getWithdrawalInstructions(): string
    {
        return $this->withdrawalInstructions;
    }

    public function createCharge(CreateChargeInput $input): CreateChargeResponse
    {

        $this->configureDeposit();

        $ipnURL = "";
        try {

            $transaction_response = $this->apiClient
                ->CreateComplexTransaction(
                    $input->amount,
                    $_ENV['BASE_FIAT_CURRENCY'] ?? "USD",
                    $input->cryptoCurrency,
                    $input->email,
                    "",
                    "",
                    "",
                    "",
                    "",
                    $input->transactionId,
                    $ipnURL
                );
        } catch (Exception $e) {
            return new CreateChargeResponse(false, $e->getMessage());
        }

        if ($transaction_response['error'] == 'ok') {

            $address = $transaction_response['result']['address'];
            $generatedTransactionId = $transaction_response['result']['txn_id'];
            $statusLink = $transaction_response['result']['status_url'];
            $paymentLink = $transaction_response['result']['qrcode_url'];
            $amount = $transaction_response['result']['amount'];

            return new CreateChargeResponse(
                true,
                "",
                $statusLink,
                $paymentLink,
                $address,
                $amount,
                $generatedTransactionId
            );
        } else {
            // Something went wrong!
            return new CreateChargeResponse(false, $transaction_response['error']);
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
                'field_name' => 'WITHDRAW__COINPAYMENTS_API_PRIVATE_KEY',
                'display_name' => 'Private Key',
                'value' => Setting::get('WITHDRAW__COINPAYMENTS_API_PRIVATE_KEY')
            ],
            [
                'type' => 'text',
                'field_name' => 'WITHDRAW__COINPAYMENTS_API_SECRET_KEY',
                'display_name' => 'Secret Key',
                'value' => Setting::get('WITHDRAW__COINPAYMENTS_API_SECRET_KEY')
            ],
            [
                'type' => 'checkbox',
                'field_name' => 'WITHDRAW__COINPAYMENTS_PAY_FEES_FOR_USER',
                'display_name' => 'Pay Fees for User',
                'value' => Setting::get('WITHDRAW__COINPAYMENTS_PAY_FEES_FOR_USER')
            ],
        ];
    }

    public function getDepositFields(): array
    {
        return [
            [
                'type' => 'text',
                'field_name' => 'DEPOSIT__COINPAYMENTS_MERCHANT_ID',
                'display_name' => 'Merchant ID',
                'value' => Setting::get('DEPOSIT__COINPAYMENTS_MERCHANT_ID')
            ],
            [
                'type' => 'text',
                'field_name' => 'DEPOSIT__COINPAYMENTS_IPN_SECRET',
                'display_name' => 'IPN Secret',
                'value' => Setting::get('DEPOSIT__COINPAYMENTS_IPN_SECRET')
            ],
        ];
    }

    public function createWithdrawal(CreateWithdrawalInput $input): CreateWithdrawalResponse
    {
        return new CreateWithdrawalResponse();
    }

    public function getDepositIpn(): string
    {
        return route('ipn.callback.deposit', ['processor' => $this->getMetaData()->code]);
    }

    public function getWithdrawalIpn(): string
    {
        return route('ipn.callback.withdrawal', ['processor' => $this->getMetaData()->code]);
    }
}
