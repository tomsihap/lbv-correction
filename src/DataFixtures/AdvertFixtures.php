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

        $user1 = $this->userRepository->findOneBy([
            "email" => "user@user.com"
        ]);

        $user2 = $this->userRepository->findOneBy([
            "email" => "user2@user.com"
        ]);

        $users = [$user1, $user2];

        /**
         * Non booked averts
         */
        for ($i = 0; $i < 2; $i++) {
            $advert = new Advert();
            $advert->setName($faker->text(50));
            $advert->setDescription($faker->realText(500));
            $advert->setBrand($this->brandRepository->find(random_int(1, 5)));
            $advert->setType($this->advertTypeRepository->find(random_int(1, 2)));
            $advert->setUser($users[array_rand($users)]);
            $advert->setCreatedAt($faker->dateTimeBetween("- 1 year", "now"));
            $manager->persist($advert);
        }

        /**
         * Booked adverts by user 1
         */
        for ($i = 0; $i < 4; $i++) {
            $advert = new Advert();
            $advert->setName($faker->text(50));
            $advert->setDescription($faker->realText(500));
            $advert->setBrand($this->brandRepository->find(random_int(1, 5)));
            $advert->setType($this->advertTypeRepository->find(random_int(1, 2)));
            $advert->setUser($user2);
            $advert->setCreatedAt($faker->dateTimeBetween("- 1 year", "now"));
            $advert->setBookingUser($user1);
            $manager->persist($advert);
        }

        /**
         * Booked adverts by user 2
         */
        for ($i = 0; $i < 4; $i++) {
            $advert = new Advert();
            $advert->setName($faker->text(50));
            $advert->setDescription($faker->realText(500));
            $advert->setBrand($this->brandRepository->find(random_int(1, 5)));
            $advert->setType($this->advertTypeRepository->find(random_int(1, 2)));
            $advert->setUser($user1);
            $advert->setCreatedAt($faker->dateTimeBetween("- 1 year", "now"));
            $advert->setBookingUser($user2);
            $manager->persist($advert);
        }

        $manager->flush();
    }

    public function getDependencies() : array
    {
        return [
            BrandFixtures::class,
            UserFixtures::class,
            AdvertTypeFixtures::class
        ];
    }
}
