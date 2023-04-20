<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace App\Shop\Infrastructure\Persistence\Doctrine\Repository;


use App\Shop\Domain\Cart\CartItem;
use App\Shop\Domain\Cart\CartItemRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;


class CartItemRepositoryImpl extends ServiceEntityRepository implements CartItemRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CartItem::class);
    }

    public function saveItem(CartItem $cartItem): void
    {
        $this->getEntityManager()->persist($cartItem);

        $this->getEntityManager()->flush();
    }

    public function deleteCartItem(CartItem $cartItem): void
    {
        $this->getEntityManager()->remove($cartItem);
        $this->getEntityManager()->flush();
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findByCartIdAndProductId(int $cartId, int $productId): ?CartItem
    {
        $queryBuilder = $this->createQueryBuilder('ci');
        $queryBuilder
            ->where('ci.product = :productId')
            ->andWhere('ci.cart = :cartId')
            ->setParameters([
                'productId' => $productId,
                'cartId' => $cartId,
            ]);
        $query = $queryBuilder->getQuery();
        return $query->getOneOrNullResult();
    }


}
