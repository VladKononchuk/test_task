<?php

declare(strict_types=1);

namespace AppBundle\Entity\Owner;

use AppBundle\Entity\Automobile\Automobile;
use AppBundle\Entity\Owner\ValueObject\Email;
use AppBundle\Entity\Owner\ValueObject\StringSize;
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Automobile\Automobile", mappedBy="owner", cascade={"remove"})
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
        $this->automobile = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = (new StringSize($name))->value;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = (new StringSize($surname))->value;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = (new Email($email))->value;
    }

    /**
     * @return Collection|Automobile[]
     */
    public function getAutomobile(): Collection
    {
        return $this->automobile;
    }

    /**
     * @param ArrayCollection $automobile
     */
    public function setAutomobile(ArrayCollection $automobile): void
    {
        $this->automobile = $automobile;
    }

    public function addAutomobile(Automobile $automobile): self
    {
        if (!$this->automobile->contains($automobile)) {
            $this->automobile->add($automobile);
            $automobile->setOwner($this);
        }

        return $this;
    }

    public function __toString()
    {
        return sprintf(
            "%s",
            $this->id
        );
    }
}
