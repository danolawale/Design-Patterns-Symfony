<?php

declare(strict_types=1);

namespace App\EventSubscriber\PublishSubscriber;

use App\Event\PublishSubscriber\TemperatureChangeEvent;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class TemperatureChangeEventSubscriber implements EventSubscriberInterface
{
    public function notify(TemperatureChangeEvent $event)
    {
        $io = new SymfonyStyle(new ArrayInput([]), new ConsoleOutput());
        $io->writeln("\n
            Processing Temperature Readings...............");
        $average = $event->processorHandler()->getAverageReading($event->getReadings());
        $maximum = $event->processorHandler()->getMaximumReading($event->getReadings());
        $minimum = $event->processorHandler()->getMinimumReading($event->getReadings());

        $note = sprintf(
            "
            The Average temperature reading is %f;\n
            The Maximum temperature reading is %f;\n
            The minimum temperature reading is %f.\n",
            $average,
            $maximum,
            $minimum
        );
        $io->write($note);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            TemperatureChangeEvent::class => 'notify'
        ];
    }
}
