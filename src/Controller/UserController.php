<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Mapping\UserMapping;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends BaseController
{
    private $passwordEncoder;
    /**
     * @param UserMapping $userMapping
     * @param SerializerInterface $serializer
     * @param ValidatorInterface $validator
     * @param EntityManagerInterface $em
     */

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, UserMapping $userMapping, SerializerInterface $serializer, ValidatorInterface $validator, EntityManagerInterface $em)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->userMapping = $userMapping;
        $this->em = $em;
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    /**
     * Liste de tous les utilisateurs
     * @Rest\Get("/api/users")
     */
    public function index()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->userMapping->listeUser($users);
    }

    /**
     * detail user
     * @Rest\Get("/api/user/{id}")
     */
    public function showUser(Request $request)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($request->get('id'));
        return $this->userMapping->showUser($user);
    }

    /**
     * @Rest\Post("/login_check")
     */
    public function login()
    {
        $user = $this->getUser();
        return $this->json(array(
            'username' => $user->getUsername(),
            'roles' => $user->getRoles()
        ));
    }

    /**
     *@Rest\Post("/api/register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();
        $values = json_decode($request->getContent(),true);
        $exist = $this->getDoctrine()->getRepository(User::class)->findOneBy(["email" => $values["email"]]);
        if ($exist) {
            $data = [
                'status' => 501,
                'message' => 'Vous êtes déjà inscrite,veuillez-vous connecter'
            ];
            return new JsonResponse($data, 500);
        }
            $user->setPassword($passwordEncoder->encodePassword($user, $values["password"]));
            $user->setRoles(['ROLE_ADMIN']);
            $user->setNomComplet($values["nomComplet"]);
            $user->setAdresse($values["adresse"]);
            $user->setEmail($values["email"]);
            $user->setTelephone($values["telephone"]);
            $errorsAssert = $this->validator->validate($user);
            if (count($errorsAssert) > 0) {
                $err = $this->serializer->serialize($errorsAssert, 'json');
                return new JsonResponse($err, 500);
            }
            $this->em->persist($user);
            $this->em->flush();
            $data = [
                'status' => 201,
                'message' => 'L\'Utilisateur a été crée'
            ];
            return new JsonResponse($data, 201);
    }

    /**
     *@Rest\Post("/api/updateUser/{id}")
     */
    public function updateUser(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $values = json_decode($request->getContent(),true);
        $user = $this->getDoctrine()->getRepository(User::class)->find($request->get('id'));
        if (!$user) {
            return new JsonResponse(array($this->code => 501, $this->status => 'false', $this->data => 'cet utilisateur n\'existe pas'));
        }
            $user->setPassword($passwordEncoder->encodePassword($user, $values["password"]));
            $user->setRoles(['ROLE_ADMIN']);
            $user->setNomComplet($values["nomComplet"]);
            $user->setAdresse($values["adresse"]);
            $user->setEmail($values["email"]);
            $user->setTelephone($values["telephone"]);
            $errorsAssert = $this->validator->validate($user);
            if (count($errorsAssert) > 0) {
                $err = $this->serializer->serialize($errorsAssert, 'json');
                return new JsonResponse($err, 500);
            }
            $this->em->persist($user);
            $this->em->flush();
            $data = [
                'status' => 201,
                'message' => 'L\'Utilisateur a été mis à jour'
            ];
            return new JsonResponse($data, 202);
    }

    /**
     *@Rest\Post("/ajoutClient")
     */
    public function ajoutClient(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();
        $values = json_decode($request->getContent(),true);
        $exist = $this->getDoctrine()->getRepository(User::class)->findOneBy(["email" => $values["email"]]);
        if ($exist) {
            $data = [
                'status' => 501,
                'message' => 'Vous êtes déjà inscrite,veuillez-vous connecter'
            ];
            return new JsonResponse($data, 500);
        }
            $user->setPassword($passwordEncoder->encodePassword($user, $values["password"]));
            $user->setRoles(['ROLE_CLIENT']);
            $user->setNomComplet($values["nomComplet"]);
            $user->setAdresse($values["address"]);
            $user->setEmail($values["email"]);
            $user->setTelephone($values["telephone"]);
            $errorsAssert = $this->validator->validate($user);
            if (count($errorsAssert) > 0) {
                $err = $this->serializer->serialize($errorsAssert, 'json');
                return new JsonResponse($err, 500);
            }
            $this->em->persist($user);
            $this->em->flush();
            $data = [
                'status' => 201,
                'message' => 'Le client a été crée'
            ];
            return new JsonResponse($data, 201);
    }

    /**
     *@Rest\Post("/api/updateClient/{id}")
     */
    public function updateClient(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($request->get('id'));
        if (!$user) {
            return new JsonResponse(array($this->code => 501, $this->status => 'false', $this->data => 'ce client n\'existe pas'));
        }
        $values = json_decode($request->getContent(),true);
            $user->setPassword($passwordEncoder->encodePassword($user, $values["password"]));
            $user->setRoles(['ROLE_CLIENT']);
            $user->setNomComplet($values["nomComplet"]);
            $user->setAdresse($values["adresse"]);
            $user->setEmail($values["email"]);
            $user->setTelephone($values["telephone"]);
            $errorsAssert = $this->validator->validate($user);
            if (count($errorsAssert) > 0) {
                $err = $this->serializer->serialize($errorsAssert, 'json');
                return new JsonResponse($err, 500);
            }
            $this->em->persist($user);
            $this->em->flush();
            $data = [
                'status' => 201,
                'message' => 'Le client a été mis à jour'
            ];
            return new JsonResponse($data, 202);
    }

    /**
     * @Rest\Get("/api/deleteUser/{id}")
     */
    public function deleteUser(Request $request)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($request->get('id'));
        if (!$user) {
            return new JsonResponse(array($this->code => 501, $this->status => 'false', $this->data => 'cet utilisateur n\'existe pas'));
        }
        $this->em->remove($user);
        $this->em->flush();
        return new JsonResponse(array($this->code => 203, $this->status => 'true', $this->data => 'utilisateur supprimé'));
    }

    /**
     * @Rest\Post("/login", name="authentification")
     * @param JWTEncoderInterface $JWTEncoder
     * @throws \Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTEncodeFailureException
     */
    public function authentification(Request $request, JWTEncoderInterface  $JWTEncoder)
    {
        $values = json_decode($request->getContent(),true);
        if (!$values) {
            $values = $request->request->all();
        }  
        $email   = $values["email"];
        $password   = $values["password"];
        $repo = $this->getDoctrine()->getRepository(User::class);
        $user = $repo->findOneBy(['email' => $email]);
        if (!$user) {
            $data = [
                'code' => 'ko',
                'message' => 'email incorrect'
            ];
            return new JsonResponse($data);
        }

        $isValid = $this->passwordEncoder->isPasswordValid($user, $password);
        if (!$isValid) {
            $data = [
                'code' => 'ko',
                'message' => 'Mot de passe incorect'
            ];
            return new JsonResponse($data);
        }
        $token = $JWTEncoder->encode([
            'userId' => $user->getId(),
            'email' => $user->getEmail(),
            'nomComplet' => $user->getNomComplet(),
            "telephone" => $user->getTelephone(),
            "adresse" => $user->getAdresse(),
            'roles' => $user->getRoles(),
            'auth' => true,
            'exp' => time() + 86400 // 1 day expiration
        ]);

        return $this->json([
            'token' => $token
        ]);
    }
}
