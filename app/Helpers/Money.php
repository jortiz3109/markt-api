<?php

namespace App\Helpers;

use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money as MoneyPHP;
use NumberFormatter;

class Money
{
    public static function format(
        int    $amount,
        string $currency = 'COP',
        string $locale = 'en_US'): string
    {
        $money = new MoneyPHP($amount, new Currency($currency));
        $currencies = new ISOCurrencies();

        $numberFormatter = new NumberFormatter($locale, NumberFormatter::CURRENCY);
        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);

        return $moneyFormatter->format($money);
    }
}
