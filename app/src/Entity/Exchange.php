<?php

namespace App\Entity;

use App\Repository\ExchangeRepository;
use CrEOF\Spatial\PHP\Types\Geometry\Point;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExchangeRepository::class)
 * @ORM\Table(indexes={@ORM\Index(columns={"pt"}, flags={"spatial"})})
 */
class Exchange
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $addressLine1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $addressLine2;

    /**
     * @ORM\ManyToOne(targetEntity=Place::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $zipCode;

    /**
     * @ORM\Column(type="point")
     */
    private $pt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddressLine1(): ?string
    {
        return $this->addressLine1;
    }

    public function setAddressLine1(string $addressLine1): self
    {
        $this->addressLine1 = $addressLine1;

        return $this;
    }

    public function getAddressLine2(): ?string
    {
        return $this->addressLine2;
    }

    public function setAddressLine2(?string $addressLine2): self
    {
        $this->addressLine2 = $addressLine2;

        return $this;
    }

    public function getCity(): ?Place
    {
        return $this->city;
    }

    public function setCity(?Place $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getPt(): ?Point
    {
        return $this->pt;
    }

    public function setPt(Point $pt): self
    {
        $this->pt = $pt;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
