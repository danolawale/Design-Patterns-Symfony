<?php

namespace App\DesignPatterns\PublishSubscriber\WeatherStation;

interface WeatherReadingsProcessorInterface
{
    public function process(array $readings): void;
}
