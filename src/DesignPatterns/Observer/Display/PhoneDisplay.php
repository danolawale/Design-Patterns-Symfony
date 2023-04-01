<?php

declare(strict_types=1);

namespace App\DesignPatterns\Observer\Display;

class PhoneDisplay extends AbstractDisplay implements TemperatureDisplayInterface
{
    protected const DISPLAY = 'Phone';

    public function display(string $outputType): void
    {
        parent::getOutput(self::DISPLAY, $outputType);
    }
}
