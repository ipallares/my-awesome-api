<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

use App\Tests\AbstractWebTestCase;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Tightenco\Collect\Support\Collection;

class <?= $class_name ?> extends AbstractWebTestCase
{
    public function testToArray()
    {
        // TODO: Implement the tests. Example:

        ///** @var Project $myProject */
        //$myProject = $this
        //->myFixtures[ProjectFixture::class]
        //->getReference(ProjectFixture::MY_PROJECT);

        //$myProjectToArray = $myProject->toArray();

        //$this->assertEquals($myProject->getName(), $myProjectToArray['name']);
        //$this->assertEquals($myProject->getBudget(), $myProjectToArray['budget']);
        //$this->assertEmpty($myProjectToArray['taskIds']);
    }

    /**
     * @return Collection<int, FixtureInterface>
     */
    protected function getRequiredFixturesFQDN(): Collection
    {
        return new Collection([
            // TODO: Add the fixtures that will be needed for the test. Example:
            // ProjectFixture::class
        ]);
    }
}
