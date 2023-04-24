<?php

namespace App\Shop\Domain\Cart;


use App\Shop\Domain\Product\Product;


class CartItem
{
    private int $id;


    public function __construct(private Product $product, private Cart $cart, private int $uds)
    {
    }

    public function getProductId(): int
    {
        return $this->product->getId();
    }

    public function getUserId(): int
    {
        return $this->cart->getUser()->getId();
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    public function getCart(): Cart
    {
        return $this->cart;
    }

    public function setCart(Cart $cart): void
    {
        $this->cart = $cart;
    }

    public function getUds(): int
    {
        return $this->uds;
    }

    public function setUds(int $uds): void
    {
        $this->uds = $uds;
    }


    public function setId(int $id): void
    {
        $this->id = $id;
    }


}