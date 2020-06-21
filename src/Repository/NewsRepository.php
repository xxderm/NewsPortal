<?php
namespace App\Repository;
use App\Entity\Users;
use App\Entity\Entities;
use App\Entity\News;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityRepository;
use http\QueryString;

class NewsRepository extends EntityRepository
{
    public function findNewsById($id)
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery('
            SELECT u 
            FROM App\Entity\News u 
            WHERE u.id = :id
            ORDER BY u.Date DESC
        ')->setParameter('id', $id);
        return $query->getResult();
    }
    public function findAllNews()
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery('
            SELECT u 
            FROM App\Entity\News u 
            ORDER BY u.Date DESC
        ');
        return $query->getResult();
    }
    public function findNewsByEntityID($id)
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery('
            SELECT u 
            FROM App\Entity\News u 
            WHERE u.Entity_id = :id
            ORDER BY u.Date DESC
        ')->setParameter('id', $id);
        return $query->getResult();
    }
}