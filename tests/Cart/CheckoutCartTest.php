<?php

namespace App\Tests\Cart;

use App\Shop\Application\Command\CheckoutCommand;
use App\Shop\Application\Command\CheckoutCommandHandler;
use App\Shop\Application\services\Cart\CheckoutService;
use App\Shop\Domain\Cart\Cart;
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

class CheckoutCartTest extends TestCase
{
    private MockObject|CartRepository $cr;
    private CheckoutCommandHandler $checkoutService;

    public function __construct(string $name)
    {
        parent::__construct($name);
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->cr = $this->getMockBuilder(CartRepository::class)->disableOriginalConstructor()->getMock();
        $pr = $this->getMockBuilder(ProductRepository::class)->disableOriginalConstructor()->getMock();
        $this->checkoutService = new CheckoutCommandHandler($this->cr, $pr);

    }

    /**
     * @throws CartExceptions
     * @throws PriceExceptions
     */
    public function testCheckout()
    {
        $user = new User('Jose', new EmailVO("diego81@gmail.com"), new PassVO("1234567aA"));
        $user->setId(1);
        $product = new Product('gafas', 150, new Price(15.99, 'EUR'));
        $cart = new Cart($user);
        $cart->setId(1);
        // Configurar los mock objects
        $this->cr->expects($this->once())
            ->method('findCartByUserId')
            ->with($this->equalTo(1))
            ->willReturn($cart);
        $command = new CheckoutCommand(1, 3, 2);
        $response = ($this->checkoutService)($command);
        $this->assertTrue(is_array($response));


    }


}