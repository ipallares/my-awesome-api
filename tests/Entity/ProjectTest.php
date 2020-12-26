<?php

namespace App\Tests\Entity;

use App\DataFixtures\ProjectFixture;
use App\Entity\Project;
use App\Tests\AbstractWebTestCase;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Tightenco\Collect\Support\Collection;

class ProjectTest extends AbstractWebTestCase
{
    public function testToArray()
    {
        /** @var Project $myProject */
        $myProject = $this
            ->myFixtures[ProjectFixture::class]
            ->getReference(ProjectFixture::MY_PROJECT);

        $myProjectToArray = $myProject->toArray();

        $this->assertEquals($myProject->getName(), $myProjectToArray['name']);
        $this->assertEquals($myProject->getBudget(), $myProjectToArray['budget']);
        $this->assertEmpty($myProjectToArray['taskIds']);
    }

    /**
     * @return Collection<int, FixtureInterface>
     */
    protected function getRequiredFixturesFQDN(): Collection
    {
        return new Collection([
            ProjectFixture::class
        ]);
    }
}
