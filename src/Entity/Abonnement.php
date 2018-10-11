<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AbonnementRepository")
 */
class Abonnement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numero_abonnement;

    /**
     * @ORM\Column(type="date")
     */
    private $date_abonnement;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Compteur", mappedBy="abonnement", orphanRemoval=true)
     */
    private $compteurs;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="abonnements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    public function __construct()
    {
        $this->compteurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroAbonnement(): ?string
    {
        return $this->numero_abonnement;
    }

    public function setNumeroAbonnement(string $numero_abonnement): self
    {
        $this->numero_abonnement = $numero_abonnement;

        return $this;
    }

    public function getDateAbonnement(): ?\DateTimeInterface
    {
        return $this->date_abonnement;
    }

    public function setDateAbonnement(\DateTimeInterface $date_abonnement): self
    {
        $this->date_abonnement = $date_abonnement;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Compteur[]
     */
    public function getCompteurs(): Collection
    {
        return $this->compteurs;
    }

    public function addCompteur(Compteur $compteur): self
    {
        if (!$this->compteurs->contains($compteur)) {
            $this->compteurs[] = $compteur;
            $compteur->setAbonnement($this);
        }

        return $this;
    }

    public function removeCompteur(Compteur $compteur): self
    {
        if ($this->compteurs->contains($compteur)) {
            $this->compteurs->removeElement($compteur);
            // set the owning side to null (unless already changed)
            if ($compteur->getAbonnement() === $this) {
                $compteur->setAbonnement(null);
            }
        }

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

}
