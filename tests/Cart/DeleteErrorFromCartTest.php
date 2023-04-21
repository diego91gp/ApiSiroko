<?php

namespace App\Tests\Cart;

use App\Shop\Application\Command\DeleteProductFromCartCommand;
use App\Shop\Application\Command\DeleteProductFromCartCommandHandler;
use App\Shop\Application\services\Cart\DeleteCartService;
use App\Shop\Domain\Cart\CartItemRepository;
use App\Shop\Domain\Cart\CartRepository;
use App\Shop\Domain\Cart\Exceptions\CartExceptions;
use App\Shop\Domain\Product\ProductRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class DeleteErrorFromCartTest extends TestCase
{
    private MockObject|CartRepository $cr;

    private DeleteProductFromCartCommandHandler $deleteCartService;

    public function __construct(string $name)
    {
        parent::__construct($name);
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->cr = $this->getMockBuilder(CartRepository::class)->disableOriginalConstructor()->getMock();
        $pr = $this->getMockBuilder(ProductRepository::class)->disableOriginalConstructor()->getMock();
        $cir = $this->getMockBuilder(CartItemRepository::class)->disableOriginalConstructor()->getMock();
        $this->deleteCartService = new DeleteProductFromCartCommandHandler($this->cr, $pr, $cir);

    }


    public function testDeleteCartNotFound()
    {
        $this->cr->expects($this->once())
            ->method('findCartByUserId')
            ->willReturn(null);

        $this->expectException(CartExceptions::class);
        $this->expectExceptionMessage('Carrito no encontrado');
        $command = new DeleteProductFromCartCommand(1, 2);

        $result = ($this->deleteCartService)($command);
        $this->assertNull($result);

    }
}