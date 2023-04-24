<?php

namespace App\Tests\Cart;

use App\Shop\Application\Command\AddProductToCartCommand;
use App\Shop\Application\Command\AddProductToCartCommandHandler;
use App\Shop\Domain\Cart\CartRepository;
use App\Shop\Domain\Cart\Exceptions\CartExceptions;
use App\Shop\Domain\Product\Exceptions\PriceExceptions;
use App\Shop\Domain\Product\Price;
use App\Shop\Domain\Product\Product;
use App\Shop\Domain\Product\ProductRepository;
use App\Shop\Domain\User\EmailVO;
use App\Shop\Domain\User\PassVO;
use App\Shop\Domain\User\User;
use App\Shop\Domain\User\UserRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class AddToCartTest extends TestCase
{

    private MockObject|ProductRepository $pr;

    private AddProductToCartCommandHandler $addToCartService;

    public function __construct(string $name)
    {
        parent::__construct($name);
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->ur = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $cr = $this->getMockBuilder(CartRepository::class)->disableOriginalConstructor()->getMock();
        $this->pr = $this->getMockBuilder(ProductRepository::class)->disableOriginalConstructor()->getMock();
        $this->addToCartService = new  AddProductToCartCommandHandler($this->ur, $this->pr, $cr);

    }


    /**
     * @throws PriceExceptions
     * @throws CartExceptions
     */
    public function testSave()
    {
        // Configurar los mock objects
        $user = new User('Jose', new EmailVO("diego81@gmail.com"), new PassVO("1234567aA"));
        $user->setId(1);
        $product = new Product('gafas', 150, new Price(15.99, 'EUR'));
        $product->setId(1);

        $this->ur->expects($this->once())
            ->method('findById')
            ->with($this->equalTo(2))
            ->willReturn($user);


        $this->pr->expects($this->once())
            ->method('findById')
            ->with($this->equalTo(1))
            ->willReturn($product);

        $command = new AddProductToCartCommand(1, 3, 2);
        ($this->addToCartService)($command);
        $this->assertTrue(true);

    }

}