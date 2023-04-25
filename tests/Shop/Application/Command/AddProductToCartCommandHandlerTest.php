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
    private AddProductToCartCommand|MockObject $command;
    private User|MockObject $user;
    private Cart|MockObject $cart;
    private Product|MockObject $product;
    private UserRepository|MockObject $userRepository;
    private ProductRepository|MockObject $productRepository;
    private CartRepository|MockObject $cartRepository;

    protected function setUp(): void
    {
        $this->cart = $this->createMock(Cart::class);
        $this->user = $this->createMock(User::class);
        $this->product = $this->createMock(Product::class);
        $this->command = $this->createConfiguredMock(AddProductToCartCommand::class, [
            "getProductId" => 1,
            "getUnits" => 10,
            "getUserId" => 1
        ]);

        $this->productRepository = $this->createConfiguredMock(ProductRepository::class, [
            "findById" => $this->product
        ]);

        $this->userRepository = $this->createConfiguredMock(UserRepository::class, [
            "findById" => $this->user
        ]);

        $this->cartRepository = $this->createConfiguredMock(CartRepository::class, [
            "findCartByUserId" => $this->cart
        ]);

        $this->sut = new AddProductToCartCommandHandler($this->userRepository, $this->productRepository, $this->cartRepository);

    }

    /**
     * @return void
     * @test
     * it_should_return_proper_class
     * @group add_cart_test
     */
    public function itShouldReturn()
    {
        $this->assertEquals(1, $this->command->getUserID());
        $this->assertEquals(1, $this->command->getProductId());
        $this->assertEquals(10, $this->command->getUnits());


        $this->assertEquals($this->user, $this->userRepository->findById($this->command->getUserID()));
        $this->assertEquals($this->product, $this->productRepository->findById($this->command->getProductId()));
        $this->sut->__invoke($this->command);

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
        $newSut->__invoke($this->command);

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
        $newSut->__invoke($this->command);

    }


}
