<?php

namespace App\DataFixtures;

use App\Entity\AdvertType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AdvertTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager) : void
    {
        $type1 = new AdvertType();
        $type1->setName("Location");
        $manager->persist($type1);

        $type2 = new AdvertType();
        $type2->setName("Vente");
        $manager->persist($type2);

        $manager->flush();
    }
}
