<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Produit;
use App\Repository\CategorieRepository;
use App\Repository\ProduitRepository;
use App\Services\BoutiqueService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/boutique")
 */
class BoutiqueController extends AbstractController
{
    private $em;
    private $categorieRepository;
    private $produitRepository;
    private $message;
    private $status;
    private $serializer;
    private $validator;

    public function __construct(ValidatorInterface $validator, SerializerInterface $serializer, ProduitRepository $produitRepository, EntityManagerInterface $em, CategorieRepository $categorieRepository)
    {
        $this->categorieRepository = $categorieRepository;
        $this->produitRepository = $produitRepository;
        $this->serializer = $serializer;
        $this->em = $em;
        $this->message = 'message';
        $this->status = 'status';
        $this->validator = $validator;
    }
    /**
     * @Route("/listAll", name="boutique_listAll", methods={"GET"})
     */
    public function indexAll(BoutiqueService $boutiqueService)
    {
        $dataProduitByCategorie = $boutiqueService->getProduitAllBoutique();
        if (!$dataProduitByCategorie) {
            $data = [
                $this->message => 'Aucun Produit trouvé',
                $this->status => 401
            ];
            return  $this->json($data);
        }
        $data = [
            'products' => $dataProduitByCategorie
        ];
        return $this->json($data, 200);
    }

    /**
     * @Route("/list/{id}", name="boutique_list", methods={"GET"})
     */
    public function index(BoutiqueService $boutiqueService, Categorie $categorie, $id = null)
    {
        $dataProduitByCategorie = $boutiqueService->getProduitBoutique($categorie->getid());
        if (!$dataProduitByCategorie) {
            $data = [
                $this->message => 'Aucun Produit trouvé',
                $this->status => 401
            ];
            return  $this->json($data);
        }
        $data = [
            'products' => $dataProduitByCategorie
        ];
        return $this->json($data, 200);
    }

    /**
     * @Route("/listOne/{id}", name="details_produit", methods={"GET"})
     */
    public function indexDetails(BoutiqueService $boutiqueService,Produit $produit,$id = null)
    {
        $dataProduitDetail = $boutiqueService->getProduitBoutiqueById($produit->getid());
        if (!$dataProduitDetail) {
            $data = [
                $this->message => 'Detail Produit Introuvable',
                $this->status => 401
            ];
            return  $this->json($data);
        }
        return $this->json($dataProduitDetail, 200);
    }
}
