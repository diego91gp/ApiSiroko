<?php

namespace App\Shop\Domain\User;

use App\Shop\Domain\User\Exceptions\EmailCreationException;

class EmailVO
{
    /**
     * @throws EmailCreationException
     */
    public function __construct(private readonly string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new EmailCreationException();
        }
    }

    public function value(): string
    {
        return $this->email;
    }

    /**
     * @throws EmailCreationException
     */
    public static function updateEmail(string $email): self
    {
        return new self($email);
    }
}