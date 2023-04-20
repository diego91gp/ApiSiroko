<?php

namespace App\Shop\Domain\Exceptions;

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
        return new self('Producto no encontrado');
    }

    public static function negativeUnits(): CartExceptions
    {
        return new self('No se permiten unidades negativas');
    }

    public static function userNotFound(): CartExceptions
    {
        return new self('Usuario no encontrado');
    }

    public static function deleteItemError(): CartExceptions
    {
        return new self('Error al borrar el producto');
    }
}