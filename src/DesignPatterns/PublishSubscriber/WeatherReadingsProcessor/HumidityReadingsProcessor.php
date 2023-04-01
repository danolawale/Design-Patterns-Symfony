<?php

declare(strict_types=1);

namespace App\DesignPatterns\PublishSubscriber\WeatherReadingsProcessor;

use App\DesignPatterns\PublishSubscriber\WeatherReadingsProcessor\Helper\GenericWeatherReadingsProcessorHelper;
use App\DesignPatterns\PublishSubscriber\WeatherStation\WeatherReadingsProcessorInterface;
use App\Event\PublishSubscriber\HumidityChangeEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

final class HumidityReadingsProcessor implements WeatherReadingsProcessorInterface
{
    public function __construct(private readonly EventDispatcherInterface $eventDispatcher)
    {
    }

    public function process(array $readings): void
    {
        $this->eventDispatcher->dispatch(
            new HumidityChangeEvent($readings, new GenericWeatherReadingsProcessorHelper())
        );
    }
}
