<?php

namespace App\Tests\Entity;

use App\DataFixtures\EmployeeTaskFixture;
use App\Entity\Task;
use App\Tests\AbstractWebTestCase;
use Tightenco\Collect\Support\Collection;

class TaskTest extends AbstractWebTestCase
{
    public function testToArray()
    {
        /** @var Task $myFirstTask */
        $myFirstTask = $this
            ->myFixtures[EmployeeTaskFixture::class]
            ->getReference(EmployeeTaskFixture::MY_FIRST_TASK_REF);

        $myFirstTaskToArray = $myFirstTask->toArray();

        $this->assertEquals($myFirstTask->getName(), $myFirstTaskToArray['name']);
        $this->assertEquals($myFirstTask->getPrice(), $myFirstTaskToArray['price']);
        $this->assertEquals(
            $myFirstTask->getProject()->getId(),
            $myFirstTaskToArray['projectId']
        );
        $this->assertEquals(
            $myFirstTask->getWorker()->getId(),
            $myFirstTaskToArray['workerId']
        );
    }

    protected function getRequiredFixturesFQDN(): Collection
    {
        return new Collection([
            EmployeeTaskFixture::class
        ]);
    }
}
