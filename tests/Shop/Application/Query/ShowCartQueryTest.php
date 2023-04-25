<?php

namespace App\Tests\Shop\Application\Query;

use App\Shop\Application\Query\ShowCartQuery;
use PHPUnit\Framework\TestCase;

class ShowCartQueryTest extends TestCase
{

    /**
     * @test
     * it_should_return_proper_class
     * @group show_cart_query
     */
    public function itShouldReturnProperClass()
    {
        $sut = new ShowCartQuery(2);
        $this->assertEquals(2, $sut->getUserId());

    }

}
