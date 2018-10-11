<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VillageRepository")
 */
class Village
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
    private $numero_village;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_village;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_chefvillage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom_chefvillage;

    /**
     * @ORM\Column(type="integer")
     */
    private $telephone;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Client", mappedBy="village", orphanRemoval=true,cascade={"persist"})
     */
    private $clients;

    public function __construct()
    {
        $this->clients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroVillage(): ?string
    {
        return $this->numero_village;
    }

    public function setNumeroVillage(string $numero_village): self
    {
        $this->numero_village = $numero_village;

        return $this;
    }

    public function getNomVillage(): ?string
    {
        return $this->nom_village;
    }

    public function setNomVillage(string $nom_village): self
    {
        $this->nom_village = $nom_village;

        return $this;
    }

    public function getNomChefvillage(): ?string
    {
        return $this->nom_chefvillage;
    }

    public function setNomChefvillage(string $nom_chefvillage): self
    {
        $this->nom_chefvillage = $nom_chefvillage;

        return $this;
    }

    public function getPrenomChefvillage(): ?string
    {
        return $this->prenom_chefvillage;
    }

    public function setPrenomChefvillage(string $prenom_chefvillage): self
    {
        $this->prenom_chefvillage = $prenom_chefvillage;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @return Collection|Client[]
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Client $client): self
    {
        if (!$this->clients->contains($client)) {
            $this->clients[] = $client;
            $client->setVillage($this);
        }

        return $this;
    }

    public function removeClient(Client $client): self
    {
        if ($this->clients->contains($client)) {
            $this->clients->removeElement($client);
            // set the owning side to null (unless already changed)
            if ($client->getVillage() === $this) {
                $client->setVillage(null);
            }
        }

        return $this;
    }

}
