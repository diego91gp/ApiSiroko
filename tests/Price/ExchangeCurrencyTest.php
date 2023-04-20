<?php

namespace App\Tests\Price;


use App\Shop\Domain\Product\Price;
use Exception;
use PHPUnit\Framework\TestCase;


class ExchangeCurrencyTest extends TestCase
{

    /**
     *
     * @throws Exception
     */
    public function testExchangePermittedCurrency()
    {
        $price = new Price(100, 'USD');
        $this->assertInstanceOf(Price::class, $price);
        $this->assertEquals(100 * 0.91, $price->getAmount());
        $this->assertEquals('EUR', $price->getCurrency());

    }

}