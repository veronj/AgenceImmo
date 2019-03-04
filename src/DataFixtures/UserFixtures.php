<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        
            $user = new User();
            $user->setEmail('user@user.com');
            $user->setPassword($this->encoder->encodePassword($user, 'password'));
            
            $manager->persist($user);

            $admin = new User();
            $admin->setEmail("admin@user.com")
            ->setPassword($this->encoder->encodePassword($user, 'password'))
            ->setRoles(array('ROLE_ADMIN', 'ROLE_USER'));
            $manager->persist($admin);
        

        $manager->flush();
    }
}
