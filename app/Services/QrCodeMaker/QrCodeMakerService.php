<?php

namespace App\Services\QrCodeMaker;

use App\Models\Deposit;

class QrCodeMakerService
{

    private static string $paymentQrCodeUrl = "https://www.bitcoinqrcodemaker.com/api/?style=%s&amount=%s&address=%s&fiat=%s";

    private static array $allowedCurrencies = [
        'BTC' => 'bitcoin',
        'ETH' => 'ethereum',
        'BCH' => 'bitcoincash',
        'LTC' => 'litecoin',
        'BSV' => 'bitcoinsv',
        'MONERO' => 'monero',
        'DOGE' => 'dogecoin',
        'ADA' => 'cardano',
    ];

    private static array $fiat = [
        'USD', 'EUR', 'JPY',
        'GBP', 'CAD', 'CHF',
        'KRW', 'INR', 'CNY'
    ];

    public static function generateQrCode(Deposit $deposit): string
    {
        if (!in_array($deposit->crypto_currency, array_keys(self::$allowedCurrencies))) {
            return "";
        }

        $url = sprintf(
            self::$paymentQrCodeUrl,
            self::$allowedCurrencies[$deposit->crypto_currency],
            $deposit->amount + $deposit->charges,
            $deposit->address,
            self::$fiat[0] // USD
        );

        return $url;
    }
}
