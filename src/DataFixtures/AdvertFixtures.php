<?php

namespace App\DataFixtures;

use App\Entity\Advert;
use App\Entity\AdvertType;
use App\Repository\AdvertTypeRepository;
use App\Repository\BrandRepository;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AdvertFixtures extends Fixture implements DependentFixtureInterface
{
    private $userRepository;
    private $brandRepository;
    private $advertTypeRepository;

    public function __construct(UserRepository $userRepository,
                                BrandRepository $brandRepository,
                                AdvertTypeRepository $advertTypeRepository) {
        $this->userRepository = $userRepository;
        $this->brandRepository = $brandRepository;
        $this->advertTypeRepository = $advertTypeRepository;
    }

    public function load(ObjectManager $manager) : void
    {

        $faker = Factory::create('fr_FR');

        $user = $this->userRepository->findOneBy([
            "email" => "user@user.com"
        ]);

        /**
         * Non booked averts
         */
        for ($i = 0; $i < 2; $i++) {
            $advert = new Advert();
            $advert->setName($faker->realText(100));
            $advert->setBrand($this->brandRepository->find(random_int(1, 10)));
            $advert->setIsBooked(true);
            $advert->setType($this->advertTypeRepository->find(random_int(1, 2)));
            $advert->setUser($user);
            $advert->setCreatedAt($faker->dateTimeBetween("- 1 year", "now"));
        }

        /**
         * Booked adverts
         */
        for ($i = 0; $i < 8; $i++) {
            $advert = new Advert();
            $advert->setName($faker->realText(100));
            $advert->setBrand($this->brandRepository->find(random_int(1, 10)));
            $advert->setIsBooked(true);
            $advert->setType($this->advertTypeRepository->find(random_int(1, 2)));
            $advert->setUser($user);
            $advert->setCreatedAt($faker->dateTimeBetween("- 1 year", "now"));
        }

        $manager->flush();
    }

    public function getDependencies() : array
    {
        return [
            BrandFixtures::class,
            UserFixtures::class,
            AdvertType::class
        ];
    }
}
