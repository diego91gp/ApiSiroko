<?php

namespace App\Tests\UserRegistration;

use App\Shop\Domain\User\EmailVO;
use App\Shop\Domain\User\PassVO;
use App\Shop\Domain\User\User;
use App\Shop\Infrastructure\Persistence\Doctrine\Repository\UserRepositoryImpl;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;


class UserRegistrationTest extends TestCase
{

    private MockObject|UserRepositoryImpl $ur;


    public function setUp(): void
    {
        parent::setUp();
        $this->ur = $this->getMockBuilder(UserRepositoryImpl::class)->disableOriginalConstructor()->getMock();

    }

    public function testSave()
    {
        $user = new User("Diego", new EmailVO("diego81@gmail.com"), new PassVO("1234567aA"));
        $user->setId(1);
        $this->ur->save($user);
        self::assertTrue(true);

    }


}