<?php

declare(strict_types=1);

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Owner\OwnerRepository")
 * @ORM\Table(name="owner")
 */
class Owner
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="Automobile", mappedBy="owner")
     */
    private $automobile;

    /**
     * @ORM\Column(type="string", length=50, options={"minLength": 3, "maxLength": 50})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50, options={"minLength": 3, "maxLength": 50})
     */
    private $surname;

    /**
     * @ORM\Column(type="string", length=50, options={"minLength": 3, "maxLength": 50})
     */
    private $email;

    public function __construct()
    {
        $this->automobile  = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return Collection|Automobile[]
     */
    public function getAutomobile(): Collection
    {
        return $this->automobile;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
}