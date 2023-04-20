<?php

namespace App\Shop\Domain\Exceptions;


use Exception;

class PasswordCreationException extends Exception
{
    public function __construct()
    {
        parent::__construct("Formato de contraseña incorrecto , al menos 1 numero, 1 mayuscula, 1 minuscula y 8 caracteres");
    }


}