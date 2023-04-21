<?php

namespace App\Shop\Application\Query;

use App\Shop\Application\Command\AddProductToCartCommand;
use App\Shop\Application\Command\AddProductToCartCommandHandler;
use App\Shop\Domain\Cart\Cart;
use App\Shop\Domain\Cart\CartRepository;
use App\Shop\Domain\Cart\Exceptions\CartExceptions;
use App\Shop\Domain\Product\Product;
use App\Shop\Domain\Product\ProductRepository;
use App\Shop\Domain\User\User;
use App\Shop\Domain\User\UserRepository;

class FindUserQueryHandler
{
    public function __construct(
        private readonly UserRepository                 $userRepository,
        private readonly ProductRepository              $productRepository,
        private readonly CartRepository                 $cartRepository,
        private readonly AddProductToCartCommandHandler $handler)
    {

    }

    /**
     * @throws CartExceptions
     */
    public function __invoke(FindUserQuery $query): void
    {
        $user = $this->userRepository->findById($query->getUserID());

        $product = $this->productRepository->findById($query->getProductId());

        $this->guardUser($user);
        $this->guardProduct($product);
        $cart = $this->checkCart($user);

        $cart->addItemsToCart($product, $query->getUnits());
        ($this->handler)(
            new AddProductToCartCommand($cart)
        );

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