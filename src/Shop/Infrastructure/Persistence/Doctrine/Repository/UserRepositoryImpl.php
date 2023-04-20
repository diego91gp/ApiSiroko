<?php /** @noinspection PhpMultipleClassDeclarationsInspection */


namespace App\Shop\Infrastructure\Persistence\Doctrine\Repository;

use App\Shop\Domain\User\User;
use App\Shop\Domain\User\UserRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class UserRepositoryImpl extends ServiceEntityRepository implements UserRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }


    public function saveUser(User $user): void
    {
        $this->getEntityManager()->persist($user);


        $this->getEntityManager()->flush();
    }

    public function deleteUser(User $user): void
    {
        $this->getEntityManager()->remove($user);


        $this->getEntityManager()->flush();
    }

    public function findById(int $userId): User
    {
        return $this->find($userId);
    }
}
