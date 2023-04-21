<?php

namespace App\Tests\Cart;

use App\Shop\Application\services\Cart\DeleteCartService;
use App\Shop\Domain\Cart\CartItemRepository;
use App\Shop\Domain\Cart\CartRepository;
use App\Shop\Domain\Cart\Exceptions\CartExceptions;
use App\Shop\Domain\Product\ProductRepository;
use Doctrine\ORM\NonUniqueResultException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class DeleteErrorFromCartTest extends TestCase
{
    private MockObject|CartRepository $cr;

    private DeleteCartService $deleteCartService;

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
        $this->deleteCartService = new DeleteCartService($this->cr, $pr, $cir);

    }

    /**
     * @throws NonUniqueResultException
     */
    public function testDeleteCartNotFound()
    {
        $this->cr->expects($this->once())
            ->method('findCartByUserId')
            ->willReturn(null);

        $this->expectException(CartExceptions::class);
        $this->expectExceptionMessage('Carrito no encontrado');

        $result = $this->deleteCartService->deleteFromCart(1, 2);
        $this->assertNull($result);

    }
}