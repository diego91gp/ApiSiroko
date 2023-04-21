<?php

namespace App\Shop\Application\Query;

use App\Shop\Domain\Cart\CartRepository;
use App\Shop\Domain\Cart\Exceptions\CartExceptions;

class ShowCartQueryHandler
{
    public function __construct(private readonly CartRepository $cartRepository)
    {

    }

    /**
     * @throws CartExceptions
     */
    public function __invoke(ShowCartQuery $query): array
    {
        $cart = $this->cartRepository->findCartByUserId($query->getUserId());

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