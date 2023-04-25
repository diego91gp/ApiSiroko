<?php /** @noinspection ALL */


namespace App\Tests\Shop\Application\DTO;

use App\Shop\Application\DTO\CartResponseDTO;
use App\Shop\Domain\Cart\Cart;
use PHPUnit\Framework\TestCase;

class CartResponseDTOTest extends TestCase
{
    private CartResponseDTO $sut;

    protected function setUp(): void
    {
        $this->sut = new CartResponseDTO();
    }

    /**
     * @test
     * it_should_return_array
     * @group cart_dto_test
     */
    public function itShouladdToCartArray()
    {
        $this->sut->addToCart("Casco", 15.99, 5);
        $this->assertEquals(1, count($this->sut->getProducts()));

    }

    /**
     * @test
     * it_should_assemble_cart
     * @group cart_dto_test
     */
    public function itShoulAssembleCart()
    {
        $this->assertInstanceOf(
            CartResponseDTO::class,
            CartResponseDTO::assemble($this->createMock(Cart::class))
        );

    }

    /**
     * @test
     * it_should_update_total
     * @group cart_dto_test
     */
    public function itShoulUpdateTotal()
    {


        $this->sut->setTotal(50.55);
        $this->assertEquals(50.55, $this->sut->getTotal());

    }


}
