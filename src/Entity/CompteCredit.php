<?php

namespace App\Entity;

use App\Repository\CompteCreditRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CompteCreditRepository::class)]
#[ORM\HasLifecycleCallbacks]
class CompteCredit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank]
    private string $type;

    #[ORM\Column(type: 'string', length: 100)]
    #[Assert\NotBlank]
    private string $nomBanque;

    #[ORM\Column(type: 'string', length: 100)]
    #[Assert\NotBlank]
    private string $name;

    #[ORM\Column(type: 'datetime')] // Modification du type de données
    private \DateTimeInterface $expirationDate;

    #[ORM\Column(type: 'string', length: 4)]
    #[Assert\NotBlank]
    #[Assert\Regex("/^[0-9]{3,4}$/", message: "Le CVV doit être composé de 3 ou 4 chiffres.")]
    private string $cvv;

    #[ORM\Column(type: 'float')]
    #[Assert\NotBlank]
    #[Assert\Positive]
    private float $creditLimit;

    #[ORM\Column(type: 'float')]
    #[Assert\NotBlank]
    #[Assert\PositiveOrZero]
    private float $availableCredit;

    #[ORM\Column(type: 'float')]
    #[Assert\NotBlank]
    #[Assert\PositiveOrZero]
    private float $minimumPayment;

    #[ORM\Column(type: 'float')]
    #[Assert\NotBlank]
    #[Assert\PositiveOrZero]
    private float $interestRate;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $updatedAt;

    // Event listeners
    #[ORM\PrePersist]
    public function onPrePersist()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    #[ORM\PreUpdate]
    public function onPreUpdate()
    {
        $this->updatedAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getNomBanque(): string
    {
        return $this->nomBanque;
    }

    public function setNomBanque(string $nomBanque): void
    {
        $this->nomBanque = $nomBanque;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getExpirationDate(): \DateTimeInterface
    {
        return $this->expirationDate;
    }

    public function setExpirationDate(\DateTimeInterface $expirationDate): void
    {
        $this->expirationDate = $expirationDate;
    }

    public function getCvv(): string
    {
        return $this->cvv;
    }

    public function setCvv(string $cvv): void
    {
        $this->cvv = $cvv;
    }

    public function getCreditLimit(): float
    {
        return $this->creditLimit;
    }

    public function setCreditLimit(float $creditLimit): void
    {
        $this->creditLimit = $creditLimit;
    }

    public function getAvailableCredit(): float
    {
        return $this->availableCredit;
    }

    public function setAvailableCredit(float $availableCredit): void
    {
        $this->availableCredit = $availableCredit;
    }

    public function getMinimumPayment(): float
    {
        return $this->minimumPayment;
    }

    public function setMinimumPayment(float $minimumPayment): void
    {
        $this->minimumPayment = $minimumPayment;
    }

    public function getInterestRate(): float
    {
        return $this->interestRate;
    }

    public function setInterestRate(float $interestRate): void
    {
        $this->interestRate = $interestRate;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
