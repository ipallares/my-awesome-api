<?php

namespace App\DataFixtures;

use App\Entity\JobPosition;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class JobPositionFixture extends MyAbstractFixture implements FixtureInterface
{
    public const JUNIOR_DEVELOPER = 'juniorDeveloper';

    public function myLoad(ObjectManager $manager)
    {
        $jobPosition = new JobPosition();
        $jobPosition->setName('Junior Developer');
        $jobPosition->setPricePerHour('40');

        $this->addReference(self::JUNIOR_DEVELOPER, $jobPosition);

        $manager->persist($jobPosition);
        $manager->flush();
    }

    /**
     * @param string $name
     *
     * @return JobPosition
     */
    public function getReference($name): JobPosition
    {
        /** @var JobPosition $jobPosition */
        $jobPosition = parent::getReference($name);

        return $jobPosition;
    }
}
