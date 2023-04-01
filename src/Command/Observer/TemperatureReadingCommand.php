<?php

declare(strict_types=1);

namespace App\Command\Observer;

use App\DesignPatterns\Observer\WeatherStation\TemperatureTransmissionService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\{InputInterface, InputOption};
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand('app:avg:temp:notify')]
class TemperatureReadingCommand extends Command
{
    public function __construct(
        private readonly TemperatureTransmissionService $service
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setHelp('This command calculates the average temperature reading and displays on various temp monitors')
            ->setDescription('This command calculates the average temperature reading and displays on various
             temp monitors')
            ->addOption('temp', 't', InputOption::VALUE_REQUIRED)
            ->addOption('processor', 'p', InputOption::VALUE_OPTIONAL);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if (!$input->getOption('temp')) {
            $output->writeln("Please specify a comma separated list of the temperature readings. 
            These should be numbers");
            return Command::FAILURE;
        }

        if (!$input->getOption('processor')) {
            $output->writeln("\nThe default processor is 'Average'\n");
        }

        $temperatures = array_map(
            static fn($temp): float => floatval($temp),
            explode(',', trim($input->getOption('temp')))
        );

        $this->service->setTemperatureReadings($temperatures);

        $this->service->notify($input->getOption('processor') ?: 'average');

        return Command::SUCCESS;
    }
}
//terminal commands
//./bin/console app:avg:temp:notify --temp 30,50,60
//./bin/console app:avg:temp:notify --temp 30,50,60 --processor max
