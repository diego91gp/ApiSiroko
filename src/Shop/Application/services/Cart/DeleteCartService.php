<?php

namespace App\Shop\Application\services\Cart;

use App\Shop\Domain\Cart\Cart;
use App\Shop\Domain\Cart\CartItemRepository;
use App\Shop\Domain\Cart\CartRepository;
use App\Shop\Domain\Exceptions\CartExceptions;
use App\Shop\Domain\Product\Product;
use App\Shop\Domain\Product\ProductRepository;

class DeleteCartService
{
    public function __construct(private readonly CartRepository $cartRepository, private readonly ProductRepository $productRepository, private readonly CartItemRepository $cartItemRepository)
    {

    }

    /**
     * @throws CartExceptions
     */
    public function deleteFromCart(int $userID, int $productID): void
    {
        $cart = $this->cartRepository->findCartByUserId($userID);
        $product = $this->productRepository->findById($productID);


        $this->guardCart($cart);
        $this->guardProduct($product);

        $cartItem = $this->cartItemRepository->findByCartIdAndProductId($cart->getId(), $userID);

        $this->checkIfCartContainsProduct($cartItem);


        $this->cartItemRepository->deleteCartItem($cartItem);

        if ($cart->getProducts()->count() == 0) {
            $this->cartRepository->deleteCart($cart);
        }

    }

    /**
     * @throws CartExceptions
     */
    private function checkIfCartContainsProduct($cartItem): void
    {
        if (!$cartItem) throw CartExceptions::deleteItemError();
    }

    /**
     * @throws CartExceptions
     */
    private function guardCart(?Cart $cartItem): void
    {
        if (!$cartItem) throw CartExceptions::cartNotFound();
    }

    /**
     * @throws CartExceptions
     */
    private function guardProduct(?Product $product): void
    {
        if (!$product) throw CartExceptions::productNotFound();

    }


}