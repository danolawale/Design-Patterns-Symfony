<?php
declare(strict_types=1);

namespace App\Observer\Display;

class MonitorDisplay extends AbstractDisplay implements TemperatureDisplayInterface
{
    public const Display = 'Monitor';

    public function display(string $outputType): void
    {
        parent::getOutput($outputType);
    }
}