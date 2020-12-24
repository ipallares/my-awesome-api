<?php

namespace App\Tests;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Hautelook\AliceBundle\PhpUnit\ReloadDatabaseTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Tightenco\Collect\Support\Collection;

abstract class AbstractWebTestCase extends WebTestCase
{
    use ReloadDatabaseTrait;

    /**
     * @var Collection<string, FixtureInterface>
     */
    protected $myFixtures;

    public function setUp()
    {
        $client = static::createClient();
        $container = $client->getContainer();
        $doctrine = $container->get('doctrine');
        $entityManager = $doctrine->getManager();

        $this->myFixtures = new Collection();
        $requiredFixturesFqdn = $this->getRequiredFixturesFqdn();
        $requiredFixturesFqdn->each(
            function($fixtureFqdn) use ($container, $entityManager){
                $fixture = $container->get($fixtureFqdn);
                $fixture->load($entityManager);
                $this->myFixtures->put($fixtureFqdn, $fixture);
            }
        );
    }

    /**
     * @return Collection<int, FixtureInterface>
     */
    abstract protected function getRequiredFixturesFqdn(): Collection;
}
