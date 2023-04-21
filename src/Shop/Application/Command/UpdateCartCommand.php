<?php

namespace App\Shop\Application\Command;

class UpdateCartCommand
{

    public function __construct(
        private readonly int $productId,
        private readonly int $userId,
        private readonly int $units
    )
    {
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
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
    public function getUnits(): int
    {
        return $this->units;
    }

}