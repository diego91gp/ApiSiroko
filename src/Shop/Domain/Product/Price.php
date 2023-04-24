<?php

namespace App\Shop\Domain\Product;

use App\Shop\Domain\Product\Exceptions\PriceExceptions;


class Price
{

    private const CURRENCY_AVAILABLE = ['EUR', 'USD'];


    /**
     * @throws PriceExceptions
     */
    public function __construct(private readonly float $amount, private readonly string $currency)
    {
        if (!in_array($currency, self::CURRENCY_AVAILABLE)) {
            throw  PriceExceptions::currencyError();
        }
        if ($amount < 0) {
            throw  PriceExceptions::negativeAmount();
        }

    }


    public function dollarExchange(): float
    {
        return $this->amount * 0.91;
    }

    public function amount(): float
    {
        return $this->amount;
    }

    public function currency(): string
    {
        return $this->currency;
    }

    public static function updatePrice($amount, $currency): self
    {
        return new self($amount, $currency);

    }


}