<?php

declare(strict_types=1);

namespace App\DesignPatterns\Observer\Display;

class MonitorDisplay extends AbstractDisplay implements TemperatureDisplayInterface
{
    protected const DISPLAY = 'Monitor';

    public function display(string $outputType): void
    {
        parent::getOutput(self::DISPLAY, $outputType);
    }
}
