<?php

namespace App\Shop\Domain\User;

use App\Shop\Domain\User\Exceptions\PasswordCreationException;

class PassVO
{

    private string $validatePass = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/';

    /**
     * @throws PasswordCreationException
     */
    public function __construct(private readonly string $password)
    {
        if (!preg_match($this->validatePass, $password)) {
            throw new PasswordCreationException();
        }

    }

    public function value(): string
    {
        return $this->password;
    }

    /**
     * @throws PasswordCreationException
     */
    public static function updatePass(string $pass): self
    {
        return new self($pass);
    }


}