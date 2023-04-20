<?php

namespace App\Shop\Domain\Product;

use App\Shop\Domain\Exceptions\PriceExceptions;


class Price
{

    private const CURRENCY_AVAILABLE = ['EUR', 'USD'];

    private float $amount;
    private string $currency;

    /**
     * @return float
     */


    /**
     * @throws PriceExceptions
     */
    public function __construct($amount, $currency)
    {
        if (!in_array($currency, self::CURRENCY_AVAILABLE)) {
            throw  PriceExceptions::currencyError();
        }
        $this->currency = 'EUR';
        $this->amount = $this->currencyExchange($currency, $amount);

    }

    /**
     * @throws PriceExceptions
     */
    public function currencyExchange(string $currency, float $amount): float
    {
        if ($amount < 0) {
            throw  PriceExceptions::negativeAmount();
        }
        if ($currency = 'USD') {
            return $this->dollarExchange($amount);
        }
        return $amount;
    }

    public function dollarExchange(float $amount): float
    {
        return $amount * 0.91;
    }

    /**
     * @return float
     */
    public function amount(): float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function currency(): string
    {
        return $this->currency;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }


}