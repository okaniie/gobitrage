<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface PaymentHandlerInterface
{
    public function getMetaData(): GetMetaResponse;

    public function getWithdrawCurrencies(): array;

    public function getDepositCurrencies(): array;

    public function getDepositInstructions(): string;

    public function getWithdrawalInstructions(): string;

    public function getDepositIpn(): string;

    public function getWithdrawalIpn(): string;

    public function canWithdraw(string $currencyCode): bool;

    public function canDeposit(string $currencyCode): bool;

    public function getWithdrawFields(): array;

    public function getDepositFields(): array;

    public function createCharge(CreateChargeInput $input): CreateChargeResponse;

    public function checkStatus(string $transactionId): CheckStatusResponse;

    public function refund();

    public function createWithdrawal(CreateWithdrawalInput $input): CreateWithdrawalResponse;

    public function handleDepositIpnCallback(Request $request): DepositIpnCallbackResponse;

    public function handleWithdrawalIpnCallback(Request $request): WithdrawalIpnCallbackResponse;
}

class CheckStatusResponse
{
    public bool $success;
    public string $message;
    public function __construct($success = false, $message = "")
    {
        $this->success = $success;
        $this->message = $message;
        return $this;
    }
}

class CreateChargeInput
{
    public string $amount;
    public string $cryptoCurrency;
    public string $transactionId;
    public string $email;
    public string $description;

    public function __construct(
        string $amount,
        string $cryptoCurrency,
        string $transactionId,
        string $email,
        string $description
    ) {
        $this->amount = $amount;
        $this->cryptoCurrency = $cryptoCurrency;
        $this->transactionId = $transactionId;
        $this->email = $email;
        $this->description = $description;
    }
}

class CreateChargeResponse
{
    public bool $success;
    public string $message;
    public string $statusLink;
    public string $paymentLink;
    public string $cryptoAddress;
    public string $cryptoAmount;
    public string $generatedTransactionId;

    public function __construct(
        bool $success = false,
        string $message = "",
        string $statusLink = "",
        string $paymentLink = "",
        string $cryptoAddress = "",
        string $cryptoAmount = "",
        string $generatedTransactionId = ""
    ) {

        $this->success = $success;
        $this->message = $message;
        $this->statusLink = $statusLink;
        $this->paymentLink = $paymentLink;
        $this->cryptoAddress = $cryptoAddress;
        $this->cryptoAmount = $cryptoAmount;
        $this->generatedTransactionId = $generatedTransactionId;

        return $this;
    }
}

class CreateWithdrawalInput
{
    public string $wallet;
    public string $amount;
    public string $cryptoCurrency;
    public string $description;
    public string $transactionId;
    public string $email;
    public string $withdrawalIpn;

    public function __construct(
        string $wallet,
        string $amount,
        string $cryptoCurrency,
        string $description,
        string $transactionId,
        string $email,
        string $withdrawalIpn
    ) {
        $this->wallet = $wallet;
        $this->amount = $amount;
        $this->cryptoCurrency = $cryptoCurrency;
        $this->description = $description;
        $this->transactionId = $transactionId;
        $this->email = $email;
        $this->withdrawalIpn = $withdrawalIpn;
    }
}

class CreateWithdrawalResponse
{
    public bool $success;
    public string $message;
    public string $transactionId;
    public string $transactionHash;
    public string $addressLink;
    public string $transactionLink;
    public string $amountPaid;
    public string $cryptoAmount;

    public function __construct(
        bool $success = false,
        string $message = "",
        string $transactionId = "",
        string $transactionHash = "",
        string $addressLink = "",
        string $transactionLink = "",
        int $amountPaid = 0,
        string $cryptoAmount = ""
    ) {

        $this->success = $success;
        $this->message = $message;
        $this->transactionId = $transactionId;
        $this->transactionHash = $transactionHash;
        $this->addressLink = $addressLink;
        $this->transactionLink = $transactionLink;
        $this->amountPaid = $amountPaid;
        $this->cryptoAmount = $cryptoAmount;

        return $this;
    }
}

class GetMetaResponse
{
    public string $code;
    public string $displayName;
    public string $logo;

    public function __construct(string $code, string $displayName, string $logo)
    {
        $this->code = $code;
        $this->displayName = $displayName;
        $this->logo = $logo;

        return $this;
    }
}

class DepositIpnCallbackResponse
{
    public bool $success;
    public string $message;
    public string $transactionId;
    public string $generatedTransactionId;
    public string $transactionHash;
    public string $amount;
    public string $cryptoAmount;
    public string $cryptoCurrency;
    public array $details;

    public function __construct(
        bool $success = false,
        string $message = "",
        string $transactionId = "",
        string $generatedTransactionId = "",
        string $transactionHash = "",
        float $amount = 0,
        float $cryptoAmount = 0,
        string $cryptoCurrency = "",
        array $details = []
    ) {

        $this->success = $success;
        $this->message = $message;
        $this->transactionId = $transactionId;
        $this->generatedTransactionId = $generatedTransactionId;
        $this->transactionHash = $transactionHash;
        $this->amount = $amount;
        $this->cryptoAmount = $cryptoAmount;
        $this->cryptoCurrency = $cryptoCurrency;
        $this->details = $details;

        return $this;
    }
}

class WithdrawalIpnCallbackResponse
{
    public bool $success;
    public string $message;
    public string $transactionId;
    public string $transactionHash;
    public string $addressLink;
    public string $transactionLink;
    public string $amountPaid;

    public function __construct(
        bool $success = false,
        string $message = "",
        string $transactionId = "",
        string $transactionHash = "",
        string $addressLink = "",
        string $transactionLink = "",
        int $amountPaid = 0
    ) {

        $this->success = $success;
        $this->message = $message;
        $this->transactionId = $transactionId;
        $this->transactionHash = $transactionHash;
        $this->addressLink = $addressLink;
        $this->transactionLink = $transactionLink;
        $this->amountPaid = $amountPaid;

        return $this;
    }
}
