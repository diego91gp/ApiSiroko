<?php

namespace App\Shop\Application\Command;

class AddProductToCartCommand
{
    public function __construct(private readonly int $productId, private readonly int $units
        , private readonly int                       $userID
    )
    {
    }

    /**
     * @return int
     */
    public function getUserID(): int
    {
        return $this->userID;
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
    public function getUnits(): int
    {
        return $this->units;
    }
//DTO
}