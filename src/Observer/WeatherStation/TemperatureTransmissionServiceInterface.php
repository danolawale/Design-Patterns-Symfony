<?php

namespace App\Observer\WeatherStation;

use App\Observer\Display\TemperatureDisplayInterface;

interface TemperatureTransmissionServiceInterface
{
    public function subscribe(TemperatureDisplayInterface $display): void;
    public function unsubscribe(TemperatureDisplayInterface $display): void;
    public function notify(): void;
}