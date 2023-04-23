<?php

namespace App\Shop\Domain\Cart\Exceptions;

use Exception;

class CartExceptions extends Exception
{
    private function __construct(string $message)
    {
        parent::__construct($message);
    }

    public static function cartNotFound(): CartExceptions
    {
        return new self('Carrito no encontrado');
    }

    public static function productNotFound(): CartExceptions
    {
        return new self('No se ha encontrado ese producto en su carrito');
    }


    public static function deleteItemError(): CartExceptions
    {
        return new self('Error al borrar el producto del carrito');
    }
}