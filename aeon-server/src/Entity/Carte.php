<?php

namespace App\Entity;

use App\Repository\CarteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\ManyToOne(inversedBy: 'cartes')]
    private ?Action $action = null;

    #[ORM\ManyToOne(inversedBy: 'cartes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CategorieCarte $categorie = null;

    /**
     * @var Collection<int, Partie>
     */
    #[ORM\ManyToMany(targetEntity: Partie::class, inversedBy: 'cartes')]
    #[ORM\JoinTable(name:"carte_partie")]
    private Collection $parties;

    /**
     * @var Collection<int, Fusion>
     */
    #[ORM\ManyToMany(targetEntity: Fusion::class, inversedBy: 'cartes')]
    #[ORM\JoinTable(name:"fusion_carte")]
    private Collection $fusions;

    public function __construct()
    {
        $this->parties = new ArrayCollection();
        $this->fusions = new ArrayCollection();
    }

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

    public function getAction(): ?Action
    {
        return $this->action;
    }

    public function setAction(?Action $action): static
    {
        $this->action = $action;

        return $this;
    }

    public function getCategorie(): ?CategorieCarte
    {
        return $this->categorie;
    }

    public function setCategorie(?CategorieCarte $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, Partie>
     */
    public function getPartie(): Collection
    {
        return $this->parties;
    }

    public function addPartie(Partie $parties): static
    {
        if (!$this->parties->contains($parties)) {
            $this->parties->add($parties);
        }

        return $this;
    }

    public function removePartie(Partie $partie): static
    {
        $this->parties->removeElement($partie);

        return $this;
    }

    /**
     * @return Collection<int, Fusion>
     */
    public function getFusion(): Collection
    {
        return $this->fusions;
    }

    public function addFusion(Fusion $fusions): static
    {
        if (!$this->fusions->contains($fusions)) {
            $this->fusions->add($fusions);
        }

        return $this;
    }

    public function removeFusion(Fusion $fusions): static
    {
        $this->fusions->removeElement($fusions);

        return $this;
    }
}
