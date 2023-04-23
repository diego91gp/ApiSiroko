<?php /** @noinspection PhpMultipleClassDeclarationsInspection */


namespace App\Shop\Infrastructure\Persistence\Doctrine\Repository;

use App\Shop\Domain\Product\Product;
use App\Shop\Domain\Product\ProductRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class DoctrineProductRepositoryImpl extends ServiceEntityRepository implements ProductRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function saveProduct(Product $product): void
    {
        $this->getEntityManager()->persist($product);
        $this->getEntityManager()->flush();
    }

    public function deleteProduct(Product $product): void
    {
        $this->getEntityManager()->remove($product);
        $this->getEntityManager()->flush();

    }

    public function findById(int $productId): ?Product
    {
        return $this->find($productId);
    }
}
