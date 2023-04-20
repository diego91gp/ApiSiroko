<?php

namespace App\Shop\Domain\Exceptions;


use Exception;

class EmailCreationException extends Exception
{
    public function __construct()
    {
        parent::__construct("Formato de email no valido");
    }


}