<?php

namespace App\Entity;

use App\Repository\CarteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarteRepository::class)]
class Carte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numero = null;

    #[ORM\Column]
    private ?bool $estActivee = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $statut = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $estFusionnable = null;

    #[ORM\Column]
    private ?bool $estFusionnee = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): static
    {
        $this->numero = $numero;

        return $this;
    }

    public function isEstActivee(): ?bool
    {
        return $this->estActivee;
    }

    public function setEstActivee(bool $estActivee): static
    {
        $this->estActivee = $estActivee;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function isEstFusionnable(): ?bool
    {
        return $this->estFusionnable;
    }

    public function setEstFusionnable(bool $estFusionnable): static
    {
        $this->estFusionnable = $estFusionnable;

        return $this;
    }

    public function isEstFusionnee(): ?bool
    {
        return $this->estFusionnee;
    }

    public function setEstFusionnee(bool $estFusionnee): static
    {
        $this->estFusionnee = $estFusionnee;

        return $this;
    }
}
