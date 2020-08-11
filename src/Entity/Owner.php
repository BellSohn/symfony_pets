<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * Owner
 *
 * @ORM\Table(name="owners")
 * @ORM\Entity
 */
class Owner
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
     * @ORM\Column(name="name", type="string", length=250, nullable=true)
       @Assert\NotBlank
       @Assert\Regex("/[a-zA-Z]+/")
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="surname", type="string", length=250, nullable=true)
       @Assert\NotBlank
       @Assert\Regex("/[a-zA-Z]+/")
     */
    private $surname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="telephone", type="string", length=250, nullable=true)
       @Assert\NotBlank
       
     */
    private $telephone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="address", type="string", length=250, nullable=true)
       @Assert\NotBlank
       @Assert\Regex("/[a-zA-Z]+/")
     */
    private $address;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
       @Assert\NotBlank
       @Assert\Email(
                message = "The email '{{ value }}' is not valid"
       )
     */
    private $email;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;




    

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Animal",mappedBy="owner")
    */
    private $animals;

    public function __construct(){

        $this->animals = new ArrayCollection();

    }



    public function getId(): ?int
    {
        return $this->id;
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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

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
    *@return Collection|Animal[]
    */
    public function getAnimals():Collection {

        return $this->animals;
    }




}
