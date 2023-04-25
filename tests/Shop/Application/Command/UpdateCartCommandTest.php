<?php

namespace App\Tests\Shop\Application\Command;

use App\Shop\Application\Command\UpdateCartCommand;
use PHPUnit\Framework\TestCase;

class UpdateCartCommandTest extends TestCase
{

    /**
     * @test
     * it_should_return_proper_class
     * @group update_cart_command_test
     */
    public function itShouldReturnProperClass()
    {
        $sut = new UpdateCartCommand(5, 4, 2);
        $this->assertEquals(2, $sut->getUnits());
        $this->assertEquals(4, $sut->getUserId());
        $this->assertEquals(5, $sut->getProductId());
    }

}
