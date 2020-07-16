<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/categorie")
 */
class CategorieController extends AbstractController
{
    /**
     * @Route("/show", name="category_indexshow", methods={"GET"})
     */
    public function indexCategory(CategorieRepository $categoRepository, SerializerInterface $serializer)
    {
        $categories = $categoRepository->findBy([], ['libelle' => 'ASC']);
        $category = [];
        $ligne = 0;
        foreach ($categories as $key) {
            $ligne++;
            $rem = array(
                'id' => $key->getId(),
                'libelle' => $key->getLibelle(),
                'ligne' => $ligne,
            );
            array_push($category, $rem);
        }
        $data = [
            'categories' => $category
        ];
        return $this->json($data, 200);
    }
    /**
     * @Route("/api/add", name="category_new", methods={"POST"})
     */
    public function newCategory(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $nomCategory = '';
        $category = new Categorie();
        $form = $this->createForm(CategorieType::class, $category);
        $data = json_decode($request->getContent());
        if (!$data) {
            $data = $request->request->all();
        }
        $nomCategory = $data->libelle;
        $category->setLibelle($nomCategory);
        if (!$form->isSubmitted()) {
            $errors = $validator->validate($category);
            if (count($errors)) {
                $errors = $serializer->serialize($errors, 'json');
                return new Response($errors, 500, [
                    'Content-Type' => 'application/json'
                ]);
            }
            $entityManager->persist($category);
            $entityManager->flush();
            $data = [
                'status' => 201,
                'message' => 'Catégorie Créée'
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
     * @Route("/api/edit/{id}", name="category_edit", methods={"PUT"})
     */
    public function editercategory(Request $request, Categorie $categorie, SerializerInterface $serializer, EntityManagerInterface $entityManager, ValidatorInterface $validator, $id = null)
    {


        $data = json_decode($request->getContent(), true);
        if (!$data) {
            $data = $request->request->all();
        }
        $nomCategory = 'libelle';
        if ($categorie) {
            $categorie
                ->setLibelle($data[$nomCategory]);
        }
        $errors = $validator->validate($categorie);
        if (count($errors)) {
            $errors = $serializer->serialize($errors, 'json');
            return new Response($errors, 500, [
                'Content-Type' => 'application/json'
            ]);
        }
        $entityManager->flush();
        $data = [
            'status' => 200,
            'message' => 'Catégorie modifiée !'
        ];
        return new JsonResponse($data, 200);
    }
    
}
