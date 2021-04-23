<?php

namespace App\Entity;

use App\Repository\PlaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * @ORM\Entity(repositoryClass="Gedmo\Tree\Entity\Repository\NestedTreeRepository")
 * @Gedmo\Tree(type="nested")
 */
class Place
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Gedmo\TreeLeft
     */
    private $lft;

    /**
     * @ORM\Column(type="integer")
     * @Gedmo\TreeLevel
     */
    private $lvl;

    /**
     * @ORM\Column(type="integer")
     * @Gedmo\TreeRight
     */
    private $rgt;

    /**
     * @ORM\ManyToOne(targetEntity=Place::class)
     * @ORM\JoinColumn(referencedColumnName="id", onDelete="CASCADE")
     * @Gedmo\TreeRoot
     */
    private $root;

    /**
     * @ORM\ManyToOne(targetEntity=Place::class, inversedBy="children")
     * @ORM\JoinColumn(referencedColumnName="id", onDelete="CASCADE")
     * @Gedmo\TreeParent
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity=Place::class, mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private $children;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $code;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRoot(): ?self
    {
        return $this->root;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
