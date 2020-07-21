<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;


/**
 *@UniqueEntity(fields={"designation"}, message="This designation is already in use.")
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $designation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    private $prix;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    private $quantiteStock;

    /**
     * @ORM\Column(type="integer")
     * 
     */
    private $enStock;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="produits")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank
     */
    private $categorie;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=CollectionProduit::class, inversedBy="produits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $collectionproduit;

    /**
     * @ORM\Column(type="json")
     */
    private $colors = [];

    /**
     * @ORM\Column(type="json")
     */
    private $tailles = [];

    /**
     * @ORM\Column(type="json")
     */
    private $images = [];

    /**
     * @ORM\OneToMany(targetEntity=ProduitCommande::class, mappedBy="produit")
     */
    private $produitCommandes;

 

    public function __construct()
    {
        $this->produitCommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

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

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getQuantiteStock(): ?int
    {
        return $this->quantiteStock;
    }

    public function setQuantiteStock(int $quantiteStock): self
    {
        $this->quantiteStock = $quantiteStock;

        return $this;
    }

  

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCollectionproduit(): ?CollectionProduit
    {
        return $this->collectionproduit;
    }

    public function setCollectionproduit(?CollectionProduit $collectionproduit): self
    {
        $this->collectionproduit = $collectionproduit;

        return $this;
    }

    

    public function getTailles(): ?array
    {
        return $this->tailles;
    }

    public function setTailles(array $tailles): self
    {
        $this->tailles = $tailles;

        return $this;
    }

    public function getImages(): ?array
    {
        return $this->images;
    }

    public function setImages(array $images): self
    {
        $this->images = $images;

        return $this;
    }

   

    /**
     * Get the value of colors
     */ 
    public function getColors()
    {
        return $this->colors;
    }

    /**
     * Set the value of colors
     *
     * @return  self
     */ 
    public function setColors($colors)
    {
        $this->colors = $colors;

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
            $produitCommande->setProduit($this);
        }

        return $this;
    }

    public function removeProduitCommande(ProduitCommande $produitCommande): self
    {
        if ($this->produitCommandes->contains($produitCommande)) {
            $this->produitCommandes->removeElement($produitCommande);
            // set the owning side to null (unless already changed)
            if ($produitCommande->getProduit() === $this) {
                $produitCommande->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * Get the value of enStock
     */ 
    public function getEnStock()
    {
        return $this->enStock;
    }

    /**
     * Set the value of enStock
     *
     * @return  self
     */ 
    public function setEnStock($enStock)
    {
        $this->enStock = $enStock;

        return $this;
    }
}
