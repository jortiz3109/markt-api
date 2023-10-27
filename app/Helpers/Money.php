<?php

namespace App\Helpers;

use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\DecimalMoneyFormatter;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money as MoneyPHP;
use Money\Parser\DecimalMoneyParser;
use NumberFormatter;

class Money
{
    public static function decimal(int $amount, string $currency = 'COP'): string
    {
        $money = new MoneyPHP($amount, new Currency($currency));
        $currencies = new ISOCurrencies();
        $moneyFormatter = new DecimalMoneyFormatter($currencies);

        return $moneyFormatter->format($money);
    }

    public static function format(int $amount, string $currency = 'COP', string $locale = 'en_US'): string
    {
        $money = new MoneyPHP($amount, new Currency($currency));
        $currencies = new ISOCurrencies();

        $numberFormatter = new NumberFormatter($locale, NumberFormatter::CURRENCY);
        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);

        return $moneyFormatter->format($money);
    }

    public static function parse(string $amount, string $currency = 'COP'): int
    {
        $currencies = new ISOCurrencies();
        $moneyParser = new DecimalMoneyParser($currencies);
        $money = $moneyParser->parse($amount, new Currency($currency));

        return $money->getAmount();
    }
}
