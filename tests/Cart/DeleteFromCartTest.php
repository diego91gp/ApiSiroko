<?php

namespace App\Tests\Cart;

use App\Shop\Application\services\Cart\DeleteCartService;
use App\Shop\Domain\Cart\Cart;
use App\Shop\Domain\Cart\CartItem;
use App\Shop\Domain\Cart\CartItemRepository;
use App\Shop\Domain\Cart\CartRepository;
use App\Shop\Domain\Cart\Exceptions\CartExceptions;
use App\Shop\Domain\Product\Exceptions\PriceExceptions;
use App\Shop\Domain\Product\Price;
use App\Shop\Domain\Product\Product;
use App\Shop\Domain\Product\ProductRepository;
use App\Shop\Domain\User\EmailVO;
use App\Shop\Domain\User\PassVO;
use App\Shop\Domain\User\User;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertSame;

class DeleteFromCartTest extends TestCase
{
    private MockObject|CartRepository $cr;

    private MockObject|ProductRepository $pr;
    private MockObject|CartItemRepository $cir;

    private DeleteCartService $deleteCartService;

    public function __construct(string $name)
    {
        parent::__construct($name);
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->cr = $this->getMockBuilder(CartRepository::class)->disableOriginalConstructor()->getMock();
        $this->pr = $this->getMockBuilder(ProductRepository::class)->disableOriginalConstructor()->getMock();
        $this->cir = $this->getMockBuilder(CartItemRepository::class)->disableOriginalConstructor()->getMock();
        $this->deleteCartService = new DeleteCartService($this->cr, $this->pr, $this->cir);

    }


    /**
     * @throws CartExceptions|PriceExceptions
     */
    public function testDeleteFromCart()
    {
        // Configurar los mock objects
        $user = new User('Jose', new EmailVO("diego81@gmail.com"), new PassVO("1234567aA"));
        $user->setId(1);
        $product = new Product('gafas', 150, new Price(15.99, 'EUR'));
        $product->setId(1);
        $cart = new Cart($user);
        $cart->setId(1);
        $cartItem = new CartItem($product, $cart, 1);
        $cartItem->setId(1);

        $this->cr->expects($this->once())
            ->method('findCartByUserId')
            ->with($this->equalTo(1))
            ->willReturn($cart);

        $this->pr->expects($this->once())
            ->method('findById')
            ->with($this->equalTo(1))
            ->willReturn($product);

        $this->cir->expects($this->once())
            ->method('findByCartIdAndProductId')
            ->with($this->equalTo(1), ($this->equalTo(1)))
            ->willReturn($cartItem);

        $this->cir->expects($this->once())
            ->method('deleteCartItem')
            ->with($this->equalTo($cartItem));

        $this->deleteCartService->deleteFromCart(1, 1);
        assertSame(0, $cart->getProducts()->count());

    }
}