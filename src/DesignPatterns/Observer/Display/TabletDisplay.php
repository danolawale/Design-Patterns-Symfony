<?php

declare(strict_types=1);

namespace App\DesignPatterns\Observer\Display;

class TabletDisplay extends AbstractDisplay implements TemperatureDisplayInterface
{
    protected const DISPLAY = 'Tablet';

    public function display(string $outputType): void
    {
        parent::getOutput(self::DISPLAY, $outputType);
    }
}
