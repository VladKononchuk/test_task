<?php

declare(strict_types=1);

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Automobile\AutomobileRepository")
 * @ORM\Table(name="automobile")
 */
class Automobile
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, options={"minLength": 3, "maxLength": 100})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100, options={"minLength": 3, "maxLength": 100})
     */
    private $brand;

    /**
     * @ORM\Column(type="float")
     */
    private $mileage;

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
        $this->name = $name;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    public function getMileage(): ?float
    {
        return $this->mileage;
    }

    public function setMileage(float $mileage): void
    {
        $this->mileage = $mileage;
    }
}