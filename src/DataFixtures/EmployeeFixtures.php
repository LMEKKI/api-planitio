<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Employee;

class EmployeeFixtures extends Fixture
{
    public const EMPLOYEE_REFERENCE = 'employee-';
    public const NB_EMPLOYEE = 5;
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < self::NB_EMPLOYEE; $i++) {
            $employee = new Employee();
            $employee->setFirstName($faker->firstName);
            $employee->setLastName($faker->lastName);
            $employee->setEmail($faker->email);
            $manager->persist($employee);
            $this->addReference(self::EMPLOYEE_REFERENCE . $i, $employee);
        }

        $manager->flush();
    }
}
