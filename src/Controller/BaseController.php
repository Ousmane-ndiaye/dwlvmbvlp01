<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\GestionDeslogs;
use App\Entity\User;

class BaseController extends AbstractController
{
    //Les constantes globales
    const HOME_PAGE = 'app_homepage';

    
    //Les variables globales
    protected $userLogger;

    protected $entityManager;

    protected $userRepository;

    
    public function __construct(GestionDeslogs $logger, EntityManagerInterface $entityMngr)
    {
        $this->userLogger = $logger;
        $this->entityManager = $entityMngr;
        $this->userRepository = $this->entityManager->getRepository(User::class);
    }

    //Les fonctions globlales
    public function getRequest()
    {
        return $this->container->get('request_stack')->getCurrentRequest();
    }

    public static function slugify(string $string): string
    {
        return preg_replace('/\s+/', '-', mb_strtolower(trim(strip_tags($string)), 'UTF-8'));
    }
}
