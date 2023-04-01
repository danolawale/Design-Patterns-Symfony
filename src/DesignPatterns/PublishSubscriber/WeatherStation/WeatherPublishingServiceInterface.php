<?php

namespace App\DesignPatterns\PublishSubscriber\WeatherStation;

interface WeatherPublishingServiceInterface
{
    public function publish(array $readings): void;
}
