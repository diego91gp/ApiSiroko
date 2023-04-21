<?php

namespace App\Tests\Cart;

use App\Shop\Application\Query\ShowCartQuery;
use App\Shop\Application\Query\ShowCartQueryHandler;
use App\Shop\Domain\Cart\Cart;
use App\Shop\Domain\Cart\CartRepository;
use App\Shop\Domain\Cart\Exceptions\CartExceptions;
use App\Shop\Domain\Product\Exceptions\PriceExceptions;
use App\Shop\Domain\Product\Price;
use App\Shop\Domain\Product\Product;
use App\Shop\Domain\User\EmailVO;
use App\Shop\Domain\User\PassVO;
use App\Shop\Domain\User\User;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ShowCartTest extends TestCase
{
    private MockObject|CartRepository $cr;

    private ShowCartQueryHandler $showCartService;

    public function __construct(string $name)
    {
        parent::__construct($name);
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->cr = $this->getMockBuilder(CartRepository::class)->disableOriginalConstructor()->getMock();
        $this->showCartService = new ShowCartQueryHandler($this->cr);

    }

    /**
     * @throws CartExceptions
     * @throws PriceExceptions
     */
    public function testShowCart()
    {
        $user = new User('Jose', new EmailVO("diego81@gmail.com"), new PassVO("1234567aA"));
        $product = new Product('gafas', 150, new Price(15.99, 'EUR'));
        $cart = new Cart($user);
        // Configurar los mock objects
        $this->cr->expects($this->once())
            ->method('findCartByUserId')
            ->with($this->equalTo(1))
            ->willReturn($cart);
        $query = new ShowCartQuery(1);

        $response = ($this->showCartService)($query);


        $this->assertTrue(is_array($response));

    }

}