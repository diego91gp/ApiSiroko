<?php

namespace App\Shop\Domain\Cart;

interface CartRepository
{
    public function saveCart(Cart $cart);

    public function deleteCart(Cart $cart);

    public function findCartById(int $cartId);

    public function findCartByUserId(int $userId);

}