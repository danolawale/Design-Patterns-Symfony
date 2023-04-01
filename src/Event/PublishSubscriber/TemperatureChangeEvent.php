<?php

declare(strict_types=1);

namespace App\Event\PublishSubscriber;

use App\DesignPatterns\PublishSubscriber\WeatherReadingsProcessor\Helper\GenericWeatherReadingsProcessorHelper;

class TemperatureChangeEvent
{
    public function __construct(
        private array $readings,
        private readonly GenericWeatherReadingsProcessorHelper $processorHelper
    ) {
    }

    public function getReadings(): array
    {
        return $this->readings;
    }

    public function processorHandler(): GenericWeatherReadingsProcessorHelper
    {
        return $this->processorHelper;
    }
}
