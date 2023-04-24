<?php

namespace App\Shop\Domain\User;


use App\Shop\Domain\User\Exceptions\EmailCreationException;
use App\Shop\Domain\User\Exceptions\PasswordCreationException;

class User
{

    private int $id;

    public function __construct(private string $name, private EmailVO $email, private PassVO $password)
    {
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;

    }

    public function getEmail(): EmailVO
    {
        return $this->email;
    }

    /**
     * @throws EmailCreationException
     */
    public function setEmail(string $email): void
    {
        $this->email = EmailVO::updateEmail($email);
    }

    public function getPassword(): PassVO
    {
        return $this->password;
    }

    /**
     * @throws PasswordCreationException
     */
    public function setPassword(string $password): void
    {
        $this->password = PassVO::updatePass($password);
    }

}