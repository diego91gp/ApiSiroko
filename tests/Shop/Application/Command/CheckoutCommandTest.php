<?php

namespace App\Tests\Shop\Application\Command;

use App\Shop\Application\Command\CheckoutCommand;
use PHPUnit\Framework\TestCase;

class CheckoutCommandTest extends TestCase
{

    /**
     * @test
     * it_should_return_proper_class
     * @group checkout_cart_command_test
     */
    public function itShouldReturnProperClass()
    {
        $sut = new CheckoutCommand(5);
        $this->assertEquals(5, $sut->getUserId());
    }


}
