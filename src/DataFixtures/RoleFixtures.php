<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Role;

class RoleFixtures extends Fixture
{

    public const RH_USER_REFERENCE = 'ROLE_RH';
    public const ADMIN_USER_REFERENCE = 'ROLE_ADMIN';
    public const MANAGER_USER_REFERENCE = 'ROLE_MANAGER';

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $roleRh = new Role();
        $roleRh->setName(self::RH_USER_REFERENCE);
        $roleManager = new Role();
        $roleManager->setName(self::MANAGER_USER_REFERENCE);
        $roleAdmin = new Role();
        $roleAdmin->setName(self::ADMIN_USER_REFERENCE);
        $manager->persist($roleAdmin, $roleManager, $roleRh);
        $this->addReference(self::RH_USER_REFERENCE, $roleRh);
        $this->addReference(self::MANAGER_USER_REFERENCE, $roleManager);
        $this->addReference(self::ADMIN_USER_REFERENCE, $roleAdmin);
        $manager->flush();
    }
}
