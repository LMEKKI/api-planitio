<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private UserPasswordHasherInterface $passwordHasher;
    // Injecter le service UserPasswordHasherInterface dans le constructeur
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $faker->addProvider(new \Xvladqt\Faker\LoremFlickrProvider($faker)); // permet de générer des images aléatoires depuis l'API LoremFlickr
        $userAdmin = new User();
        $userAdmin->setFirstName($faker->firstName);
        $userAdmin->setLastName($faker->lastName);
        $userAdmin->setEmail($faker->email);
        $hashedPassword = $this->passwordHasher->hashPassword($userAdmin, 'admin');
        $userAdmin->setPassword($hashedPassword);
        $userAdmin->setRoles($this->getReference(RoleFixtures::ADMIN_USER_REFERENCE));
        $manager->persist($userAdmin);


        $userRh = new User();
        $userRh->setFirstName($faker->firstName);
        $userRh->setLastName($faker->lastName);
        $userRh->setEmail($faker->email);
        $hashedPassword = $this->passwordHasher->hashPassword($userRh, 'admin');
        $userRh->setPassword($hashedPassword);
        $userRh->setRoles($this->getReference(RoleFixtures::RH_USER_REFERENCE));
        $manager->persist($userRh);

        $userManager = new User();
        $userManager->setFirstName($faker->firstName);
        $userManager->setLastName($faker->lastName);
        $userManager->setEmail($faker->email);
        $hashedPassword = $this->passwordHasher->hashPassword($userManager, 'admin');
        $userManager->setPassword($hashedPassword);
        $userManager->setRoles($this->getReference(RoleFixtures::MANAGER_USER_REFERENCE));
        $manager->persist($userManager);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            RoleFixtures::class,
        ];
    }
}
