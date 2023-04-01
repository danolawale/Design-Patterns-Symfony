<?php

declare(strict_types=1);

namespace App\DesignPatterns\Builder;

class ComputerFactory
{
    public function __construct(private readonly ComputerBuilder $builder)
    {
    }

    public function build(array $userRequest): Computer
    {
        return $this->builder
            ->for($userRequest['purpose'])
            ->withRamSize((int)$userRequest['ramSize'])
            ->withStorage($userRequest['storageType'], $userRequest['storageSize'])
            ->withMotherboard($userRequest['motherboard'])
            ->addGraphicsCard($userRequest['externalGraphics'])
            ->build();
    }
}
