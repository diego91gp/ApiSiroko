<?php

namespace App\Shop\Application\Query;

class FindUserQuery
{

    public function __construct(private readonly int $productId,
                                private readonly int $units,
                                private readonly int $userID)
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
    public function getUnits(): int
    {
        return $this->units;
    }

    /**
     * @return int
     */
    public function getUserID(): int
    {
        return $this->userID;
    }
}