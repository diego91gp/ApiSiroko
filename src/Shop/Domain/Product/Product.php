<?php

namespace App\Shop\Domain\Product;


class Product
{
    private int $id;


    public function __construct(private string $name, private int $stock, private Price $price)
    {
    }

    public function amount(): float
    {
        return $this->price->amount();
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;

    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function setStock(int $stock): void
    {
        $this->stock = $stock;

    }


    public function updatePrice(float $amount, string $currency): void
    {
        $this->price = Price::updatePrice($amount, $currency);

    }
}