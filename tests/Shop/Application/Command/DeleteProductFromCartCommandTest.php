<?php

namespace App\Tests\Shop\Application\Command;

use App\Shop\Application\Command\DeleteProductFromCartCommand;
use PHPUnit\Framework\TestCase;

class DeleteProductFromCartCommandTest extends TestCase
{

    /**
     * @test
     * it_should_return_proper_class
     * @group delete_cart_command_test
     */
    public function itShouldReturnProperClass()
    {
        $sut = new DeleteProductFromCartCommand(5, 4);
        $this->assertEquals(5, $sut->getUserId());
        $this->assertEquals(4, $sut->getProductId());
    }


}
