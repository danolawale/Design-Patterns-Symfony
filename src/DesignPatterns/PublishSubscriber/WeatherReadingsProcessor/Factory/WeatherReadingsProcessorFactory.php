<?php

declare(strict_types=1);

namespace App\DesignPatterns\PublishSubscriber\WeatherReadingsProcessor\Factory;

use App\DesignPatterns\PublishSubscriber\WeatherReadingsProcessor\HumidityReadingsProcessor;
use App\DesignPatterns\PublishSubscriber\WeatherReadingsProcessor\TemperatureReadingsProcessor;
use App\DesignPatterns\PublishSubscriber\WeatherStation\WeatherReadingsProcessorInterface;
use RuntimeException;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class WeatherReadingsProcessorFactory
{
    public function __construct(private readonly EventDispatcherInterface $eventDispatcher)
    {
    }

    public function getProcessor(string $processor): WeatherReadingsProcessorInterface
    {
        return match ($processor) {
            'temperature' => new TemperatureReadingsProcessor($this->eventDispatcher),
            'humidity' => new HumidityReadingsProcessor($this->eventDispatcher),
            'default' => throw new RuntimeException("Invalid processor $processor")
        };
    }
}
