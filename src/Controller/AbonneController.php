<?php

namespace App\Controller;

use App\Entity\Abonne;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
    /**
     * @Route("/abonne")
     */
class AbonneController extends AbstractController
{
    
    /**
     * @Route("/add", name="abonne_new", methods={"POST"})
     */
    public function newAbonne(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $email = '';
        $abonne = new Abonne();
        $data = json_decode($request->getContent());
        if (!$data) {
            $data = $request->request->all();
        }
        $email = $data->email;
        $abonne->setEmail($email);
            $errors = $validator->validate($abonne);
            if (count($errors)) {
                $errors = $serializer->serialize($errors, 'json');
                return new Response($errors, 500, [
                    'Content-Type' => 'application/json'
                ]);
            }
            $entityManager->persist($abonne);
            $entityManager->flush();
            $data = [
                'status' => 201,
                'message' => 'Abonnement Réussi'
            ];
            return new JsonResponse($data, 201);
   
    }
}
