<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BrandFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $brand1 = new Brand();
        $brand1->setName("Peugeot");
        $manager->persist($brand1);

        $brand2 = new Brand();
        $brand2->setName("Citroën");
        $manager->persist($brand2);

        $brand3 = new Brand();
        $brand3->setName("Volvo");
        $manager->persist($brand3);

        $brand4 = new Brand();
        $brand4->setName("Audi");
        $manager->persist($brand4);

        $brand5 = new Brand();
        $brand5->setName("BMW");
        $manager->persist($brand5);

        $manager->flush();
    }
}
