<?php

namespace App\Tests\Entity;

use App\DataFixtures\JobPositionFixture;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class JobPositionTest extends WebTestCase
{
    /**
     * @var JobPositionFixture
     */
    private $fixture;

    public function setUp()
    {
        $client = static::createClient();
        $container = $client->getContainer();
        $doctrine = $container->get('doctrine');
        $entityManager = $doctrine->getManager();

        $this->fixture = new JobPositionFixture();
        $this->fixture->load($entityManager);
    }

    public function testAdd()
    {
        $juniorDeveloper = $this->fixture->getReference(JobPositionFixture::JUNIOR_DEVELOPER);

        $juniorDeveloperToArray = $juniorDeveloper->toArray();

        $this->assertEquals('Junior Developer', $juniorDeveloperToArray['name']);
        $this->assertEquals(40, $juniorDeveloperToArray['pricePerHour']);
    }
}
