<?php

namespace App\Shop\Domain\Cart;

interface CartItemRepository
{

    public function deleteCartItem(CartItem $cartItem);

    public function saveItem(CartItem $cartItem);

    public function findByCartIdAndProductId(int $cartId, int $productId);

}