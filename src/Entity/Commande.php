<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date",nullable=true)
     */
    private $dateInitiale;

    /**
     * @ORM\Column(type="date",nullable=true)
     */
    private $dateLivraison;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $adresseLivraison;
    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commandes")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity=ProduitCommande::class, mappedBy="commande")
     */
    private $produitCommandes;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $modePaiement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numeroDestinataire;

    /**
     * @ORM\Column(type="string", length=255,)
     */
    private $statut;

    public function __construct()
    {
        $this->produitCommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateInitiale(): ?\DateTimeInterface
    {
        return $this->dateInitiale;
    }

    public function setDateInitiale(\DateTimeInterface $dateInitiale): self
    {
        $this->dateInitiale = $dateInitiale;

        return $this;
    }

    public function getDateLivraison(): ?\DateTimeInterface
    {
        return $this->dateLivraison;
    }

    public function setDateLivraison(\DateTimeInterface $dateLivraison): self
    {
        $this->dateLivraison = $dateLivraison;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getAdresseLivraison(): ?string
    {
        return $this->adresseLivraison;
    }

    public function setAdresseLivraison(string $adresseLivraison): self
    {
        $this->adresseLivraison = $adresseLivraison;

        return $this;
    }


    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|ProduitCommande[]
     */
    public function getProduitCommandes(): Collection
    {
        return $this->produitCommandes;
    }

    public function addProduitCommande(ProduitCommande $produitCommande): self
    {
        if (!$this->produitCommandes->contains($produitCommande)) {
            $this->produitCommandes[] = $produitCommande;
            $produitCommande->setCommande($this);
        }

        return $this;
    }

    public function removeProduitCommande(ProduitCommande $produitCommande): self
    {
        if ($this->produitCommandes->contains($produitCommande)) {
            $this->produitCommandes->removeElement($produitCommande);
            // set the owning side to null (unless already changed)
            if ($produitCommande->getCommande() === $this) {
                $produitCommande->setCommande(null);
            }
        }

        return $this;
    }

    public function getModePaiement(): ?string
    {
        return $this->modePaiement;
    }

    public function setModePaiement(string $modePaiement): self
    {
        $this->modePaiement = $modePaiement;

        return $this;
    }

    public function getNumeroDestinataire(): ?string
    {
        return $this->numeroDestinataire;
    }

    public function setNumeroDestinataire(?string $numeroDestinataire): self
    {
        $this->numeroDestinataire = $numeroDestinataire;

        return $this;
    }



    /**
     * Get the value of statut
     */ 
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set the value of statut
     *
     * @return  self
     */ 
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }
}
