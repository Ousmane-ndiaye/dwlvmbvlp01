<?php

namespace App\Entity;

use App\Repository\CollectionProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 *@UniqueEntity(fields={"nomCollection"}, message="This collection is already in use.")
 * @ORM\Entity(repositoryClass=CollectionProduitRepository::class)
 */
class CollectionProduit
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
    private $nomCollection;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="collectionproduit")
     */
    private $produits;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCollection(): ?string
    {
        return $this->nomCollection;
    }

    public function setNomCollection(string $nomCollection): self
    {
        $this->nomCollection = $nomCollection;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setCollectionproduit($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->contains($produit)) {
            $this->produits->removeElement($produit);
            // set the owning side to null (unless already changed)
            if ($produit->getCollectionproduit() === $this) {
                $produit->setCollectionproduit(null);
            }
        }

        return $this;
    }
}
