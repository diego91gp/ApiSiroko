<?php

namespace App\Shop\Application\Command;

use App\Shop\Domain\Cart\Cart;

class AddProductToCartCommand
{
    public function __construct(private readonly Cart $cart)
    {
    }

    public function getCart(): Cart
    {
        return $this->cart;
    }

}