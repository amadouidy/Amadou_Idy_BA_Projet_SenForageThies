<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CompteurRepository")
 */
class Compteur
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
    private $numero_compteur;

    /**
     * @ORM\Column(type="integer")
     */
    private $ancien_releve;

    /**
     * @ORM\Column(type="integer")
     */
    private $nouveau_releve;

    /**
     * @ORM\Column(type="date")
     */
    private $date_releve;

    /**
     * @ORM\Column(type="integer")
     */
    private $consommation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Abonnement", inversedBy="compteurs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $abonnement;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Facture", mappedBy="compteur", cascade={"persist", "remove"})
     */
    private $facture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroCompteur(): ? string
    {
        return $this->numero_compteur;
    }

    public function setNumeroCompteur(string $numero_compteur): self
    {
        $this->numero_compteur = $numero_compteur;

        return $this;
    }

    public function getAncienReleve(): ?int
    {
        return $this->ancien_releve;
    }

    public function setAncienReleve(int $ancien_releve): self
    {
        $this->ancien_releve = $ancien_releve;

        return $this;
    }

    public function getNouveauReleve(): ?int
    {
        return $this->nouveau_releve;
    }

    public function setNouveauReleve(int $nouveau_releve): self
    {
        $this->nouveau_releve = $nouveau_releve;

        return $this;
    }

    public function getDateReleve(): ?\DateTimeInterface
    {
        return $this->date_releve;
    }

    public function setDateReleve(\DateTimeInterface $date_releve): self
    {
        $this->date_releve = $date_releve;

        return $this;
    }

    public function getConsommation(): ?int
    {
        return $this->consommation;
    }

    public function setConsommation(int $consommation): self
    {
        $this->consommation = $consommation;

        return $this;
    }

    public function getAbonnement(): ?Abonnement
    {
        return $this->abonnement;
    }

    public function setAbonnement(?Abonnement $abonnement): self
    {
        $this->abonnement = $abonnement;

        return $this;
    }

    public function getFacture(): ?Facture
    {
        return $this->facture;
    }

    public function setFacture(?Facture $facture): self
    {
        $this->facture = $facture;

        // set (or unset) the owning side of the relation if necessary
        $newCompteur = $facture === null ? null : $this;
        if ($newCompteur !== $facture->getCompteur()) {
            $facture->setCompteur($newCompteur);
        }

        return $this;
    }
}
