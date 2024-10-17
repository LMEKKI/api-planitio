<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Event;
use Faker\Factory;

class EventFixtures extends Fixture
{
    public const EVENT_REFERENCE = 'event-';
    public const NB_EVENTS = 5;
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < self::NB_EVENTS; $i++) {
            $event = new Event();
            $event->setTitle($faker->sentence(3));
            $event->setDescription($faker->text);
            $event->setStartDate($faker->dateTimeBetween('-1 month', '+1 month'));
            $event->setEndDate($faker->dateTimeBetween($event->getStartDate(), '+1 month'));
            $manager->persist($event);
            $this->addReference(self::EVENT_REFERENCE . $i, $event);
        }

        $manager->flush();
    }
}
