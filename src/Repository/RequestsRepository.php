<?php
namespace App\Repository;
use App\Entity\Users;
use App\Entity\Entities;
use App\Entity\News;
use App\Entity\Requests;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityRepository;
use http\QueryString;

class RequestsRepository extends EntityRepository
{
    public function findReqById($id)
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery('
            SELECT u 
            FROM App\Entity\Requests u 
            WHERE u.id = :id
            ORDER BY u.Title ASC
        ')->setParameter('id', $id);
        return $query->getResult();
    }
    public function findAllReq()
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery('
            SELECT u 
            FROM App\Entity\Requests u 
            ORDER BY u.Title ASC
        ');
        return $query->getResult();
    }
}