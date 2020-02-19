<?php
namespace App\Repository;
use Doctrine\ORM\EntityRepository;
class EntitiesRepository extends EntityRepository
{
    public function findAll()
    {
        return $this->getEntityManager()->createQuery(
            'SELECT e FROM App:Entities e ORDER BY e.Name ASC'
        )->getResult();
    }
}