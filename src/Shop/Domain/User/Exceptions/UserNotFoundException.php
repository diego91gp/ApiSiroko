<?php

namespace App\Shop\Domain\User\Exceptions;


use Exception;

class UserNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Usuario no encontrado');
    }


}