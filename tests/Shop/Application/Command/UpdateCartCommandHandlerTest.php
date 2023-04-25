<?php /** @noinspection ALL */


namespace App\Tests\Shop\Application\Command;

use App\Shop\Application\Command\UpdateCartCommand;
use App\Shop\Application\Command\UpdateCartCommandHandler;
use App\Shop\Domain\Cart\Cart;
use App\Shop\Domain\Cart\CartItem;
use App\Shop\Domain\Cart\CartItemRepository;
use App\Shop\Domain\Cart\CartRepository;
use App\Shop\Domain\Cart\Exceptions\CartExceptions;
use App\Shop\Domain\Product\Exceptions\PriceExceptions;
use App\Shop\Domain\Product\Product;
use App\Shop\Domain\Product\ProductRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class UpdateCartCommandHandlerTest extends TestCase
{
    private UpdateCartCommandHandler $sut;
    private CartRepository|MockObject $cartRepository;
    private ProductRepository|MockObject $productRepository;
    private CartItemRepository|MockObject $cartItemRepository;

    protected function setUp(): void
    {

        $this->cartRepository = $this->createConfiguredMock(CartRepository::class, [
            "findCartByUserId" => $this->createConfiguredMock(Cart::class, [
                "findItemInCart" => $this->createMock(CartItem::class)
            ])
        ]);

        $this->productRepository = $this->createConfiguredMock(ProductRepository::class, [
            "findById" => $this->createMock(Product::class)
        ]);

        $this->cartItemRepository = $this->createMock(CartItemRepository::class);

        $this->sut = new UpdateCartCommandHandler(
            $this->cartRepository,
            $this->productRepository,
            $this->cartItemRepository
        );

    }

    /**
     * @test
     * it_should_return_negative_amount_exception
     * @group update_cart_test
     */
    public function itShouldReturnNegativeAmountException()
    {

        $this->expectException(PriceExceptions::class);
        $this->expectExceptionMessage(PriceExceptions::negativeAmount()->getMessage());
        $this->sut->__invoke($this->createConfiguredMock(UpdateCartCommand::class, [
            "getUnits" => -50
        ]));

    }

    /**
     * @test
     * it_should_return_product_not_found
     * @group update_cart_test
     */
    public function itShouldReturnProductNotFoundException()
    {

        $newSut = new UpdateCartCommandHandler(
            $this->cartRepository,
            $this->createMock(ProductRepository::class),
            $this->cartItemRepository
        );

        $this->expectException(CartExceptions::class);
        $this->expectExceptionMessage(CartExceptions::productNotFound()->getMessage());

        $newSut->__invoke($this->createMock(UpdateCartCommand::class));

    }

    /**
     * @test
     * it_should_return_cart_not_found
     * @group update_cart_test
     */
    public function itShouldReturnCartNotFoundException()
    {

        $newSut = new UpdateCartCommandHandler(
            $this->createMock(CartRepository::class),
            $this->productRepository,
            $this->cartItemRepository
        );

        $this->expectException(CartExceptions::class);
        $this->expectExceptionMessage(CartExceptions::cartNotFound()->getMessage());

        $newSut->__invoke($this->createMock(UpdateCartCommand::class));

    }

    /**
     * @test
     * it_should_not_return_exceptions
     * @group update_cart_test
     */
    public function itShouldNotReturnExceptions()
    {

        $this->expectNotToPerformAssertions();

        $this->sut->__invoke($this->createMock(UpdateCartCommand::class));

    }


}
