<?php

namespace App\Shop\Application\Command;

class DeleteProductFromCartCommand
{


    public function __construct(private readonly int $userId, private readonly int $productId)
    {

    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

}