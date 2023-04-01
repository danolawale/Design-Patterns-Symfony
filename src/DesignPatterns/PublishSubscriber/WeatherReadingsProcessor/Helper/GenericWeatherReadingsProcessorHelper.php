<?php

declare(strict_types=1);

namespace App\DesignPatterns\PublishSubscriber\WeatherReadingsProcessor\Helper;

final class GenericWeatherReadingsProcessorHelper
{
    public function getAverageReading(array $readings): float
    {
        return array_sum($readings) / count($readings);
    }

    public function getMaximumReading(array $readings): float
    {
        return (float) max(...$readings);
    }

    public function getMinimumReading(array $readings): float
    {
        return (float) min(...$readings);
    }
}
