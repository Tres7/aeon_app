<?php

namespace App\Entity;

use App\Repository\ActionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActionRepository::class)]
class Action
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numero = null;

    #[ORM\Column]
    private ?int $minimum_jet = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $estGagnee = null;

    /**
     * @var Collection<int, Carte>
     */
    #[ORM\OneToMany(targetEntity: Carte::class, mappedBy: 'action')]
    private Collection $cartes;

    #[ORM\ManyToOne(inversedBy: 'actions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CategorieAction $categorie = null;

    /**
     * @var Collection<int, PersonnageDialogue>
     */
    #[ORM\OneToMany(targetEntity: PersonnageDialogue::class, mappedBy: 'action', orphanRemoval: true)]
    private Collection $personnageDialogues;

    public function __construct()
    {
        $this->cartes = new ArrayCollection();
        $this->personnageDialogues = new ArrayCollection();
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

    public function getMinimumJet(): ?int
    {
        return $this->minimum_jet;
    }

    public function setMinimumJet(int $minimum_jet): static
    {
        $this->minimum_jet = $minimum_jet;

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

    public function isEstGagnee(): ?bool
    {
        return $this->estGagnee;
    }

    public function setEstGagnee(bool $estGagnee): static
    {
        $this->estGagnee = $estGagnee;

        return $this;
    }

    /**
     * @return Collection<int, Carte>
     */
    public function getCartes(): Collection
    {
        return $this->cartes;
    }

    public function addCarte(Carte $carte): static
    {
        if (!$this->cartes->contains($carte)) {
            $this->cartes->add($carte);
            $carte->setAction($this);
        }

        return $this;
    }

    public function removeCarte(Carte $carte): static
    {
        if ($this->cartes->removeElement($carte)) {
            // set the owning side to null (unless already changed)
            if ($carte->getAction() === $this) {
                $carte->setAction(null);
            }
        }

        return $this;
    }

    public function getCategorie(): ?CategorieAction
    {
        return $this->categorie;
    }

    public function setCategorie(?CategorieAction $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, PersonnageDialogue>
     */
    public function getPersonnageDialogues(): Collection
    {
        return $this->personnageDialogues;
    }

    public function addPersonnageDialogue(PersonnageDialogue $personnageDialogue): static
    {
        if (!$this->personnageDialogues->contains($personnageDialogue)) {
            $this->personnageDialogues->add($personnageDialogue);
            $personnageDialogue->setAction($this);
        }

        return $this;
    }

    public function removePersonnageDialogue(PersonnageDialogue $personnageDialogue): static
    {
        if ($this->personnageDialogues->removeElement($personnageDialogue)) {
            // set the owning side to null (unless already changed)
            if ($personnageDialogue->getAction() === $this) {
                $personnageDialogue->setAction(null);
            }
        }

        return $this;
    }
}
