<?php

namespace App\Handlers;

use App\Interfaces\CreateChargeInput;
use App\Interfaces\CreateChargeResponse;
use App\Interfaces\PaymentHandlerInterface;
use Exception;

final class PaymentHandler
{
    protected array $handlers = [];

    /** add handler */
    public function attach(PaymentHandlerInterface $handler): void
    {
        $this->handlers[$handler->getMetaData()->code] = $handler;
    }

    /** remove handler */
    public function detach(PaymentHandlerInterface $handler): void
    {

        $key = array_search($handler, $this->handlers, true);
        if ($key) {
            unset($this->handlers[$key]);
        }
    }

    public function getWithdrawProviders(string $currencyCode): array
    {
        $holder = [];
        /**
         * @var \App\Interfaces\PaymentHandlerInterface
         */
        foreach ($this->handlers as $handler) {
            if ($handler->canWithdraw($currencyCode))
                $holder[] = $handler->getMetaData();
        }

        return $holder;
    }

    public function getWithdrawProvidersFullDetails(string $currencyCode): array
    {
        $holder = [];
        /**
         * @var \App\Interfaces\PaymentHandlerInterface
         */
        foreach ($this->handlers as $handler) {
            if ($handler->canWithdraw($currencyCode))
                $holder[] = [
                    'withdrawal_fields' => $handler->getWithdrawFields(),
                    'meta_data' => $handler->getMetaData(),
                    'withdrawal_instructions' => $handler->getWithdrawalInstructions()
                ];
        }

        return $holder;
    }

    public function getDepositProviders(string $currencyCode): array
    {
        $holder = [];
        /**
         * @var \App\Interfaces\PaymentHandlerInterface
         */
        foreach ($this->handlers as $handler) {
            if ($handler->canDeposit($currencyCode))
                $holder[] = $handler->getMetaData();
        }

        return $holder;
    }

    public function getDepositProvidersFullDetails(string $currencyCode): array
    {
        $holder = [];
        /**
         * @var \App\Interfaces\PaymentHandlerInterface
         */
        foreach ($this->handlers as $handler) {
            if ($handler->canDeposit($currencyCode))
                $holder[] = [
                    'deposit_fields' => $handler->getDepositFields(),
                    'meta_data' => $handler->getMetaData(),
                    'deposit_instructions' => $handler->getDepositInstructions()
                ];
        }

        return $holder;
    }

    public function getProvider(string $code): ?PaymentHandlerInterface
    {
        return $this->handlers[$code] ?? null;
    }

    public function getProviders(): array
    {
        $holder = [];
        /**
         * @var \App\Interfaces\PaymentHandlerInterface
         */
        foreach ($this->handlers as $handler) {
            $holder[] = $handler->getMetaData();
        }

        return $holder;
    }

    public function createCharge($handler, CreateChargeInput $params): CreateChargeResponse
    {

        if ($this->handlers[$handler] instanceof PaymentHandlerInterface) {
            /**
             * @var \App\Interfaces\PaymentHandlerInterface
             */
            $h = $this->handlers[$handler];
            return $h->createCharge($params);
        }

        throw new Exception("payment handler not found.");
    }


    public function getCharge()
    {
    }

    public function refund()
    {
    }
}

