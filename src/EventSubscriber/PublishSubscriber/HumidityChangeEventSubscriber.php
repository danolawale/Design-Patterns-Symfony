<?php

declare(strict_types=1);

namespace App\EventSubscriber\PublishSubscriber;

use App\Event\PublishSubscriber\HumidityChangeEvent;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class HumidityChangeEventSubscriber implements EventSubscriberInterface
{
    public function notify(HumidityChangeEvent $event)
    {
        $io = new SymfonyStyle(new ArrayInput([]), new ConsoleOutput());
        $io->writeln("\n
            Processing Humidity Readings...............");
        $average = $event->processorHandler()->getAverageReading($event->getReadings());
        $maximum = $event->processorHandler()->getMaximumReading($event->getReadings());
        $minimum = $event->processorHandler()->getMinimumReading($event->getReadings());

        $note = sprintf(
            "
            The Average humidity reading is %f;\n
            The Maximum humidity reading is %f;\n
            The minimum humidity reading is %f.\n",
            $average,
            $maximum,
            $minimum
        );
        $io->write($note);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            HumidityChangeEvent::class => 'notify'
        ];
    }
}
