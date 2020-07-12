<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class Userfixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('happyOne@gmail.com');
        $user->setRoles(["ROLE_SUPER_ADMIN"]);
        $password = $this->encoder->encodePassword($user, 'admin');
        $user->setPassword($password);
        $user->setTelephone(77000000);
        $user->setAdresse('noWhere');
        $user->setNomComplet('Super Admin');
        $manager->persist($user);
        $manager->flush();
    }
}
