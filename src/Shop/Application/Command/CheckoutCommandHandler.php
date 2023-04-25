<?php

namespace App\Shop\Application\Command;

use App\Shared\Application\Symfony\CommandHandlerInterface;
use App\Shop\Application\DTO\CartResponseDTO;
use App\Shop\Domain\Cart\Cart;
use App\Shop\Domain\Cart\CartRepository;
use App\Shop\Domain\Cart\Exceptions\CartExceptions;
use App\Shop\Domain\Product\ProductRepository;

class CheckoutCommandHandler implements CommandHandlerInterface
{
    public function __construct(private readonly CartRepository $cartRepository, private readonly ProductRepository $productRepository)
    {

    }

    /**
     * @throws CartExceptions
     */
    public function __invoke(CheckoutCommand $command): CartResponseDTO
    {

        $cartResponseDTO = new CartResponseDTO();
        $cart = $this->cartRepository->findCartByUserId($command->getUserId());

        $this->guardCart($cart);

        $this->checkout($cart, $cartResponseDTO);


        $this->cartRepository->deleteCart($cart);

        return $cartResponseDTO;
    }

    /**
     * @throws CartExceptions
     */
    private function guardCart($cart): void
    {
        if (!$cart) throw CartExceptions::cartNotFound();

    }


    private function checkout(Cart $cart, CartResponseDTO $cartResponseDTO): void
    {
        foreach ($cart->getProducts() as $cartItem) {
            $cartResponseDTO->addToCart($cartItem->getProduct()->getName(), $cartItem->getProduct()->amount()
                , $cartItem->getUds());
            $product = $this->productRepository->findById($cartItem->getProduct()->getId());
            $product->setStock($product->getStock() - $cartItem->getUds());
            $this->productRepository->saveProduct($product);

        }

        $cartResponseDTO->setTotal($cart->getTotal());
    }


}