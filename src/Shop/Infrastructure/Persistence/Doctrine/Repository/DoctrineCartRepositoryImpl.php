<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace App\Shop\Infrastructure\Persistence\Doctrine\Repository;

use App\Shop\Domain\Cart\Cart;
use App\Shop\Domain\Cart\CartRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;


class DoctrineCartRepositoryImpl extends ServiceEntityRepository implements CartRepository
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


    /**
     * @throws NonUniqueResultException
     */
    public function findCartByUserId(int $userId): ?Cart
    {


        $queryBuilder = $this->createQueryBuilder('c');
        $queryBuilder
            ->select('a')
            ->from(Cart::class, 'a')
            ->where('a.user = :userId')
            ->setParameter('userId', $userId);

        return $queryBuilder->getQuery()->getOneOrNullResult();

    }
}
