<?php

namespace App\Tests\UserRegistration;

use App\Cart\Domain\Entity\VO\Price;
use App\Cart\Domain\Exceptions\PriceExceptions;
use App\Shop\Domain\Exceptions\PasswordCreationException;
use App\Shop\Domain\User\PassVO;
use PHPUnit\Framework\TestCase;

class InvalidPasswordFormatTest extends TestCase
{


    public function testInvalidPassword()
    {
        $this->expectException(PasswordCreationException::class);
        new PassVO("invalido");
    }

}
