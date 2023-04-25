<?php /** @noinspection ALL */

namespace App\Tests\Shop\Application\Command;

use App\Shop\Application\Command\AddProductToCartCommand;
use App\Shop\Application\Command\AddProductToCartCommandHandler;
use App\Shop\Domain\Cart\Cart;
use App\Shop\Domain\Cart\CartRepository;
use App\Shop\Domain\Product\Exceptions\ProductNotFoundInDBException;
use App\Shop\Domain\Product\Product;
use App\Shop\Domain\Product\ProductRepository;
use App\Shop\Domain\User\Exceptions\UserNotFoundException;
use App\Shop\Domain\User\User;
use App\Shop\Domain\User\UserRepository;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class AddProductToCartCommandHandlerTest extends TestCase
{
    private AddProductToCartCommandHandler $sut;
    private UserRepository|MockObject $userRepository;
    private ProductRepository|MockObject $productRepository;
    private CartRepository|MockObject $cartRepository;

    protected function setUp(): void
    {

        $this->productRepository = $this->createConfiguredMock(ProductRepository::class, [
            "findById" => $this->createMock(Product::class)
        ]);

        $this->userRepository = $this->createConfiguredMock(UserRepository::class, [
            "findById" => $this->createMock(User::class)
        ]);

        $this->cartRepository = $this->createConfiguredMock(CartRepository::class, [
            "findCartByUserId" => $this->createMock(Cart::class)
        ]);

        $this->sut = new AddProductToCartCommandHandler($this->userRepository, $this->productRepository, $this->cartRepository);

    }

    /**
     * @return void
     * @test
     * it_should_return_proper_class
     * @group add_cart_test
     */
    public function itShouldNotThrowExceptions()
    {
        $this->expectNotToPerformAssertions();
        $this->sut->__invoke($this->createMock(AddProductToCartCommand::class));

    }

    /**
     * @test
     * it_should_return_product_exception
     * @group add_cart_test
     */
    public function itShouldReturnProductExcepction()
    {
        $newSut = new AddProductToCartCommandHandler($this->userRepository, $this->createMock(ProductRepository::class), $this->cartRepository);
        $this->expectException(ProductNotFoundInDBException::class);
        $newSut->__invoke($this->createMock(AddProductToCartCommand::class));
    }

    /**
     * @test
     * it_should_return_user_exception
     * @group add_cart_test
     */
    public function itShouldReturnUserExcepction()
    {
        $newSut = new AddProductToCartCommandHandler($this->createMock(UserRepository::class), $this->productRepository, $this->cartRepository);
        $this->expectException(UserNotFoundException::class);
        $newSut->__invoke($this->createMock(AddProductToCartCommand::class));

    }


}
