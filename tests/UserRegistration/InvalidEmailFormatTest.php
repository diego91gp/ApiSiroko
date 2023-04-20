<?php

namespace App\Tests\UserRegistration;

use App\Cart\Domain\Entity\VO\Price;
use App\Cart\Domain\Exceptions\PriceExceptions;
use App\Shop\Domain\Exceptions\EmailCreationException;
use App\Shop\Domain\User\EmailVO;
use PHPUnit\Framework\TestCase;

class InvalidEmailFormatTest extends TestCase
{


    public function testInvalidEmail()
    {
        $this->expectException(EmailCreationException::class);
        new EmailVO("invalido");
    }

}
