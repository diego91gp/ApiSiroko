<?php

namespace App\Shop\Domain\Product\Exceptions;


use Exception;

class ProductNotFoundInDBException extends Exception
{
    public function __construct()
    {
        parent::__construct("Producto no encontrado en nuestra tienda");
    }


}