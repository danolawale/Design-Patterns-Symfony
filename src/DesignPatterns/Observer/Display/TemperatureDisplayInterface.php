<?php

namespace App\DesignPatterns\Observer\Display;

interface TemperatureDisplayInterface
{
    public function display(string $outputType): void;
}
