<?php

namespace App\Shop\Application\Query;

class ShowCartQuery
{
    public function __construct(private readonly int $userId)
    {
    }
    
    public function getUserId(): int
    {
        return $this->userId;
    }

}