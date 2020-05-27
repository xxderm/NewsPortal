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
	public function findEntitiesByName($Name)
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery('
            SELECT u 
            FROM App\Entity\Entities u 
            WHERE u.Name = :name
            ORDER BY u.Name ASC
        ')->setParameter('name', $Name);
        return $query->getResult();
    }
    public function findEntitiesById($id)
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery('
            SELECT u 
            FROM App\Entity\Entities u 
            WHERE u.id = :id
            ORDER BY u.Name ASC
        ')->setParameter('id', $id);
        return $query->getResult();
    }
}