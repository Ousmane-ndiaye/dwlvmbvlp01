<?php
namespace App\Mapping;

use App\Mapping\BaseMapping;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class CommandeMapping extends BaseMapping{

    public function allCommande($commandes){
        if($commandes){
            $liste=array();
            foreach ($commandes as $commande) {
               $liste[]=array(
                   "id"=>$commande->getId(),
                   "userId"=>$commande->getUser()->getId(),
                   "dateInitial"=>$commande->getDateInitiale(),
                   "dateLivraison"=>$commande->getDateLivraison(),
                   "code"=>$commande->getCode(),
                   "adresseLivraison"=>$commande->getAdresseLivraison(),
                   "modePaiement"=>$commande->getModePaiement(),
                   "numeroDestinataire"=>$commande->getNumeroDestinataire(),
                   "statut"=>$commande->getStatut()
               );
            }
            return new JsonResponse(array($this->code=>'202',$this->status=>'true',$this->data=>$liste));
        }
        return new JsonResponse(array($this->code=>'202',$this->status=>'true',$this->message=>'commande vide'));
    }

    public function detailCommande($commande){
        if($commande){
            $data=array(
                   "id"=>$commande->getId(),
                   "userId"=>$commande->getUser()->getId(),
                   "dateInitial"=>$commande->getDateInitiale(),
                   "dateLivraison"=>$commande->getDateLivraison(),
                   "code"=>$commande->getCode(),
                   "adresseLivraison"=>$commande->getAdresseLivraison(),
                   "modePaiement"=>$commande->getModePaiement(),
                   "numeroDestinataire"=>$commande->getNumeroDestinataire(),
                   "statut"=>$commande->getStatut()
               );
            return new JsonResponse(array($this->code=>'202',$this->status=>'true',$this->data=>$data));
        }
        return new JsonResponse(array($this->code=>'202',$this->status=>'true',$this->message=>'commande vide'));
    }
}

?>