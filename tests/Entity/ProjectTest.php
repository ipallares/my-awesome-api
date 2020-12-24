<?php

namespace App\Tests\Entity;

use App\DataFixtures\ProjectFixture;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectTest extends WebTestCase
{
    /**
     * @var ProjectFixture
     */
    private $fixture;

    public function setUp()
    {
        $client = static::createClient();
        $container = $client->getContainer();
        $doctrine = $container->get('doctrine');
        $entityManager = $doctrine->getManager();

        $this->fixture = $container->get(ProjectFixture::class);
        $this->fixture->load($entityManager);
    }

    public function testToArray()
    {
        $myProject = $this->fixture->getReference(ProjectFixture::MY_PROJECT);
        $myProjectToArray = $myProject->toArray();

        $this->assertEquals('My Awesome Project', $myProjectToArray['name']);
        $this->assertEquals(150000, $myProjectToArray['budget']);
        $this->assertEmpty($myProjectToArray['taskIds']);
    }
}
