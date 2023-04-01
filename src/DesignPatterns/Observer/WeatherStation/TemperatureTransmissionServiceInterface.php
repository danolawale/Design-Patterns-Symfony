<?php

namespace App\DesignPatterns\Observer\WeatherStation;

use App\DesignPatterns\Observer\Display\TemperatureDisplayInterface;

interface TemperatureTransmissionServiceInterface
{
    public function subscribe(TemperatureDisplayInterface $display): void;
    public function unsubscribe(TemperatureDisplayInterface $display): void;
    public function notify(string $processor): void;
}
