<?php
declare(strict_types=1);

namespace App\Observer\WeatherStation;

class TemperatureReadingsProcessor
{
    public const Average = 'average';
    public const Max = 'max';
    public const Min = 'min';

    public string $processorType;

    public function __construct(private ?array $readings = null)
    {
    }

    public function setTemperatureReadings(array $readings): void
    {
        $this->readings ??= $readings;

        if(empty($this->readings)) {
            throw new \Exception(
                "You must specify at least one temperature reading or a comma separated set of readings"
            );
        }
    }

    public function setProcessorType(string $processorType): void
    {
        if(!in_array($processorType, [self::Average, self::Max, self::Min]))
        {
            throw new \Exception(sprintf("Invalid Output Type '%s'", $processorType));
        }

        $this->processorType = $processorType;
    }

    public function getProcessedReading(string $processorType): float
    {
        return match($processorType) {
            self::Average => $this->getAverageReading(),
            self::Max => $this->getMaximumReading(),
            self::Min => $this->getMinimumReading()
        };
    }

    private function getAverageReading(): float
    {
        return array_sum($this->readings) / count($this->readings);
    }

    private function getMaximumReading(): float
    {
        return max($this->readings);
    }

    private function getMinimumReading(): float
    {
        return min($this->readings);
    }
}