<?php

declare(strict_types=1);

namespace App\Command\Builder;


use App\DesignPatterns\Builder\ComputerFactory;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

#[AsCommand('app:build:user:computer')]
class ComputerBuilderCommand extends Command
{
    public function __construct(private readonly ComputerFactory $factory, private readonly string $projectDir)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setHelp('This command processes and builds computers based on the user specifications on a csv file')
            ->setDescription(
                'This command processes and builds computers based on the user specifications on a csv file'
            )
            ->addArgument('userId', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        //TODO: Add try-catch
        if ($userId = $input->getArgument('userId')) {
            $output->writeln("\nBuild computer(s) for user with id $userId.\n");
        }

        $userSpecificationsFile = $this->projectDir . '/upload/builder/userSpecifications.csv';
        $decoder = new Serializer([new ObjectNormalizer()], [new CsvEncoder()]);
        $rows = $decoder->decode(file_get_contents($userSpecificationsFile), 'csv');
        $row = array_values(array_filter($rows, static fn($row): bool => $row['email'] === $userId))[0];

        $computer = $this->factory->build($row);
        $output->writeln($computer->getCompletionNotes());
        return self::SUCCESS;
    }
}
#command example
#php bin/console app:build:user:computer jamie@devtest.com
