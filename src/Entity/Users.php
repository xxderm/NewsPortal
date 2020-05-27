<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
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
     * @Assert\NotBlank(message="Name: value should not be blank")
     * @Assert\Length(
     *      min = 4,
     *      max = 20,
     *      minMessage = "Name must be at least 4 characters long",
     *      maxMessage = "Name cannot be longer than 20 characters"
     * )
     */
    private $Name;
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     *      message = "The email '{{ value }}' is not a valid email."
     * )
     * @Assert\NotBlank(message="Email: value should not be blank")
     */
    private $Email;
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Password: value should not be blank")
     * @Assert\Length(
     *      min = 4,
     *      max = 50,
     *      minMessage = "Password must be at least 4 characters long",
     *      maxMessage = "Password cannot be longer than 50 characters"
     * )
     */
    private $Password;
    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $Role_id;
    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $Regdate;
    public function setRegDate($regdate)
    {
        $this->Regdate = $regdate;
    }
    public function getRegDate()
    {
        return $this->Regdate;
    }
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
    public function getRoleId()
    {
        return $this->Role_id;
    }
    public function setRoleId($role)
    {
        $this->Role_id = $role;
    }
    public function setName($name)
    {
        $this->Name = $name;
    }
}