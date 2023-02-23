<?php

namespace App\Observer\Display;

interface TemperatureDisplayInterface
{
    public function display(string $outputType): void;
}