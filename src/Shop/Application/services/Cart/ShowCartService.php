<?php

namespace App\Shop\Application\services\Cart;

use App\Shop\Domain\Cart\CartRepository;
use App\Shop\Domain\Cart\DTO\CartResponseDTO;
use App\Shop\Domain\Cart\Exceptions\CartExceptions;

class ShowCartService
{
    public function __construct(private readonly CartRepository $cartRepository)
    {

    }

    /**
     * @throws CartExceptions
     */
    public function __invoke(int $userID): CartResponseDTO
    {
        $cart = $this->cartRepository->findCartByUserId($userID);
        $this->guardProducts($cart);

        return $cart->resume();
    }

    /**
     * @throws CartExceptions
     */
    private function guardProducts($cart): void
    {
        if (!$cart) throw CartExceptions::cartNotFound();

    }


}