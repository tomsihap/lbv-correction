<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {

        /**
         * Créer une fixture de User - voir la doc :
         * https://symfony.com/doc/master/bundles/DoctrineFixturesBundle/index.html#accessing-services-from-the-fixtures
         */
        $userAdmin = new User();
        $userAdmin->setEmail("admin@admin.com");
        $userAdmin->setFirstname("John");
        $userAdmin->setLastname("Doe");
        $userAdmin->setPassword(
            $this->encoder->encodePassword($userAdmin, "admin@admin.com")
        );
        $userAdmin->setRoles(["ROLE_ADMIN"]);

        $manager->persist($userAdmin);

        $userStandard = new User();
        $userStandard->setEmail("user@user.com");
        $userStandard->setFirstname("Emma");
        $userStandard->setLastname("Watson");
        $userStandard->setPassword(
            $this->encoder->encodePassword($userStandard, "user@user.com")
        );

        $manager->persist($userStandard);

        $manager->flush();
    }
}
