<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Entity\Schedule;

class SchdulesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        for ($i = 0; $i < 5; $i++) {
            $event =  $this->getReference(EventFixtures::EVENT_REFERENCE . $i);
            $employee =  $this->getReference(EmployeeFixtures::EMPLOYEE_REFERENCE . $i);
            $schdules = new Schedule();
            $schdules->setEvent($event);
            $schdules->setEmployee($employee);
            $schdules->setDate($event->getStartDate());
            $manager->persist($schdules);
        }
        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            EventFixtures::class,
            EmployeeFixtures::class,
        ];
    }
}
