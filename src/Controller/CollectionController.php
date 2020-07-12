<?php

namespace App\Controller;

use App\Entity\CollectionProduit;
use App\Form\CollectionProduitType;
use App\Repository\CollectionProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/api/collection")
 */
class CollectionController extends AbstractController
{
    /**
     * @Route("/show", name="collection_indexshow", methods={"GET"})
     */
    public function indexcollection(CollectionProduitRepository $collectionProduitRepository, SerializerInterface $serializer)
    {
        $collectionq = $collectionProduitRepository->findBy([], ['nomCollection' => 'ASC']);
        $collection = [];
        $ligne = 0;
        foreach ($collectionq as $key) {
            $ligne++;
            $rem = array(
                'id' => $key->getId(),
                'libelle' => $key->getNomCollection(),
                'ligne' => $ligne,
            );
            array_push($collection, $rem);
        }
        $data = $serializer->serialize($collection, 'json');
        return new JsonResponse($data, 200, [], true);
    }
    /**
     * @Route("/add", name="collection_new", methods={"POST"})
     */
    public function newcollection(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $nomCollection = '';
        $collects = new CollectionProduit();
        $form = $this->createForm(CollectionProduitType::class, $collects);
        $data = json_decode($request->getContent(), true);
        if (!$data) {
            $data = $request->request->all();
        }
        $nomCollection = $data['nomCollection'];
        $collects->setNomCollection($nomCollection);
        if (!$form->isSubmitted()) {
            $errors = $validator->validate($collects);
            if (count($errors)) {
                $errors = $serializer->serialize($errors, 'json');
                return new Response($errors, 500, [
                    'Content-Type' => 'application/json'
                ]);
            }
            $entityManager->persist($collects);
            $entityManager->flush();
            $data = [
                'status' => 201,
                'message' => 'Collection Créée'
            ];
            return new JsonResponse($data, 201);
        } else {
            $data = [
                'status' => 502,
                'message' => 'Echec Création! veuillez réesaayer'
            ];
            return new JsonResponse($data, 502);
        }
    }

    /**
     * @Route("/edit/{id}", name="collection_edit", methods={"PUT"})
     */
    public function editercollection(Request $request, CollectionProduit $collectionProduit, SerializerInterface $serializer, EntityManagerInterface $entityManager, ValidatorInterface $validator, $id = null)
    {
        $data = json_decode($request->getContent(), true);
        if (!$data) {
            $data = $request->request->all();
        }
        $nomCollection = 'nomCollection';
        if ($collectionProduit) {
            $collectionProduit
                ->setNomCollection($data[$nomCollection]);
        }
        $errors = $validator->validate($collectionProduit);
        if (count($errors)) {
            $errors = $serializer->serialize($errors, 'json');
            return new Response($errors, 500, [
                'Content-Type' => 'application/json'
            ]);
        }
        $entityManager->flush();
        $data = [
            'status' => 200,
            'message' => 'Collection modifiée !'
        ];
        return new JsonResponse($data, 200);
    }
    
}
