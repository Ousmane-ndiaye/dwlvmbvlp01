<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Entity\Produit;
use App\Entity\Commande;
use App\Entity\ProduitCommande;
use App\Mapping\CommandeMapping;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * @Route("/api")
 */
class CommandeController extends BaseController
{

    /**
     * @param CommandeMapping $cm
     */
    public function __construct(CommandeMapping $cm)
    {
        $this->cm=$cm;
    }

    /**
     * @Rest\Get("/commandes")
     */
    public function index()
    {
       $commandes=$this->getDoctrine()->getRepository(Commande::class)->findAll();
       return $this->cm->allCommande($commandes);
    }

    /**
     * @Rest\Get("/commandes/{id}")
     */
    public function detailCommande(Request $request){
        $commande=$this->getDoctrine()->getRepository(Commande::class)->find($request->get('id'));
        return $this->cm->detailCommande($commande);
    }
     /**
     * @Rest\Post("/commandeClient")
     */
    public function commandeClient(Request $request){
        $em=$this->getDoctrine()->getManager();
        $datas=json_decode($request->getContent(),true);
        $commande=new Commande();
        foreach ($datas as $key => $value) {
            if($key=="produits"){
                foreach ($value as $produit) {
                    $produitCommande=new ProduitCommande();
                    $product=$this->getDoctrine()->getRepository(Produit::class)->find($produit["id"]);
                    $produitCommande->setProduit($product)
                                    ->setQuantite($produit["qte"])
                                    ->setCommande($commande)
                    ;
                    $em->persist($produitCommande);
                    
                }
            }
             else{
                $setter="set".ucwords($key);
                $commande->$setter($value);
            }
            $commande->setDateInitiale(new DateTime(date('Y-m-d H:i:s')));
            $commande->setUser($this->getUser());
            $commande->setStatut("on");

                $code=date('d').date('m').date('s').$this->getUser()->getTelephone();
                $commande->setCode($code);
           $em->persist($commande);
        }
        $em->flush();
        return new JsonResponse(array($this->code=>201,$this->status=>'true',$this->data=>'votre commande à bien été enregistré'));
    }
   /* public function commandeClient(Request $request){
        $em=$this->getDoctrine()->getManager();
        $datas=json_decode($request->getContent(),true);
        $commande=new Commande();
        foreach ($datas as $key => $value) {
            if($key=="produits"){
                foreach ($value as $produit) {
                    $produitCommande=new ProduitCommande();
                    $product=$this->getDoctrine()->getRepository(Produit::class)->find($produit["id"]);
                    $produitCommande->setProduit($product)
                                    ->setQuantite($produit["qte"])
                                    ->setCommande($commande)
                    ;
                    $em->persist($produitCommande);
                    
                }
            }
            elseif($key=="idUser"){
                $user=$this->getDoctrine()->getRepository(User::class)->find($value);
                $commande->setUser($user);
                $code=date('d').date('m').date('s').$user->getTelephone();
                $commande->setCode($code);
            }
             else{
                $setter="set".ucwords($key);
                $commande->$setter($value);
            }
            $commande->setDateInitiale(new DateTime(date('Y-m-d H:i:s')));
           $em->persist($commande);
        }
        $em->flush();
        return new JsonResponse(array($this->code=>201,$this->status=>'true',$this->data=>'votre commande à bien été enregistré'));
    }*/
}
