<?php

namespace App\Shop\Domain\User;

use App\Shop\Domain\User\Exceptions\EmailCreationException;

class EmailVO
{
    private string $email;

    /**
     * @throws EmailCreationException
     */
    public function __construct($email)
    {


        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new EmailCreationException();
        }
        $this->email = $email;

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