<?php
declare(strict_types=1);

namespace App\Observer\Display;

class PhoneDisplay extends AbstractDisplay implements TemperatureDisplayInterface
{
    public const Display = 'Phone';

    public function display(string $outputType): void
    {
        parent::getOutput($outputType);
    }
}