<?php

namespace App\DataFixtures;

use App\Entity\Project;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProjectFixture extends MyAbstractFixture implements FixtureInterface
{
    public const MY_PROJECT = 'MyProject';

    public function myLoad(ObjectManager $manager)
    {
        $project = new Project();
        $project->setName('My Awesome Project');
        $project->setBudget('150000');

        $this->addReference(self::MY_PROJECT, $project);

        $manager->persist($project);
        $manager->flush();
    }

    /**
     * @param string $name
     *
     * @return Project
     */
    public function getReference($name): Project
    {
        /** @var Project $project */
        $project = parent::getReference($name);

        return $project;
    }
}
