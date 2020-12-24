<?php

namespace App\DataFixtures;

use App\Entity\Task;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TaskFixture extends MyAbstractFixture implements FixtureInterface
{
    public const MY_FIRST_TASK = 'MyFirstTask';

    /**
     * @var WorkerFixture
     */
    private $workerFixtures;

    /**
     * @var ProjectFixture
     */
    private $projectFixtures;

    /**
     * TaskFixture constructor.
     *
     * @param WorkerFixture $workerFixtures
     * @param ProjectFixture $projectFixtures
     */
    public function __construct(WorkerFixture $workerFixtures, ProjectFixture $projectFixtures)
    {
        $this->workerFixtures = $workerFixtures;
        $this->projectFixtures = $projectFixtures;
    }

    public function myLoad(ObjectManager $manager)
    {
        $this->projectFixtures->load($manager);
        $this->workerFixtures->load($manager);
        $project = $this->projectFixtures->getReference(ProjectFixture::MY_PROJECT);
        $worker = $this->workerFixtures->getReference(WorkerFixture::JOHN_DOE);

        $task = new Task();
        $task->setName('My first task');
        $task->setPrice(400);
        $task->setDescription('Creating commands to generate some classes');
        $task->setProject($project);
        $task->setWorker($worker);

        $this->addReference(self::MY_FIRST_TASK, $task);

        $manager->persist($task);
        $manager->flush();
    }

    /**
     * @param string $name
     *
     * @return Task
     */
    public function getReference($name): Task
    {
        /** @var Task $task */
        $task = parent::getReference($name);

        return $task;
    }
}
