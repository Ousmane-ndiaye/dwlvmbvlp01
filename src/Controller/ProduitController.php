<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Produit;
use App\Repository\CategorieRepository;
use App\Repository\CollectionProduitRepository;
use App\Repository\ProduitRepository;
use App\Services\BoutiqueService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/api/produit", name="produit")
 */
class ProduitController extends AbstractController
{

    private $em;
    private $categorieRepository;
    private $produitRepository;
    private $collectionProduitRepository;
    private $message;
    private $status;
    private $serializer;
    private $validator;

    public function __construct(ValidatorInterface $validator, CollectionProduitRepository $collectionProduitRepository, SerializerInterface $serializer, ProduitRepository $produitRepository, EntityManagerInterface $em, CategorieRepository $categorieRepository)
    {
        $this->categorieRepository = $categorieRepository;
        $this->produitRepository = $produitRepository;
        $this->collectionProduitRepository = $collectionProduitRepository;
        $this->serializer = $serializer;
        $this->em = $em;
        $this->message = 'message';
        $this->status = 'status';
        $this->validator = $validator;
    }
    /**
     * @Route("/show", name="produit_show")
     */
    public function index(BoutiqueService $boutiqueService)
    {
        $categories = $this->categorieRepository->findAll();
        $produitTab = [];
        foreach ($categories as $key) {
            $tab = array(
                'categorie' => $key->getLibelle(),
                'produits' =>  $boutiqueService->getProduitBoutique($key->getid())
            );
            array_push($produitTab, $tab);
        }
        $data = $this->serializer->serialize($produitTab, 'json');
        return new JsonResponse($data, 200, [], true);
    }

    /**
     * @Route("/add/{id}", name="produit_new", methods={"POST"})
     */
    public function newProduit(Request $request, Categorie $categorie)
    {
        $produit = new Produit();
        $nomsImage= [];
        $values = json_decode($request->getContent(),true);
        if (!$values) {
            $values = $request->request->all();
        }
        $tails = explode(",", $values['tailles']);
        $cols = explode(",", $values['colorsd']);
        $d = intval($values["tailletab"]);
        if($requestFile=$request->files->all()){
               // dump("ok");
                for ($i=0; $i < $d; $i++) { 
                $file=$requestFile["images".$i];
                
                $fileName=md5(uniqid()).'.'.$file->guessExtension();
                $file->move($this->getParameter('image_directory'),$fileName);
                }
                array_push($nomsImage, $fileName);
        }
        if ($requestFile=$request->files->all()) {
            $file1=$requestFile["photo"];
            $fileName1=md5(uniqid()).'.'.$file1->guessExtension();
                    $file1->move($this->getParameter('image_directory'),$fileName1);
        }
        /*  for ($i=1; $i < $values['tailletab']; $i++) { 
            # code...
            $imgsName = explode(",", $values['names']);
        }*/
        $collection = $this->collectionProduitRepository->find($values['collect']);
       $produit
            ->setDesignation($values['designation'])
            ->setDescription($values['description'])
            ->setPrix($values['prix'])
            ->setQuantiteStock($values['quantiteStock'])
            ->setEnStock($values['quantiteStock'])
            ->setTailles($tails)
            ->setColors($cols)
            ->setImages($nomsImage)
            ->setStatus(true)
            ->setCategorie($categorie)
            ->setCollectionproduit($collection)
            ->setPhoto($fileName1);

         /*if($requestFile=$request->files->all()){
                
            $file=$requestFile['file'];
            $extension=$file->guessExtension();
            if($extension!='png' && $extension!='jpeg' ){
                throw new HttpException(400,'Veuillez entrer une image valide !');
            }
            
            $fileName=md5(uniqid()).'.'.$extension;
            $file->move($this->getParameter('image_directory'),$fileName);
          }else{
            $data = [
                $this->message => 'Image Introuvable ou Non inséré',
                $this->status => 403
            ];
            return  $this->json($data);
          }*/
        $this->em->persist($produit);
        $errors = $this->validator->validate($produit);
        if (count($errors)) {
            $errors = $this->serializer->serialize($errors, 'json');
            return new Response($errors, 500, [
                'Content-Type' => 'application/json'
            ]);
        }
       $this->em->flush();
        $data = [
            $this->message => 'produit crée',
            $this->status => 201
        ];

        return  $this->json($data);
    }

    /**
     * @Route("/edit/{id}", name="produit_edits", methods={"POST"})
     */
    public function editerproducts(Request $request, Produit $produit)
    {

        $values = json_decode($request->getContent(), true);
        if (!$values) {
            $values = $request->request->all();
        }
        $cat = $this->categorieRepository->find($values['idCat']);
        if ($cat) {
            $produit
                ->setDesignation($values['designation'])
                ->setTailles($values['taille'])
                ->setColors($values['couleur'])
                ->setDescription($values['description'])
                ->setPrix($values['prix'])
                ->setQuantiteStock($values['quantiteStock'])
                ->setEnStock($values['enStock'])
                ->setCategorie($cat);
            if ($requestFile = $request->files->all()) {
                $file = $requestFile['file'];
                $extension = $file->guessExtension();
                if ($extension != 'png' && $extension != 'jpeg') {
                    throw new HttpException(400, 'Veuillez entrer une image valide !');
                }
                $fileName = md5(uniqid()) . '.' . $extension;
                $produit->setPhoto($fileName);
                $file->move($this->getParameter('image_directory'), $fileName);
            }
        } else {
            # code...
            $data = [
                $this->message => 'Catégorie Introuvable',
                $this->status => 403
            ];
            return  $this->json($data);
        }
        $this->em->flush();
        $data = [
            $this->message => 'Produit Modifié',
            $this->status => 201
        ];
        return  $this->json($data);
    }
}
