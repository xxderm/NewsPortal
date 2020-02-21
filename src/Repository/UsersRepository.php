<?php
namespace App\Repository;
use App\Entity\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityRepository;
use http\QueryString;

class UsersRepository extends EntityRepository
{
    public function findUserByName($name)
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery('
            SELECT u 
            FROM App\Entity\Users u 
            WHERE u.Name = :Name
            ORDER BY u.Name ASC
        ')->setParameter('Name', $name);
        return $query->getResult();
    }
}