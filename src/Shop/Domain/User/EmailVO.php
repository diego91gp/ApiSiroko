<?php

namespace App\Shop\Domain\User;

use App\Shop\Domain\Exceptions\EmailCreationException;

class EmailVO
{
    private string $email;

    /**
     * @throws EmailCreationException
     */
    public function __construct($email)
    {
        $this->email = $email;

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new EmailCreationException();
        }

    }

    public function value(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

}