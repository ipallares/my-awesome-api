<?php

namespace App\Tests\Entity;

use App\DataFixtures\TaskFixture;
use App\DataFixtures\WorkerFixture;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class WorkerTest extends WebTestCase
{
    /**
     * @var WorkerFixture
     */
    private $fixture;

    public function setUp()
    {
        $client = static::createClient();
        $container = $client->getContainer();
        $doctrine = $container->get('doctrine');
        $entityManager = $doctrine->getManager();

        $this->fixture = $container->get(WorkerFixture::class);
        $this->fixture->load($entityManager);
    }

    public function testToArray()
    {
        $johnDoe = $this->fixture->getReference(WorkerFixture::JOHN_DOE);
        $jobPosition = $johnDoe->getJobPosition();
        $johnDoeToArray = $johnDoe->toArray();

        $this->assertEquals('John Doe', $johnDoeToArray['name']);
        $this->assertEquals($jobPosition->getId(), $johnDoeToArray['jobPosition']);
        $this->assertEmpty($johnDoeToArray['taskIds']);
    }
}
