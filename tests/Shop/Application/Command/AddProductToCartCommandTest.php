<?php

namespace App\Tests\Shop\Application\Command;

use App\Shop\Application\Command\AddProductToCartCommand;
use PHPUnit\Framework\TestCase;

class AddProductToCartCommandTest extends TestCase
{


    /**
     * @test
     * it_should_return_proper_class
     * @group add_cart_command_test
     */
    public function itShouldReturnProperClass()
    {
        $sut = new AddProductToCartCommand(5, 4, 2);
        $this->assertEquals(4, $sut->getUnits());
        $this->assertEquals(2, $sut->getUserId());
        $this->assertEquals(5, $sut->getProductId());

    }

}
