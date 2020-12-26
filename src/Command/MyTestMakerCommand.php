<?php

namespace App\Command;

use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Bundle\MakerBundle\DependencyBuilder;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Bundle\MakerBundle\InputConfiguration;
use Symfony\Bundle\MakerBundle\Maker\AbstractMaker;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;

class MyTestMakerCommand extends AbstractMaker
{
    public static function getCommandName(): string
    {
        return 'my:make:test';
    }

    /**
     * @inheritDoc
     */
    public function configureCommand(Command $command, InputConfiguration $inputConfig)
    {
        $command
            ->setDescription('Creates new test backbone with the expected methods ')
            ->addArgument('class-name', InputArgument::REQUIRED, 'The class\' full name of the test to create (e.g. <fg=yellow>MyServiceTest</>)')
            ->addArgument('folder-name', InputArgument::REQUIRED, 'The folder in tests/ where the new class will be created')
            ;
    }

    /**
     * @inheritDoc
     */
    public function generate(InputInterface $input, ConsoleStyle $io, Generator $generator)
    {
        $className = $input->getArgument('class-name');
        $folderName = $input->getArgument('folder-name');
        $namespace = 'Tests\\' . $folderName;

        $testClassNameDetails = $generator->createClassNameDetails($className, $namespace);

        $generator->generateClass(
            $testClassNameDetails->getFullName(),
            '../../../../../../src/Resources/Templates/Test.tpl.php'
        );

        $generator->writeChanges();
        $this->writeSuccessMessage($io);
        $io->text(
            [
                "Test class $className in folder /tests/$folderName was created.",
                "Check it out and fill the necessary methods."
            ]
        );
    }

    /**
     * @inheritDoc
     */
    public function configureDependencies(DependencyBuilder $dependencies)
    {
    }
}
