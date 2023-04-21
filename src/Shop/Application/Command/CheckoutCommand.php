<?php

namespace App\Shop\Application\Command;

class CheckoutCommand
{
    public function __construct(private readonly int $userId)
    {
    }
    
    public function getUserId(): int
    {
        return $this->userId;
    }

}