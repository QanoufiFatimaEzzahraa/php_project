<?php

namespace App\Entity;

use App\Repository\CompteCaisseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompteCaisseRepository::class)]
class CompteCaisse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private string $nomBanque;

    #[ORM\Column]
    private string $nomTitulaire;

    #[ORM\Column(type: 'float')]
    private float $solde;

    

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $dateCreation;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $updatedAt = null;


    public function __construct()
{
   
}

#[ORM\PrePersist]
public function onPrePersist()
{
    $this->dateCreation = new \DateTime();
    $this->updatedAt = new \DateTime();
}

#[ORM\PreUpdate]
public function onPreUpdate()
{
    $this->updatedAt = new \DateTime();
}
    // Ajoutez d'autres propriétés et méthodes selon vos besoins

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomBanque(): string
    {
        return $this->nomBanque;
    }

    public function setNomBanque(string $nomBanque): void
    {
        $this->nomBanque = $nomBanque;
    }

    public function getNomTitulaire(): string
    {
        return $this->nomTitulaire;
    }

    public function setNomTitulaire(string $nomTitulaire): void
    {
        $this->nomTitulaire = $nomTitulaire;
    }

    public function getSolde(): float
    {
        return $this->solde;
    }

    public function setSolde(float $solde): void
    {
        $this->solde = $solde;
    }

  
    public function getDateCreation(): \DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): void
    {
        $this->dateCreation = $dateCreation;
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
