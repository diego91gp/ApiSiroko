<?php

namespace App\Tests\Shop\Domain\User;

use App\Shop\Domain\User\EmailVO;
use App\Shop\Domain\User\Exceptions\EmailCreationException;
use PHPUnit\Framework\TestCase;

class EmailVOTest extends TestCase
{
    /**
     * @return void
     * @test
     * @group  email_vo_test
     */
    public function itShouldThrowException()
    {
        $this->expectException(EmailCreationException::class);
        new EmailVO(email: "invalido");

    }


}