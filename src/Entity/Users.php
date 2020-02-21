<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 */
class Users
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
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Email;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Password;

    public function setEmail($email)
    {
        $this->Email = $email;
    }
    public function setPassword($pass)
    {
        $this->Password = $pass;
    }
    public function getEmail()
    {
        return $this->Email;
    }
    public function getPassword()
    {
        return $this->Password;
    }
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