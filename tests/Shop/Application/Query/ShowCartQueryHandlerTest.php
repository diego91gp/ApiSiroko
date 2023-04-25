<?php /** @noinspection ALL */

namespace App\Tests\Shop\Application\Query;

use App\Shop\Application\DTO\CartResponseDTO;
use App\Shop\Application\Query\ShowCartQuery;
use App\Shop\Application\Query\ShowCartQueryHandler;
use App\Shop\Domain\Cart\Cart;
use App\Shop\Domain\Cart\CartRepository;
use App\Shop\Domain\Cart\Exceptions\CartExceptions;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ShowCartQueryHandlerTest extends TestCase
{
    private ShowCartQueryHandler $sut;
    private CartRepository|MockObject $cartRepository;

    protected function setUp(): void
    {
        $this->cartRepository = $this->createConfiguredMock(CartRepository::class, [
            "findCartByUserId" => $this->createMock(Cart::class)
        ]);
        $this->sut = new ShowCartQueryHandler($this->cartRepository);

    }

    /**
     * @test
     * it_should_return_valid_DTO
     * @group show_cart_test
     */
    public function itShouldReturnValidCartDTO()
    {
        $this->assertInstanceOf(
            CartResponseDTO::class,
            $this->sut->__invoke($this->createMock(ShowCartQuery::class))
        );
    }

    /**
     * @test
     * it_should_return_cart_exception
     * @group show_cart_test
     */
    public function itShouldReturnCartException()
    {
        $newSut = new ShowCartQueryHandler($this->createMock(CartRepository::class));
        $this->expectException(CartExceptions::class);
        $this->expectExceptionMessage(CartExceptions::cartNotFound()->getMessage());
        $newSut->__invoke($this->createMock(ShowCartQuery::class));
    }

}
