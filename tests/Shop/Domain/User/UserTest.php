<?php

namespace App\Tests\Shop\Domain\User;

use App\Shop\Domain\User\EmailVO;
use App\Shop\Domain\User\PassVO;
use App\Shop\Domain\User\User;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private User $sut;
    private EmailVO|MockObject $emailMocked;
    private PassVO|MockObject $passwrodMocked;

    protected function setUp(): void
    {
        $this->emailMocked = $this->createConfiguredMock(EmailVO::class, [
            'value' => 'javier.jimenez@email.com'
        ]);

        $this->passwrodMocked = $this->createConfiguredMock(PassVO::class, [
            'value' => 'Ma12345678'
        ]);

        $this->sut = new User(name: 'Javi', email: $this->emailMocked, password: $this->passwrodMocked);
    }

    /**
     * @test
     * it_should_return_proper_class
     * @group user
     */
    public function itShouldReturnProperClass(): void
    {
        $this->assertEquals('Javi', $this->sut->getName());
        $this->assertEquals('javier.jimenez@email.com', $this->sut->getEmail()->value());
        $this->assertEquals('Ma12345678', $this->sut->getPassword()->value());
    }

    /**
     * @test
     * it_should_update_email
     * @group user
     */
    public function itShouldUpdateEmail(): void
    {
        $this->sut->setEmail("diego@gmail.com");
        $this->assertEquals('diego@gmail.com', $this->sut->getEmail()->value());
    }

    /**
     * @test
     * it_should_update_pass
     * @group user
     */
    public function itShouldUpdatePass(): void
    {
        $this->sut->setPassword("123465wWe");
        $this->assertEquals('123465wWe', $this->sut->getPassword()->value());

    }

    /**
     * @test
     * it_should_update_id
     * @group user
     */
    public function itShouldUpdateId(): void
    {
        $this->sut->setId(8);
        $this->assertEquals(8, $this->sut->getId());

    }
}
