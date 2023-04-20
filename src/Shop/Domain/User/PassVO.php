<?php

namespace App\Shop\Domain\User;

use App\Shop\Domain\Exceptions\PasswordCreationException;

class PassVO
{
    private string $password;
    private string $validatePass = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';


    /**
     * @throws PasswordCreationException
     */
    public function __construct($password)
    {
        $this->password = $password;

        if (!preg_match($this->validatePass, $password)) {
            throw new PasswordCreationException();
        }

    }

    public function value(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

}