<?php

namespace App\Shop\Application\services\Cart;

use App\Shop\Domain\Cart\Cart;
use App\Shop\Domain\Cart\CartRepository;
use App\Shop\Domain\Exceptions\CartExceptions;
use App\Shop\Domain\Product\Product;
use App\Shop\Domain\Product\ProductRepository;
use App\Shop\Domain\User\User;
use App\Shop\Domain\User\UserRepository;
use Exception;

class AddToCartService
{
    public function __construct(private readonly UserRepository $userRepository, private readonly ProductRepository $productRepository, private readonly CartRepository $cartRepository)
    {

    }

    /**
     * @throws CartExceptions
     * @throws Exception
     */
    public function addToCart(int $userID, int $productID, int $units): void
    {

        $user = $this->userRepository->findById($userID);

        $product = $this->productRepository->findById($productID);

        $this->guardUser($user);
        $this->guardProduct($product);
        $cart = $this->checkCart($user);

        $cart->addItemsToCart($product, $units);


        $this->cartRepository->saveCart($cart);

    }


    /**
     * @throws CartExceptions
     */
    private function guardProduct(?Product $product): void
    {
        if (!$product) throw CartExceptions::cartNotFound();

    }

    private function checkCart(User $user): Cart
    {

        $cart = $this->cartRepository->findCartByUserId($user->getId());

        if (!$cart) {
            return new Cart($user);
        }
        return $cart;
    }

    /**
     * @throws CartExceptions
     */
    private function guardUser(?User $user): void
    {
        if (!$user) throw CartExceptions::userNotFound();
    }

}