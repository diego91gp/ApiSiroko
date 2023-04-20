<?php

namespace App\Tests\Price;

use App\Shop\Domain\Exceptions\PriceExceptions;
use App\Shop\Domain\Product\Price;
use PHPUnit\Framework\TestCase;

class NegativeAmountPriceTest extends TestCase
{


    public function testNegativeAmount()
    {
        $this->expectException(PriceExceptions::class);
        new Price(-8, "EUR");
    }

}
