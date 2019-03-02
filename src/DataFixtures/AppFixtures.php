<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = \Faker\Factory::create('fr_FR');

        for($i = 1; $i <= 10; $i++) {
            $property = new Property();
            $property->setTitle($faker->sentence())
                     ->setBedrooms(mt_rand(1,3))
                     ->setCity($faker->city())
                     ->setDescription($faker->sentence())  
                     ->setFloor(mt_rand(1,2))
                     ->setHeat('1')
                     ->setPrice(mt_rand(10,30) * 10000)
                     ->setRooms($property->getBedrooms() + mt_rand(1,3))
                     ->setSold('0')
                     ->setSurface(mt_rand(50,120))
                     ->setCreatedAt($faker->dateTimeBetween('-3 months'));

            $manager->persist($property);
        }

        $manager->flush();
    }
}
