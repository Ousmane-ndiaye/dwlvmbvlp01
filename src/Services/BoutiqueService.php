<?php

namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BoutiqueService extends AbstractController
{
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function getProduitAllBoutique()
    {
        $query = $this->manager->createQuery(

            "SELECT  p.prix,p.status,p.id as idProd,
                     p.designation,p.tailles,p.colors,p.description,p.quantiteStock,p.images,
                     p.enStock,p.photo,c.libelle as categorie,c.id as idCat,d.id as idCol, d.nomCollection as collection
            FROM App\Entity\Produit p
            JOIN p.categorie c
            JOIN p.collectionproduit d
            WHERE p.status = true
            "
        );
        return $query
            ->getResult();
    }

    public function getProduitBoutique($categorie)
    {
        $query = $this->manager->createQuery(

            "SELECT  p.prix,p.status,p.id as idProd,
                     p.designation,p.tailles,p.colors,p.description,p.quantiteStock,p.images,
                     p.enStock,p.photo,c.libelle as categorie,c.id as idCat,d.id as idCol, d.nomCollection as collection
            FROM App\Entity\Produit p
            JOIN p.categorie c
            JOIN p.collectionproduit d
            WHERE p.status = true AND c.id = :id
            "
        );
        return $query
            ->setParameter('id', $categorie)
            ->getResult();
    }

    public function getProduitBoutiqueById($produit)
    {
        $query = $this->manager->createQuery(

            "SELECT  p.prix,p.status,p.id as idProd,
                     p.designation,p.tailles,p.colors,p.description,p.quantiteStock,p.images,
                     p.enStock,p.photo,c.libelle as categorie,c.id as idCat,d.id as idCol, d.nomCollection as collection
            FROM App\Entity\Produit p
            JOIN p.categorie c
            JOIN p.collectionproduit d
            WHERE p.status = true AND p.id = :id
            "
        );
        return $query
            ->setParameter('id', $produit)
            ->getResult();
    }
    
    public function getCount($cat)
    {
        $query = $this->manager->createQuery(

            "SELECT  COUNT(p)

            FROM App\Entity\Produit p
            JOIN p.categorie c
            WHERE c.id = :id
            
            "
        );
        return $query
        ->setParameter('id', $cat)
        ->getSingleScalarResult()
        ;
    }
}