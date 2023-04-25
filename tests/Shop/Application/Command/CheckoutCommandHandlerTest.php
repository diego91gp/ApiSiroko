<?php /** @noinspection ALL */


namespace App\Tests\Shop\Application\Command;

use App\Shop\Application\Command\CheckoutCommand;
use App\Shop\Application\Command\CheckoutCommandHandler;
use App\Shop\Application\DTO\CartResponseDTO;
use App\Shop\Domain\Cart\Cart;
use App\Shop\Domain\Cart\CartRepository;
use App\Shop\Domain\Cart\Exceptions\CartExceptions;
use App\Shop\Domain\Product\Product;
use App\Shop\Domain\Product\ProductRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CheckoutCommandHandlerTest extends TestCase
{
    private CheckoutCommandHandler $sut;
    private CartRepository|MockObject $cartRepository;
    private ProductRepository|MockObject $productRepository;

    protected function setUp(): void
    {
        $this->cartRepository = $this->createConfiguredMock(CartRepository::class, [
            "findCartByUserId" => $this->createMock(Cart::class)
        ]);
        $this->productRepository = $this->createConfiguredMock(ProductRepository::class, [
            "findById" => $this->createMock(Product::class)
        ]);
        $this->sut = new CheckoutCommandHandler($this->cartRepository, $this->productRepository);
    }

    /**
     * @test
     * it_should_not_resturn_exceptions
     * @group checkout_test
     */
    public function itShouldNotExpectExceptions()
    {
        $this->assertInstanceOf(CartResponseDTO::class, $this->sut->__invoke($this->createMock(CheckoutCommand::class)));

    }

    /**
     * @test
     * it_should_return_exception
     * @group checkout_test
     */
    public function itShouldReturnException()
    {
        $newSut = new CheckoutCommandHandler($this->createMock(CartRepository::class), $this->productRepository);

        $this->expectException(CartExceptions::class);
        $this->expectExceptionMessage(CartExceptions::cartNotFound()->getMessage());

        $newSut->__invoke($this->createMock(CheckoutCommand::class));
    }

}
