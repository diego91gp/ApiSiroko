<?php

namespace App\Shop\Application\services\Cart;

use App\Shop\Domain\Cart\Cart;
use App\Shop\Domain\Cart\CartItemRepository;
use App\Shop\Domain\Cart\CartRepository;
use App\Shop\Domain\Exceptions\CartExceptions;
use App\Shop\Domain\Product\Product;
use App\Shop\Domain\Product\ProductRepository;


class UpdateCartService
{
    public function __construct(
        private readonly CartRepository     $cartRepository,
        private readonly ProductRepository  $productRepository,
        private readonly CartItemRepository $cartItemRepository
    )
    {

    }

    /**
     * @throws CartExceptions
     */
    public function updateCart(int $userID, int $productID, int $uds): string
    {
        $this->guardUnits($uds);
        $cart = $this->cartRepository->findCartByUserId($userID);

        $this->guardCart($cart);
        $product = $this->productRepository->findById($productID);
        $this->guardProduct($product);
        $cartItem = $cart->findItemInCart($productID);


        if ($uds == 0) {
            $this->cartItemRepository->deleteCartItem($cartItem);
        } else {
            $cartItem->setUds($uds);
            $this->cartItemRepository->saveItem($cartItem);
        }
        return 'Carrito actualizado correctamente';
    }


    /**
     * @throws CartExceptions
     */
    private function guardProduct(?Product $product): void
    {
        if (!$product) throw CartExceptions::productNotFound();

    }

    /**
     * @throws CartExceptions
     */
    private function guardUnits(int $uds): void
    {
        if ($uds < 0) throw CartExceptions::negativeUnits();

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
    private function guardCart(?Cart $cart): void
    {
        if (!$cart) throw CartExceptions::cartNotFound();
    }

}