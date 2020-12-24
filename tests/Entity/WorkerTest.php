<?php

namespace App\Tests\Entity;

use App\DataFixtures\EmployeeTaskFixture;
use App\Entity\Worker;
use App\Tests\AbstractWebTestCase;
use Tightenco\Collect\Support\Collection;

class WorkerTest extends AbstractWebTestCase
{
    public function testToArray()
    {
        /** @var Worker $johnDoe */
        $johnDoe = $this
            ->myFixtures[EmployeeTaskFixture::class]
            ->getReference(EmployeeTaskFixture::JOHN_DOE_REF);

        $jobPosition = $johnDoe->getJobPosition();

        $johnDoeToArray = $johnDoe->toArray();

        $this->assertEquals($johnDoe->getName(), $johnDoeToArray['name']);
        $this->assertEquals($johnDoe->getId(), $johnDoeToArray['id']);
        $this->assertEquals(
            $johnDoe->getTasks()->count(),
            count($johnDoeToArray['taskIds'])
        );
        $this->assertEquals($jobPosition->getId(), $johnDoeToArray['jobPosition']);
    }

    protected function getRequiredFixturesFqdn(): Collection
    {
        return new Collection([
            EmployeeTaskFixture::class
        ]);
    }
}
