<?php

namespace App\DataFixtures;

use App\Entity\JobPosition;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\ReferenceRepository;
use Doctrine\Persistence\ObjectManager;

class JobPositionFixture extends Fixture implements FixtureInterface
{
    public const JUNIOR_DEVELOPER = 'juniorDeveloper';

    public function load(ObjectManager $manager)
    {
        $jobPosition = new JobPosition();
        $jobPosition->setName('Junior Developer');
        $jobPosition->setPricePerHour('40');

        $this->setReferenceRepository(new ReferenceRepository($manager));
        $this->addReference(self::JUNIOR_DEVELOPER, $jobPosition);

        $manager->persist($jobPosition);
        $manager->flush();
    }

    public function getReference($name): JobPosition
    {
        /** @var JobPosition $jobPosition */
        $jobPosition = parent::getReference($name);

        return $jobPosition;
    }
}
