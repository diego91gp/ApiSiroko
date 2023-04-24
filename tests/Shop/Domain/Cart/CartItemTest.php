<?php /** @noinspection ALL */

namespace App\Tests\Shop\Domain\Cart;

use App\Shop\Domain\Cart\Cart;
use App\Shop\Domain\Cart\CartItem;
use App\Shop\Domain\Product\Product;
use PHPUnit\Framework\TestCase;
use SebastianBergmann\LinesOfCode\NegativeValueException;

class CartItemTest extends TestCase
{
    private CartItem $sut;

    protected function setUp(): void
    {
        $mockProduct = $this->createMock(Product::class);
        $mockCart = $this->createMock(Cart::class);
        $this->sut = new CartItem($mockProduct, $mockCart, 10);

    }


    /**
     * @test
     * it_should_return_proper_class
     * @group cart_item_test
     */
    public function itShouldReturnProperClass()
    {
        $this->assertInstanceOf(Cart::class, $this->sut->getCart());
        $this->assertInstanceOf(Product::class, $this->sut->getProduct());
        $this->assertEquals(10, $this->sut->getUds());

    }

    /**
     * @test
     * update_cart
     * @group cart_item_test
     */
    public function updateCart()
    {
        $cartMocked2 = $this->createMock(Cart::class);
        $this->sut->setCart($cartMocked2);
        $this->assertEquals($cartMocked2, $this->sut->getCart());
    }

    /**
     * @test
     * update_product
     * @group cart_item_test
     */
    public function updateProduct()
    {
        $productMocked2 = $this->createMock(Product::class);
        $this->sut->setProduct($productMocked2);
        $this->assertEquals($productMocked2, $this->sut->getProduct());
    }

    /**
     * @test
     * update_uds
     * @group cart_item_test
     */
    public function updateUds()
    {
        $this->sut->setUds(47);
        $this->assertEquals(47, $this->sut->getUds());
    }

    /**
     * @test
     * update_uds
     * @group cart_item_test
     */
    public function tryUpdateNegativeUds()
    {
        $this->expectException(NegativeValueException::class);
        $this->sut->setUds(-47);
    }


}
