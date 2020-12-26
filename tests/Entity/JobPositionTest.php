<?php

namespace App\Tests\Entity;

use App\DataFixtures\JobPositionFixture;
use App\Entity\JobPosition;
use App\Tests\AbstractWebTestCase;
use Tightenco\Collect\Support\Collection;

class JobPositionTest extends AbstractWebTestCase
{
    public function testToArray()
    {
        /** @var JobPosition $juniorDeveloper */
        $juniorDeveloper = $this
            ->myFixtures[JobPositionFixture::class]
            ->getReference(JobPositionFixture::JUNIOR_DEVELOPER);

        $juniorDeveloperToArray = $juniorDeveloper->toArray();

        $this->assertEquals($juniorDeveloper->getName(), $juniorDeveloperToArray['name']);
        $this->assertEquals(
            $juniorDeveloper->getPricePerHour(),
            $juniorDeveloperToArray['pricePerHour']
        );
    }

    protected function getRequiredFixturesFQDN(): Collection
    {
        return new Collection([
              JobPositionFixture::class
        ]);
    }
}
