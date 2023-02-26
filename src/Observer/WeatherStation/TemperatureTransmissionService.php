<?php

declare(strict_types=1);

namespace App\Observer\WeatherStation;

use App\Observer\Display\TemperatureDisplayInterface;

class TemperatureTransmissionService implements TemperatureTransmissionServiceInterface
{
    /**
     * @var TemperatureDisplayInterface[] $displays
     */
    private array $displays = [];

    public function __construct(private readonly TemperatureReadingsProcessor $temperatureReadingsProcessor)
    {
    }

    public function subscribe(TemperatureDisplayInterface $display): void
    {
        $this->displays[] = $display;
    }

    public function unsubscribe(TemperatureDisplayInterface $display): void
    {
        $display = array_search($display, $this->displays);
        if ($display) {
            unset($this->displays[$display]);
        }
    }

    public function notify(string $processor): void
    {
        foreach ($this->displays as $display) {
            $display->display($processor);
        }
    }

    public function setTemperatureReadings(array $readings): void
    {
        $this->temperatureReadingsProcessor->setTemperatureReadings($readings);
    }

    public function getTemperatureReading(string $processorType): float
    {
        return $this->temperatureReadingsProcessor->getProcessedReading($processorType);
    }
}
//./bin/console app:avg:temp:notify -temp30,50,60
