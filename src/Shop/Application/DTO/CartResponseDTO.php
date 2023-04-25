<?php

namespace App\Shop\Application\DTO;

use App\Shop\Domain\Cart\Cart;

class CartResponseDTO
{
    private array $products = [];
    private float $total = 0;

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return number_format($this->total, 2);
    }


    public function setTotal(float $total): void
    {
        $this->total = $total;
    }


    public function addToCart(string $name, float $unitPrice, int $uds): void
    {
        $this->products[] =
            [
                'name' => $name,
                'unitPrice' => $unitPrice,
                'uds' => $uds
            ];
    }

    public static function assemble(Cart $cart): self
    {
        $cartDTO = new self();
        foreach ($cart->getProducts() as $cartItem) {
            $cartDTO->addToCart($cartItem->getProduct()->getName(), $cartItem->getProduct()->amount()
                , $cartItem->getUds());
        }
        return $cartDTO;
    }

    public function getProducts(): array
    {
        if ($this->total != 0) {
            $this->products[] = [
                'total' => number_format($this->total, 2)
            ];
        }
        return $this->products;
    }
}