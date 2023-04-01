<?php

declare(strict_types=1);

namespace App\DesignPatterns\PublishSubscriber\WeatherStation;

use App\DesignPatterns\PublishSubscriber\WeatherReadingsProcessor\Factory\WeatherReadingsProcessorFactory;

final class WeatherPublishingService implements WeatherPublishingServiceInterface
{
    private array $readings;
    public function __construct(private readonly WeatherReadingsProcessorFactory $processorFactory)
    {
    }

    public function publish(array $readings): void
    {
        $this->readings = $readings;
        $processors = array_keys($this->readings);
        foreach ($processors as $processor) {
            $this->processReading($processor);
        }
    }

    private function processReading(string $processor): void
    {
        $this->processorFactory->getProcessor($processor)->process($this->readings[$processor]);
    }
}
