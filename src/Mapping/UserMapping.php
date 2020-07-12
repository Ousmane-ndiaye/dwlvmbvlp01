<?php
namespace App\Mapping;

use App\Mapping\BaseMapping;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserMapping extends BaseMapping{

    public function listeUser($users){
        if($users){
            $liste=array();
            foreach ($users as $user) {
                $liste[]=array(
                    "email"=>$user->getEmail(),
                    'nomComplet'=>$user->getNomComplet(),
                    "telephone"=>$user->getTelephone(),
                    "adresse"=>$user->getAdresse()
                );
            }
            return new JsonResponse(array($this->code=>200,$this->status=>'true',$this->data=>$liste));
        }
        return new JsonResponse(array($this->code=>501,$this->status=>'false',$this->data=>'il n\'y aucun utilisateurs'));
    }

    public function showUser($user){
        if($user){
                $data=array(
                    "email"=>$user->getEmail(),
                    'nomComplet'=>$user->getNomComplet(),
                    "telephone"=>$user->getTelephone(),
                    "adresse"=>$user->getAdresse()
                );
            return new JsonResponse(array($this->code=>200,$this->status=>'true',$this->data=>$data));
        }
    }
}

?>