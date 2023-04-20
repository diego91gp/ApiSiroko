<?php

namespace App\Tests\Price;


use App\Shop\Domain\Exceptions\PriceExceptions;
use App\Shop\Domain\Product\Price;
use Exception;
use PHPUnit\Framework\TestCase;


class NoPermittedCurrencyTest extends TestCase
{
    /**
     *
     * @throws Exception
     */
    public function testNoPermittedCurrency()
    {
        $this->expectException(PriceExceptions::class);
        new Price(15.99, 'EUdfsR');

    }

}