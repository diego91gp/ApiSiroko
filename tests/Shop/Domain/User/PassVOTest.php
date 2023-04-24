<?php

namespace App\Tests\Shop\Domain\User;

use App\Shop\Domain\User\Exceptions\PasswordCreationException;
use App\Shop\Domain\User\PassVO;
use PHPUnit\Framework\TestCase;

class PassVOTest extends TestCase
{
    private PassVO $sut;

    protected function setUp(): void
    {
        $this->sut = new PassVO("1234568xX");

    }

    /**
     * @test
     * it_should_throw_exception_when_no_valid_pass
     * @group pass_vo
     */
    public function itShouldThrowExceptionWhenNoValidPass(): void
    {
        $this->expectException(PasswordCreationException::class);
        new PassVO("1451");

    }

    /**
     * @test
     * it_should_return_proper_class
     * @group pass_vo
     */
    public function itShouldReturnProperClass(): void
    {
        $this->assertEquals('1234568xX', $this->sut->value());
    }

    /**
     * @test
     * it_should_update_proper_class
     * @group pass_vo
     * @throws PasswordCreationException
     */
    public function itShouldUpdateProperClass(): void
    {
        $newSut = $this->sut->updatePass('1234587xX');
        $this->assertEquals('1234587xX', $newSut->value());
    }
}
