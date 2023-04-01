<?php

declare(strict_types=1);

namespace App\DesignPatterns\Observer\WeatherStation;

class TemperatureReadingsProcessor
{
    public const AVERAGE = 'average';
    public const MAX = 'max';
    public const MIN = 'min';

    /**
     * @var float[] $readings
     */
    private array $readings = [];

    public function setTemperatureReadings(array $readings): void
    {
        $this->readings = $readings;
    }

    public function getProcessedReading(string $processorType): float
    {
        $this->validateReadings();

        $this->validateProcessorType($processorType);

        return match ($processorType) {
            self::AVERAGE => $this->getAverageReading(),
            self::MAX => $this->getMaximumReading(),
            self::MIN => $this->getMinimumReading()
        };
    }

    private function getAverageReading(): float
    {
        return array_sum($this->readings) / count($this->readings);
    }

    private function getMaximumReading(): float
    {
        return max(...$this->readings);
    }

    private function getMinimumReading(): float
    {
        return min(...$this->readings);
    }

    private function validateReadings(): void
    {
        if (empty($this->readings)) {
            throw new \Exception(
                "You must specify at least one temperature reading or a comma separated set of readings"
            );
        }
    }

    private function validateProcessorType(string $processorType): void
    {
        if (!in_array($processorType, [self::AVERAGE, self::MAX, self::MIN])) {
            throw new \Exception(sprintf("Invalid Output Type '%s'", $processorType));
        }
    }
}
