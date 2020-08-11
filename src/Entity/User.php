<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;

//use Symfony\Component\Security\Core\User\UserInteface; 
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class User implements UserInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="role", type="string", length=100, nullable=true)     
     */
    private $role;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=250, nullable=true)
       @Assert\NotBlank
       @Assert\Regex("/[a-zA-Z]+/") 
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="surname", type="string", length=255, nullable=true)
       @Assert\NotBlank
       @Assert\Regex("/[a-zA-Z]+/") 
     */
    private $surname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
       @Assert\NotBlank
       @Assert\Email (
                message = "The email '{{ value }}' is not valid",
       )
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
       @Assert\NotBlank 
     */
    private $password;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Task",mappedBy="user")
    */
    private $tasks;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Treatement",mappedBy="user")
    */
    private $treatements;

    public function __construct(){
        
        $this->tasks = new ArrayCollection();
        $this->treatements = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(?string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
    *@return Collection|Task[]
    */
    public function getTasks():Collection{
        return $this->tasks;
    }

    /**
    *@return Collection|Treatement[]
    */
    public function getTreatements():Collection{
        return $this->treatements;
    }



    /*estos son los métodos que nos obliga la interface*/

    /*this is the username of the aplication*/
    public function getUserName(){
        return $this->email;
    }


    public function getSalt(){
        return null;
    }

    public function getRoles(){
        
        
        $roles = array();
       array_push($roles, $this->getRole());
        return $roles;
        
        

        /*si quisieramos hacerlo dinamico*/
        //return $this->getRole();
        //return array($this->getRole());
       //return array('ROLE_USER');/*en este caso lo hacemos fijo*/
    }

    /*metodo vacio, necesario para que la autenticación funcione*/
    public function eraseCredentials(){

    }




}
