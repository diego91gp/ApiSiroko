<?php

namespace App\Shop\Application\Query;

use App\Shared\Application\Symfony\QueryHandlerInterface;
use App\Shop\Application\DTO\CartResponseDTO;
use App\Shop\Domain\Cart\CartRepository;
use App\Shop\Domain\Cart\Exceptions\CartExceptions;

class ShowCartQueryHandler implements QueryHandlerInterface
{
    public function __construct(private readonly CartRepository $cartRepository)
    {

    }

    /**
     * @throws CartExceptions
     */
    public function __invoke(ShowCartQuery $query): CartResponseDTO

    {
        $cart = $this->cartRepository->findCartByUserId($query->getUserId());

        $this->guardProducts($cart);
        

        return CartResponseDTO::assemble($cart);
    }

    /**
     * @throws CartExceptions
     */
    private function guardProducts($cart): void
    {
        if (!$cart) throw CartExceptions::cartNotFound();

    }


}