<?php
namespace App\Mapping;

use Symfony\Component\HttpFoundation\JsonResponse;

class BaseMapping{
    protected $code='code';
    protected $status='status';
    protected $data='data';
    protected $message='message';

    public function mapAllContent($produits,$categories,$collections){
        $listeProduits=null;
        $listeCategories=null;
        $listeCollections=null;
        if($produits){
            $listeProduits=array();
            foreach ($produits as $produit) {
               $listeProduits[]=array(
                   "id"=>$produit->getId(),
                   "designation"=>$produit->getDesignation(),
                   "prix"=>$produit->getPrix(),
                   "quantiteStock"=>$produit->getQuantiteStock(),
                   "enStock"=>$produit->getEnStock(),
                   "photo"=>"/img/".$produit->getPhoto(),
                   "status"=>$produit->getStatus(),
                   "colors"=>$produit->getColors(),
                   "tailles"=>$produit->getTailles(),
                   "images"=>$this->mapImages($produit->getImages()),
                   "categorie"=>$produit->getCategorie()->getLibelle(),
                   "collection"=>$produit->getCollectionProduit()->getNomCollection()
               );
            }
        }
        if($categories){
            $listeCategories=array();
            foreach ($categories as $categorie) {
                $listeCategories[]=array(
                    "id"=>$categorie->getId(),
                    "libelle"=>$categorie->getLibelle()
                );
            }
        }
        if($collections){
            $listeCollections=array();
            foreach ($collections as $collection) {
                $listeCollections[]=array(
                    "id"=>$collection->getId(),
                    "nomCollection"=>$collection->getNomCollection()
                );
            }
        }
        $objets=array(
            "produits"=>$listeProduits,
            "categories"=>$listeCategories,
            "collections"=>$listeCollections
        );
        return new JsonResponse(array($this->code=>202,$this->status=>'true',$this->data=>$objets));
    }

    public function mapImages($images){
        if($images){
            $tabImages=array();
            for ($i=0; $i < count($images); $i++) { 
               $tabImages[]="/img/".$images[$i];
            }
            return $tabImages;
        }
        return null;
    }
}

?>