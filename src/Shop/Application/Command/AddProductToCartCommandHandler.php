<?php

namespace App\Shop\Application\Command;

use App\Shop\Domain\Cart\CartRepository;

class AddProductToCartCommandHandler
{
    public function __construct(

        private readonly CartRepository $cartRepository)
    {

    }

    public function __invoke(AddProductToCartCommand $command): void
    {
        $this->cartRepository->saveCart($command->getCart());
    }


//DTO
}