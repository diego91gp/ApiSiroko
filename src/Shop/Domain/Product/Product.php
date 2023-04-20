<?php

namespace App\Shop\Domain\Product;


class Product
{
    private int $id;
    private string $name;
    private int $stock;
    private Price $price;

    public function __construct(string $name, int $stock, Price $price)
    {
        $this->name = $name;
        $this->stock = $stock;
        $this->price = $price;

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

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getPrice(): Price
    {
        return $this->price;
    }

    public function setPrice(Price $price): self
    {
        $this->price = $price;

        return $this;
    }
}
