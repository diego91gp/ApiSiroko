<?php

namespace App\Shop\Application\Command;

use App\Shared\Application\Symfony\CommandHandlerInterface;
use App\Shop\Domain\Cart\Cart;
use App\Shop\Domain\Cart\CartItemRepository;
use App\Shop\Domain\Cart\CartRepository;
use App\Shop\Domain\Cart\Exceptions\CartExceptions;
use App\Shop\Domain\Product\Product;
use App\Shop\Domain\Product\ProductRepository;

class DeleteProductFromCartCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly CartRepository     $cartRepository,
        private readonly ProductRepository  $productRepository,
        private readonly CartItemRepository $cartItemRepository)
    {

    }

    /**
     * @throws CartExceptions
     */
    public function __invoke(DeleteProductFromCartCommand $command): void
    {
        $cart = $this->cartRepository->findCartByUserId($command->getUserId());
        $product = $this->productRepository->findById($command->getProductId());


        $this->guardCart($cart);
        $this->guardProduct($product);
        
        $cartItem = $this->cartItemRepository->findByCartIdAndProductId($cart->getId(), $command->getProductId());

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