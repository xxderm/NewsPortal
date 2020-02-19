<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\Repository\EntitiesRepository")
 */
class Entities
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;
    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->Name;
    }
    public function setName($name)
    {
        $this->Name = $name;
    }
}