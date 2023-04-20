<?php

namespace App\Shop\Domain\User;


use App\Shop\Domain\Cart\Cart;

class User
{

    private int $id;

    private string $name;

    private EmailVO $email;

    private PassVO $password;

    public function __construct(string $name, EmailVO $email, PassVO $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): EmailVO
    {
        return $this->email;
    }

    public function setEmail(EmailVO $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): PassVO
    {
        return $this->password;
    }

    public function setPassword(PassVO $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getOrCreateCart(): Cart
    {


    }
}
