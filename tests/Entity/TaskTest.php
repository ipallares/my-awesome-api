<?php

namespace App\Tests\Entity;

use App\DataFixtures\TaskFixture;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TaskTest extends WebTestCase
{
    /**
     * @var TaskFixture
     */
    private $fixture;

    public function setUp()
    {
        $client = static::createClient();
        $container = $client->getContainer();
        $doctrine = $container->get('doctrine');
        $entityManager = $doctrine->getManager();

        $this->fixture = $container->get(TaskFixture::class);
        $this->fixture->load($entityManager);
    }

    public function testToArray()
    {
        $myFirstTask = $this->fixture->getReference(TaskFixture::MY_FIRST_TASK);
        $myFirstTaskToArray = $myFirstTask->toArray();

        $this->assertEquals('My first task', $myFirstTaskToArray['name']);
        $this->assertEquals(400, $myFirstTaskToArray['price']);
        $this->assertEquals(
            $myFirstTask->getProject()->getId(),
            $myFirstTaskToArray['projectId']
        );
        $this->assertEquals(
            $myFirstTask->getWorker()->getId(),
            $myFirstTaskToArray['workerId']
        );
    }
}
