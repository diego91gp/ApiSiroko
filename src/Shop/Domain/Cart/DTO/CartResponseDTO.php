<?php

namespace App\Shop\Domain\Cart\DTO;
class CartResponseDTO
{
    private array $products = [];
    private float $total = 0;


    public function setTotal(string $total): void
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

    public function getProducts(): array
    {
        if ($this->total != 0) {
            $this->products[] = [
                'total' => round($this->total, 2)
            ];
        }
        return $this->products;
    }
}