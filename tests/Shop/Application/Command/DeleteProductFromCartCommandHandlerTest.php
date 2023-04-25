<?php /** @noinspection ALL */

namespace App\Tests\Shop\Application\Command;

use App\Shop\Application\Command\DeleteProductFromCartCommand;
use App\Shop\Application\Command\DeleteProductFromCartCommandHandler;
use App\Shop\Domain\Cart\Cart;
use App\Shop\Domain\Cart\CartItem;
use App\Shop\Domain\Cart\CartItemRepository;
use App\Shop\Domain\Cart\CartRepository;
use App\Shop\Domain\Cart\Exceptions\CartExceptions;
use App\Shop\Domain\Product\Product;
use App\Shop\Domain\Product\ProductRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class DeleteProductFromCartCommandHandlerTest extends TestCase
{
    private DeleteProductFromCartCommandHandler $sut;
    private CartRepository|MockObject $cartRepository;
    private ProductRepository|MockObject $productRepository;
    private CartItemRepository|MockObject $cartItemRepository;

    protected function setUp(): void
    {

        $this->cartRepository = $this->createConfiguredMock(CartRepository::class, [
            "findCartByUserId" => $this->createMock(Cart::class)
        ]);

        $this->productRepository = $this->createConfiguredMock(ProductRepository::class, [
            "findById" => $this->createMock(Product::class)
        ]);

        $this->cartItemRepository = $this->createConfiguredMock(CartItemRepository::class, [
            "findByCartIdAndProductId" => $this->createMock(CartItem::class)
        ]);

        $this->sut = new DeleteProductFromCartCommandHandler(
            $this->cartRepository,
            $this->productRepository,
            $this->cartItemRepository
        );

    }

    /**
     * @test
     * it_should_return_delete_exception
     * @group delete_cart_test
     */
    public function itShouldReturnDeleteException()
    {

        $newSut = new DeleteProductFromCartCommandHandler(
            $this->cartRepository,
            $this->productRepository,
            $this->createMock(CartItemRepository::class)
        );

        $this->expectException(CartExceptions::class);
        $this->expectExceptionMessage(CartExceptions::deleteItemError()->getMessage());
        $newSut->__invoke($this->createMock(DeleteProductFromCartCommand::class));

    }

    /**
     * @test
     * it_should_return_cart_not_found_exception
     * @group delete_cart_test
     */
    public function itShouldReturnCartNotFoundException()
    {

        $newSut = new DeleteProductFromCartCommandHandler(
            $this->createMock(CartRepository::class),
            $this->productRepository,
            $this->cartItemRepository
        );

        $this->expectException(CartExceptions::class);
        $this->expectExceptionMessage(CartExceptions::cartNotFound()->getMessage());
        $newSut->__invoke($this->createMock(DeleteProductFromCartCommand::class));

    }

    /**
     * @test
     * it_should_return_product_not_found_exception
     * @group delete_cart_test
     */
    public function itShouldReturnProductNotFoundException()
    {

        $newSut = new DeleteProductFromCartCommandHandler(
            $this->cartRepository,
            $this->createMock(ProductRepository::class),
            $this->cartItemRepository
        );

        $this->expectException(CartExceptions::class);
        $this->expectExceptionMessage(CartExceptions::productNotFound()->getMessage());
        $newSut->__invoke($this->createMock(DeleteProductFromCartCommand::class));

    }

    /**
     * @test
     * it_should_not_return_exceptions
     * @group delete_cart_test
     */
    public function itShouldNotExpectExceptions()
    {
        $this->expectNotToPerformAssertions();
        $this->sut->__invoke($this->createMock(DeleteProductFromCartCommand::class));
    }


}
