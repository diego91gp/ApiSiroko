<?php /** @noinspection ALL */


namespace App\Tests\Shop\Domain\Cart;

use App\Shop\Domain\Cart\Cart;
use App\Shop\Domain\Cart\CartItem;
use App\Shop\Domain\Cart\Exceptions\CartExceptions;
use App\Shop\Domain\Product\Product;
use App\Shop\Domain\User\User;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    private Cart $sut;

    protected function setUp(): void
    {
        $userMocked = $this->createMock(User::class);
        $this->sut = new Cart($userMocked);
    }

    /**
     * @return void
     * @test
     * it_should_return_proper_class
     * @group cart_test
     */
    public function itShouldReturnProperClass()
    {
        $this->assertInstanceOf(User::class, $this->sut->getUser());
        $this->assertInstanceOf(\DateTime::class, $this->sut->getCreatedAt());
        $this->assertEmpty($this->sut->getProducts());
        //$this->assertEquals(new \DateTime("now"), $this->cart->getCreatedAt());

    }

    /**
     * @test
     * update_user
     * @group cart_test
     */
    public function updateUser()
    {
        $userMocked2 = $this->createConfiguredMock(User::class, [
            "getName" => "Siro",
        ]);
        $this->sut->setUser($userMocked2);
        $this->assertEquals($userMocked2, $this->sut->getUser());
    }

    /**
     * @test
     * update_creation_date
     * @group cart_test
     */
    public function updateCreationDate()
    {
        $this->sut->setCreatedAt(new \DateTime('today 5:00'));
        $this->assertEquals(new \DateTime('today 5:00'), $this->sut->getCreatedAt());
    }


    /**
     * @test
     * add_to_cart
     * @group cart_test
     */
    public function addToCart()
    {
        $mockProduct = $this->createMock(Product::class);
        $updatedCart = $this->sut->addItemsToCart($mockProduct, 15);


        $this->assertInstanceOf(CartItem::class, $updatedCart->getProducts()[0]);
        $this->assertNotEmpty($updatedCart->getProducts());
        $this->assertEquals($mockProduct, $updatedCart->getProducts()[0]->getProduct());
        $this->assertEquals(15, $updatedCart->getProducts()[0]->getUds());

        $updatedCart = $this->sut->addItemsToCart($mockProduct, 15);

        $this->assertEquals(30, $updatedCart->getProducts()[0]->getUds());


    }


    /**
     * @test
     * find_item_in_cart
     * @group cart_test
     */
    public function itShouldReturnCartItem()
    {
        $mockProduct = $this->createConfiguredMock(Product::class, [
            "getId" => 1
        ]);
        $this->sut->addItemsToCart($mockProduct, 15);
        $this->assertEquals($this->sut->getProducts()[0], $this->sut->findItemInCart(1));


    }

    /**
     * @test
     * find_item_exception
     * @group cart_test
     */
    public function itShouldReturnDeleteItemException()
    {
        $this->expectException(CartExceptions::class);
        $this->expectExceptionMessage(CartExceptions::deleteItemError()->getMessage());
        $this->sut->findItemInCart(1);


    }


}
