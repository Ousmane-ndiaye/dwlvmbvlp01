<?php

namespace App\Tests\Entity;

use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


class UserTest extends WebTestCase
{
    protected $user;

    protected function setUp(){
        $this->user = new User();
    }

    /**
     * @covers App\Entity\User::getId
     */
    public function testAxeIsInitiallyZero()
    {
        $this->assertEquals(0, $this->user->getId());
    }

    /**
     * @covers App\Entity\User::getEmail
     * @covers App\Entity\User::setEmail
     */
    public function testUsersetEmail()
    {
        $this->user->setEmail('mail@test.com');

        $this->assertEquals('mail@test.com', $this->user->getEmail());
    }

    /**
     * @covers App\Entity\User::getUsername
     */
    public function testUsergetUsername()
    {
        $this->user->setEmail('mail@test.com');

        $this->assertEquals('mail@test.com', $this->user->getUsername());
    }


    /**
     * @covers App\Entity\User::getPassword
     * @covers App\Entity\User::setPassword
     */
    public function testUsersetPassword()
    {
        $this->user->setPassword('dialloquinz');

        $this->assertEquals('dialloquinz', $this->user->getPassword());
    }


    /**
     * @covers App\Entity\User::getRoles
     * @covers App\Entity\User::setRoles
     */
    public function testUsersetRoles()
    {
        $this->user->setRoles(['ROLE_ADMIN']);

        $roles = $this->user->getRoles();

        $this->assertTrue(in_array('ROLE_ADMIN', $roles));
    }


    /**
     * @covers App\Entity\User::__toString
     */
    public function testUserToString()
    {
        $this->user->setEmail('email@test.com');
        $this->assertEquals('email@test.com', $this->user);
    }

}
