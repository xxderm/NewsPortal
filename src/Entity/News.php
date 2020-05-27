<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass="App\Repository\NewsRepository")
 */
class News
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
	public function getId()
	{
		return $this->id;
	}
	public function setId($id)
	{
		$this->id = $id;
	}
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Title;
	public function getTitle()
	{
		return $this->Title;
	}
	public function setTitle($title)
	{
		$this->Title = $title;
	}
    /**
     * @ORM\Column(type="string", length=255)
	 *
     */
    private $Description;
	public function getDescription()
	{
		return $this->Description;
	}
	public function setDescription($description)
	{
		$this->Description = $description;
	}
    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $Date;
	public function getDate()
	{
		return $this->Date;
	}
	public function setDate($date)
	{
		$this->Date = $date;
	}
    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $Content;
	public function getContent()
	{
		return $this->Content;
	}
	public function setContent($content)
	{
		$this->Content = $content;
	}
    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $User_id;
	public function getUserId()
	{
		return $this->User_id;
	}
	public function setUserId($UserId)
	{
		$this->User_id = $UserId;
	}
	/**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $Entity_id;
	public function getEntityId()
	{
		return $this->Entity_id;
	}
	public function setEntityId($EntityId)
	{
		$this->Entity_id = $EntityId;
	}
    
}