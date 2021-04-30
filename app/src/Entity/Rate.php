<?php

namespace App\Entity;

use App\Repository\RateRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=RateRepository::class)
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(columns={"exchange_id", "currency_source_id", "currency_target_id", "order_type_id"})})
 */
class Rate
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity=Exchange::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $exchange;

    /**
     * @ORM\ManyToOne(targetEntity=Currency::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $currencySource;

    /**
     * @ORM\ManyToOne(targetEntity=Currency::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $currencyTarget;

    /**
     * @ORM\ManyToOne(targetEntity=OrderType::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $orderType;

    /**
     * @ORM\Column(type="integer")
     */
    private $value;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updatedAt;

    public function getExchange(): ?Exchange
    {
        return $this->exchange;
    }

    public function setExchange(?Exchange $exchange): self
    {
        $this->exchange = $exchange;

        return $this;
    }

    public function getCurrencySource(): ?Currency
    {
        return $this->currencySource;
    }

    public function setCurrencySource(?Currency $currencySource): self
    {
        $this->currencySource = $currencySource;

        return $this;
    }

    public function getCurrencyTarget(): ?Currency
    {
        return $this->currencyTarget;
    }

    public function setCurrencyTarget(?Currency $currencyTarget): self
    {
        $this->currencyTarget = $currencyTarget;

        return $this;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getOrderType(): ?OrderType
    {
        return $this->orderType;
    }

    public function setOrderType(?OrderType $orderType): self
    {
        $this->orderType = $orderType;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setIUpdateAt(\DateTimeInterface $updatedAt): self
    {
        $this->createdAt = $updatedAt;

        return $this;
    }
}
