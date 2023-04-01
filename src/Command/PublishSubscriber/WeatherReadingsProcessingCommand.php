<?php

declare(strict_types=1);

namespace App\Command\PublishSubscriber;

use App\DesignPatterns\PublishSubscriber\WeatherStation\WeatherPublishingServiceInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand('app:weather:process:readings')]
class WeatherReadingsProcessingCommand extends Command
{
    public function __construct(private readonly WeatherPublishingServiceInterface $service)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setHelp('This command processes various weather readings')
            ->setDescription('This command processes various weather readings')
            ->addOption('temp', 't', InputOption::VALUE_OPTIONAL)
            ->addOption('humidity', 'hu', InputOption::VALUE_OPTIONAL);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $temperatureReadings = [];
        $humidityReadings = [];
        if ($input->getOption('temp')) {
            $temperatureReadings = array_filter(explode(',', trim($input->getOption('temp'))));
            if (empty($temperatureReadings)) {
                $output->writeln("Please supply a comma separated list of temperature readings.");
                return Command::FAILURE;
            }
        }

        if ($input->getOption('humidity')) {
            $humidityReadings = array_filter(explode(',', trim($input->getOption('humidity'))));
            if (empty($humidityReadings)) {
                $output->writeln("Please supply a comma separated list of humidity readings.");
                return Command::FAILURE;
            }
        }

        $readings = array_filter([
            'temperature' => $temperatureReadings,
            'humidity' => $humidityReadings
        ]);

        if (empty($readings)) {
            $output->writeln("Please specify either temperature or humidity readings or both.");
            return Command::FAILURE;
        }

        $this->service->publish($readings);
        return Command::SUCCESS;
    }
}
#run
#./bin/console app:weather:process:readings --temp 30,70,50 --humidity 43,56,21
#./bin/console app:weather:process:readings --humidity 43,56,21
#./bin/console app:weather:process:readings --temp 30,70,50
