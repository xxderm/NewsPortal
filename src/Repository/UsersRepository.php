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
    public function findUserById($id)
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery('
            SELECT u 
            FROM App\Entity\Users u 
            WHERE u.id = :id
            ORDER BY u.Name ASC
        ')->setParameter('id', $id);
        return $query->getResult();
    }
    public function findUserByPasswordHash($password)
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery('
            SELECT u 
            FROM App\Entity\Users u 
            WHERE u.Password = MD5(:Pass)
            ORDER BY u.Name ASC
        ')->setParameter('Pass', $password);
        return $query->getResult();
    }
}