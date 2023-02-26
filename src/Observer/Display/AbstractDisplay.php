<?php

declare(strict_types=1);

namespace App\Observer\Display;

use App\Observer\WeatherStation\TemperatureTransmissionService;

abstract class AbstractDisplay
{
    public function __construct(protected TemperatureTransmissionService $transmitter)
    {
    }

    protected function getOutput(string $display, string $outputType): void
    {
        $output = ucfirst($outputType);
        echo sprintf(
            "%s: {$output} temperature is %f\n",
            $display,
            $this->transmitter->getTemperatureReading($outputType)
        );
    }
}
