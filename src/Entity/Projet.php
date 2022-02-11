<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjetRepository::class)
 */
class Projet
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     */
    private $min_salaire;

    /**
     * @ORM\Column(type="float")
     */
    private $max_salaire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity=user::class, inversedBy="projets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=Proposition::class, mappedBy="projet", orphanRemoval=true)
     */
    private $propositions;

    /**
     * @ORM\ManyToMany(targetEntity=Competence::class, mappedBy="projet")
     */
    private $competences;

    /**
     * @ORM\OneToOne(targetEntity=Reclamation::class, mappedBy="projet", cascade={"persist", "remove"})
     */
    private $reclamation;

    /**
     * @ORM\OneToMany(targetEntity=Fichier::class, mappedBy="projet", orphanRemoval=true)
     */
    private $fichiers;

    public function __construct()
    {
        $this->propositions = new ArrayCollection();
        $this->competences = new ArrayCollection();
        $this->fichiers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMinSalaire(): ?float
    {
        return $this->min_salaire;
    }

    public function setMinSalaire(float $min_salaire): self
    {
        $this->min_salaire = $min_salaire;

        return $this;
    }

    public function getMaxSalaire(): ?float
    {
        return $this->max_salaire;
    }

    public function setMaxSalaire(float $max_salaire): self
    {
        $this->max_salaire = $max_salaire;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Proposition[]
     */
    public function getPropositions(): Collection
    {
        return $this->propositions;
    }

    public function addProposition(Proposition $proposition): self
    {
        if (!$this->propositions->contains($proposition)) {
            $this->propositions[] = $proposition;
            $proposition->setProjet($this);
        }

        return $this;
    }

    public function removeProposition(Proposition $proposition): self
    {
        if ($this->propositions->removeElement($proposition)) {
            // set the owning side to null (unless already changed)
            if ($proposition->getProjet() === $this) {
                $proposition->setProjet(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Competence[]
     */
    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function addCompetence(Competence $competence): self
    {
        if (!$this->competences->contains($competence)) {
            $this->competences[] = $competence;
            $competence->addProjet($this);
        }

        return $this;
    }

    public function removeCompetence(Competence $competence): self
    {
        if ($this->competences->removeElement($competence)) {
            $competence->removeProjet($this);
        }

        return $this;
    }

    public function getReclamation(): ?Reclamation
    {
        return $this->reclamation;
    }

    public function setReclamation(Reclamation $reclamation): self
    {
        // set the owning side of the relation if necessary
        if ($reclamation->getProjet() !== $this) {
            $reclamation->setProjet($this);
        }

        $this->reclamation = $reclamation;

        return $this;
    }

    /**
     * @return Collection|Fichier[]
     */
    public function getFichiers(): Collection
    {
        return $this->fichiers;
    }

    public function addFichier(Fichier $fichier): self
    {
        if (!$this->fichiers->contains($fichier)) {
            $this->fichiers[] = $fichier;
            $fichier->setProjet($this);
        }

        return $this;
    }

    public function removeFichier(Fichier $fichier): self
    {
        if ($this->fichiers->removeElement($fichier)) {
            // set the owning side to null (unless already changed)
            if ($fichier->getProjet() === $this) {
                $fichier->setProjet(null);
            }
        }

        return $this;
    }
}
