<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace App\Shop\Infrastructure\Persistence\Doctrine\Repository;

use App\Shop\Domain\Cart\Cart;
use App\Shop\Domain\Cart\CartRepository;
use App\Shop\Domain\User\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class CartRepositoryImpl extends ServiceEntityRepository implements CartRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cart::class);
    }

    public function saveCart(Cart $cart): void
    {
        $this->getEntityManager()->persist($cart);
        $this->getEntityManager()->flush();
    }

    public function deleteCart(Cart $cart): void
    {
        $this->getEntityManager()->remove($cart);
        $this->getEntityManager()->flush();
    }

    public function findCartById(int $cartId)
    {
        return $this->find($cartId);
    }


    public function findCartByUserId(int $userId): ?Cart
    {
        return $this->getEntityManager()->find(User::class, $userId);

    }
}
