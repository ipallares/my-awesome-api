<?php

namespace App\DataFixtures;

use App\Entity\Task;
use App\Entity\Worker;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EmployeeTaskFixture extends MyAbstractFixture implements FixtureInterface
{
    public const MY_FIRST_TASK_REF = 'MyFirstTask';
    public const JOHN_DOE_REF = 'JohnDoe';

    /**
     * @var ProjectFixture
     */
    private $projectFixtures;

    /**
     * @var JobPositionFixture
     */
    private $jobPositionFixtures;

    /**
     * EmployeeTaskFixture constructor.
     *
     * @param ProjectFixture $projectFixtures
     * @param JobPositionFixture $jobPositionFixtures
     */
    public function __construct(ProjectFixture $projectFixtures, JobPositionFixture $jobPositionFixtures)
    {
        $this->projectFixtures = $projectFixtures;
        $this->jobPositionFixtures = $jobPositionFixtures;
    }

    public function myLoad(ObjectManager $manager)
    {
        $this->projectFixtures->load($manager);
        $this->jobPositionFixtures->load($manager);

        $project = $this
            ->projectFixtures
            ->getReference(ProjectFixture::MY_PROJECT);

        $juniorDeveloper = $this
            ->jobPositionFixtures
            ->getReference(JobPositionFixture::JUNIOR_DEVELOPER);

        // Create Worker John Doe
        $worker = new Worker();
        $worker->setName('John Doe');
        $worker->setJobPosition($juniorDeveloper);

        $this->addReference(self::JOHN_DOE_REF, $worker);

        // Create First Task
        $task = new Task();
        $task->setName('My first task');
        $task->setPrice(400);
        $task->setDescription('Creating commands to generate some classes');
        $task->setProject($project);
        $task->setWorker($worker);

        $this->addReference(self::MY_FIRST_TASK_REF, $task);

        // Aparently this needs to be done in the related entities as well!
        $project->addTask($task);
        $worker->addTask($task);

        $manager->persist($task);
        $manager->persist($worker);
        $manager->persist($project);

        $manager->flush();
    }

}
