<?php

namespace App\Shop\Application\services\Cart;

use App\Shop\Domain\Cart\Cart;
use App\Shop\Domain\Cart\CartRepository;
use App\Shop\Domain\Cart\DTO\CartResponseDTO;
use App\Shop\Domain\Cart\Exceptions\CartExceptions;
use App\Shop\Domain\Product\ProductRepository;

class CheckoutService
{
    public function __construct(private readonly CartRepository $cartRepository, private readonly ProductRepository $productRepository)
    {

    }

    /**
     * @throws CartExceptions
     */
    public function __invoke(int $userid): CartResponseDTO
    {

        $response = new CartResponseDTO();
        $cart = $this->cartRepository->findCartByUserId($userid);

        $this->guardCart($cart);

        $this->checkout($cart, $response);


        $this->cartRepository->deleteCart($cart);

        return $response;
    }

    /**
     * @throws CartExceptions
     */
    private function guardCart($cart): void
    {
        if (!$cart) throw CartExceptions::cartNotFound();

    }


    public function checkout(Cart $cart, CartResponseDTO $response): void
    {
        foreach ($cart->getProducts() as $cartItem) {
            $response->addToCart($cartItem->getProduct()->getName(), $cartItem->getProduct()->amount()
                , $cartItem->getUds());
            $product = $this->productRepository->find($cartItem->getProduct()->getId());
            $product->setStock($product->getStock() - $cartItem->getUds());
            $this->productRepository->saveProduct($product);

        }

        $response->setTotal($cart->getTotal());
    }


}