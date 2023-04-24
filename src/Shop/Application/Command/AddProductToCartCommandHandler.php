<?php

namespace App\Shop\Application\Command;

use App\Shared\Application\Symfony\CommandHandlerInterface;
use App\Shop\Domain\Cart\Cart;
use App\Shop\Domain\Cart\CartRepository;
use App\Shop\Domain\Product\Exceptions\ProductNotFoundInDBException;
use App\Shop\Domain\Product\Product;
use App\Shop\Domain\Product\ProductRepository;
use App\Shop\Domain\User\Exceptions\UserNotFoundException;
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
     * @throws ProductNotFoundInDBException
     * @throws UserNotFoundException
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
     * @throws ProductNotFoundInDBException
     */
    private function guardProduct(?Product $product): void
    {
        if (!$product) throw new ProductNotFoundInDBException();

    }

    private function checkCart(User $user): Cart
    {

        $cart = $this->cartRepository->findCartByUserId($user->getId());

        return (!$cart) ? new Cart($user) : $cart;

    }

    /**
     * @throws UserNotFoundException
     */
    private function guardUser(?User $user): void
    {
        if (!$user) throw new UserNotFoundException();
    }
}