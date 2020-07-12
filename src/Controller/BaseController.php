<?php
namespace App\Controller;

use App\Controller\CommandeMapping;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController{
    protected $code='code';
    protected $status='status';
    protected $data='data';
    protected $message='message';
}

?>