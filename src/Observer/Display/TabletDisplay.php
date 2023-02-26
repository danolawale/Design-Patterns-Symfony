<?php

declare(strict_types=1);

namespace App\Observer\Display;

class TabletDisplay extends AbstractDisplay implements TemperatureDisplayInterface
{
    public const DISPLAY = 'Tablet';
    public function display(string $outputType): void
    {
        parent::getOutput($outputType);
    }
}
