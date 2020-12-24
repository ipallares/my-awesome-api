<?php

namespace App\DataFixtures;

use App\Entity\Task;
use App\Entity\Worker;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class WorkerFixture extends MyAbstractFixture implements FixtureInterface
{
    public const JOHN_DOE = 'john_doe';

    /**
     * @var JobPositionFixture
     */
    private $jobPositionFixtures;

    /**
     * WorkerFixture constructor.
     *
     * @param JobPositionFixture $jobPositionFixtures
     */
    public function __construct(JobPositionFixture $jobPositionFixtures)
    {
        $this->jobPositionFixtures = $jobPositionFixtures;
    }

    public function myLoad(ObjectManager $manager)
    {
        $this->jobPositionFixtures->load($manager);
        $juniorDeveloper = $this->jobPositionFixtures->getReference(
            JobPositionFixture::JUNIOR_DEVELOPER
        );
        $worker = new Worker();
        $worker->setName('John Doe');
        $worker->setJobPosition($juniorDeveloper);

        $this->addReference(self::JOHN_DOE, $worker);

        $manager->persist($worker);
        $manager->flush();
    }

    /**
     * @param string $name
     *
     * @return Worker
     */
    public function getReference($name): Worker
    {
        /** @var Worker $worker */
        $worker = parent::getReference($name);

        return $worker;
    }
}
