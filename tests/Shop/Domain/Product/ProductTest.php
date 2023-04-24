<?php /** @noinspection ALL */

namespace App\Tests\Shop\Domain\Product;

use App\Shop\Domain\Product\Price;
use App\Shop\Domain\Product\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    private Product $sut;


    protected function setUp(): void
    {
        $priceMocked = $this->createConfiguredMock(Price::class, [
            'amount' => 50.0,
            'currency' => "EUR"
        ]);
        $this->sut = new Product("Bici", 150, $priceMocked);
    }

    /**
     * @return void
     * @test
     * it_should_return_proper_class
     * @group product_test
     */

    public function itShouldReturnProperClass()
    {
        $this->assertEquals("Bici", $this->sut->getName()
        );
        $this->assertEquals(50.0, $this->sut->amount());
        $this->assertEquals(150, $this->sut->getStock());
    }

    /**
     * @test
     * update_stock
     * @group product_test
     */
    public function updateStock()
    {
        $this->sut->setStock(80);
        $this->assertEquals(80, $this->sut->getStock());

    }

    /**
     * @test
     * update_name
     * @group product_test
     */
    public function updateName()
    {
        $this->sut->setName("Bicicleta");
        $this->assertEquals("Bicicleta", $this->sut->getName());

    }

    /**
     * @test
     * update_price
     * @group product_test
     */
    public function updatePrice()
    {
        $this->sut->updatePrice(400.50, "USD");
        $this->assertEquals(400.50, $this->sut->amount());

    }

    /**
     * @test
     * update_id
     * @group product_test
     */
    public function updateId()
    {
        $this->sut->setId(8);
        $this->assertEquals(8, $this->sut->getId());

    }

}
