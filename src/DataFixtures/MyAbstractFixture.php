<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\ReferenceRepository;
use Doctrine\Persistence\ObjectManager;

abstract class MyAbstractFixture extends Fixture implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $this->setReferenceRepository(new ReferenceRepository($manager));
        $this->myLoad($manager);
    }

    abstract public function myLoad(ObjectManager $manager);
}
