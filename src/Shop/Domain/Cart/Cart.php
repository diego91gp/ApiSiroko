<?php

namespace App\Shop\Domain\Cart;

use App\Shop\Domain\Cart\Exceptions\CartExceptions;
use App\Shop\Domain\Product\Product;
use App\Shop\Domain\User\User;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;


class Cart
{
    private int $id;
    private User $user;

    private DateTime $createdAt;

    private Collection $products;

    public function __construct(User $user)
    {
        $this->createdAt = new DateTime('now');
        $this->user = $user;
        $this->products = new ArrayCollection();
    }

    public function getUser(): User
    {
        return $this->user;
    }


    public function getTotal(): float
    {
        $total = 0;
        foreach ($this->products as $cartItem) {
            $total += $cartItem->getUds() * $cartItem->getProduct()->amount();

        }
        return $total;
    }

    /**
     * @throws CartExceptions
     */
    public function findItemInCart(int $idItem): CartItem
    {
        foreach ($this->getProducts() as $item) {
            if ($item->getProductId() == $idItem) {
                return $item;
            }
        }
        throw CartExceptions::deleteItemError();
    }

    public function addItemsToCart(Product $product, int $uds): self
    {
        foreach ($this->getProducts() as $cartItem) {
            if ($cartItem instanceof CartItem && $cartItem->getProduct() === $product) {
                $cartItem->setUds($cartItem->getUds() + $uds);
                return $this;
            }
        }
        $this->getProducts()->add(new CartItem($product, $this, $uds));
        return $this;
    }


    /**
     * @return Collection
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }


    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }


}
