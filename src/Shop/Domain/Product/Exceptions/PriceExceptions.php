<?php

namespace App\Shop\Domain\Product\Exceptions;


use Exception;

class PriceExceptions extends Exception
{
    private function __construct(string $message)
    {
        parent::__construct($message);
    }

    public static function negativeAmount(): PriceExceptions
    {
        return new self('No se permiten precios negativos');
    }

    public static function currencyError(): PriceExceptions
    {
        return new self('Divisa no permitida');
    }


}