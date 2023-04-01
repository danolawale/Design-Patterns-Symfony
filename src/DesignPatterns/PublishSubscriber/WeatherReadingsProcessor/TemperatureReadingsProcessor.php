<?php

declare(strict_types=1);

namespace App\DesignPatterns\PublishSubscriber\WeatherReadingsProcessor;

use App\DesignPatterns\PublishSubscriber\WeatherReadingsProcessor\Helper\GenericWeatherReadingsProcessorHelper;
use App\DesignPatterns\PublishSubscriber\WeatherStation\WeatherReadingsProcessorInterface;
use App\Event\PublishSubscriber\TemperatureChangeEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

final class TemperatureReadingsProcessor implements WeatherReadingsProcessorInterface
{
    public function __construct(private readonly EventDispatcherInterface $eventDispatcher)
    {
    }

    public function process(array $readings): void
    {
        $this->eventDispatcher->dispatch(
            new TemperatureChangeEvent($readings, new GenericWeatherReadingsProcessorHelper())
        );
    }
}
