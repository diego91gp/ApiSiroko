<?php

namespace App\Shop\Application\Command;

use App\Shared\Application\Symfony\CommandHandlerInterface;
use App\Shop\Domain\Cart\Cart;
use App\Shop\Domain\Cart\CartRepository;
use App\Shop\Domain\Cart\Exceptions\CartExceptions;
use App\Shop\Domain\Product\Product;
use App\Shop\Domain\Product\ProductRepository;
use App\Shop\Domain\User\User;
use App\Shop\Domain\User\UserRepository;

class AddProductToCartCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly UserRepository    $userRepository,
        private readonly ProductRepository $productRepository,
        private readonly CartRepository    $cartRepository,
    )
    {

    }

    /**
     * @throws CartExceptions
     */
    public function __invoke(AddProductToCartCommand $command): void
    {
        $user = $this->userRepository->findById($command->getUserID());

        $product = $this->productRepository->findById($command->getProductId());

        $this->guardUser($user);
        $this->guardProduct($product);
        $cart = $this->checkCart($user);

        $cart->addItemsToCart($product, $command->getUnits());

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