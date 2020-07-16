<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\Categorie;
use App\Entity\CollectionProduit;
use App\Mapping\BaseMapping;
use App\Services\BoutiqueService;
use App\Repository\ProduitRepository;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/boutique")
 */
class BoutiqueController extends AbstractController
{   
    /**
     * @param BaseMapping $cm
     */
    private $em;
    private $categorieRepository;
    private $produitRepository;
    private $message;
    private $status;
    private $serializer;
    private $validator;

    public function __construct(BaseMapping $bm,ValidatorInterface $validator, SerializerInterface $serializer, ProduitRepository $produitRepository, EntityManagerInterface $em, CategorieRepository $categorieRepository)
    {
        $this->categorieRepository = $categorieRepository;
        $this->produitRepository = $produitRepository;
        $this->serializer = $serializer;
        $this->em = $em;
        $this->message = 'message';
        $this->status = 'status';
        $this->validator = $validator;
        $this->bm=$bm;
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
    /**
     * @Route("/showAll", name="allContent",methods={"GET"})
     */
    public function showAll(){
        $produits=$this->getDoctrine()->getRepository(Produit::class)->findAll();
        $categories=$this->getDoctrine()->getRepository(Categorie::class)->findAll();
        $collections=$this->getDoctrine()->getRepository(CollectionProduit::class)->findAll();
        return $this->bm->mapAllContent($produits,$categories,$collections);
    }
}
