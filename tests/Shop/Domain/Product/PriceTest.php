<?php

namespace App\Tests\Shop\Domain\Product;

use App\Shop\Domain\Product\Exceptions\PriceExceptions;
use App\Shop\Domain\Product\Price;
use PHPUnit\Framework\TestCase;

class PriceTest extends TestCase
{
    private Price $sut;

    protected function setUp(): void
    {
        $this->sut = new Price(100, 'USD');
    }

    /**
     * @test
     * it_should_return_exception_when_no_valid_currency
     * @group price_vo
     * @throws PriceExceptions
     */
    public function itShouldReturnExceptionWhenNoValidCurrency()
    {
        $this->expectExceptionMessage(PriceExceptions::currencyError()->getMessage());
        $this->expectException(PriceExceptions::class);
        new Price(15.99, 'EUdfsR');

    }

    /**
     * @test
     * it_should_return_exception_when_no_valid_amount
     * @group price_vo
     * @throws PriceExceptions
     */
    public function itShouldReturnExceptionWhenNegativeAmount()
    {
        $this->expectExceptionMessage(PriceExceptions::negativeAmount()->getMessage());
        $this->expectException(PriceExceptions::class);
        new Price(-15.99, 'EUR');

    }

    /**
     * @test
     * it_should_return_proper_class
     * @group price_vo
     */
    public function itShouldReturnProperClass()
    {
        $this->assertInstanceOf(Price::class, $this->sut);
        $this->assertEquals(100, $this->sut->amount());
        $this->assertEquals('USD', $this->sut->currency());
    }

    /**
     * @test
     * it_should_exchange
     * @group price_vo
     */
    public function itShouldExchange()
    {
        $this->assertEquals(91, $this->sut->dollarExchange());

    }

    /**
     * @test
     * it_should_update_price
     * @group price_vo
     */
    public function itShouldUpdatePrice()
    {
        $newSut = $this->sut->updatePrice(currency: "EUR", amount: 50);
        $this->assertEquals(50, $newSut->amount());
        $this->assertEquals('EUR', $newSut->currency());

    }

}
