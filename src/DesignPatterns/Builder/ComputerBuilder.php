<?php

declare(strict_types=1);

namespace App\DesignPatterns\Builder;

use InvalidArgumentException;

class ComputerBuilder
{
    private string $purpose;
    private int $ramSize;
    private string $storageType;
    private string $storageSize;
    private string $motherboardType;
    private bool $externalGraphicsCard;

    public function for(string $purpose): self
    {
        $allowedBuilders = ['gaming', 'development', 'general'];
        if (!in_array($purpose, $allowedBuilders)) {
            throw new InvalidArgumentException(
                sprintf("'%s' is not one of the allowed builder types.", implode(', ', $allowedBuilders))
            );
        }

        $this->purpose = $purpose;
        return $this;
    }

    public function withRamSize(int $size): self
    {
        $minRamSize = match ($this->purpose) {
            'gaming' => 32,
            'development' => 16,
            'general' => 4
        };
        if ($size < $minRamSize) {
            throw new InvalidArgumentException(
                sprintf("RAM size of '%u' GB is too small for a '%s' computer.", $size, $this->purpose)
            );
        }

        $this->ramSize = $size;
        return $this;
    }

    public function withStorage(string $type, string $size): self
    {
        $this->storageSize = $size;
        if (!in_array($type, ['HDD', 'SSD'])) {
            throw new InvalidArgumentException("Storage Type can only be one of 'HDD' or 'SSD'");
        }

        $this->storageType = $type;
        return $this;
    }

    public function withMotherboard(string $type): self
    {
        $motherboard = match ($type) {
            'standard' => 'ATX',
            'micro' => 'Micro-ATX',
            'mini' => 'Mini-ITX',
            default => throw new InvalidArgumentException(
                sprintf("There is no available motherboard for type '%s'.", $type)
            )
        };
        $this->motherboardType = $motherboard;
        return $this;
    }

    public function addGraphicsCard(string $addGraphicsCard): self
    {
        $externalGraphicsCard = match ($addGraphicsCard) {
            'yes' => true,
            default => false
        };
        if ($this->purpose === 'gaming' && $externalGraphicsCard === false) {
            throw new InvalidArgumentException(
                "Gaming computers must have a separate graphics card and cannot use the onboard graphics card"
            );
        }

        $this->externalGraphicsCard = $externalGraphicsCard;
        return $this;
    }

    public function build(): Computer
    {
        return new Computer(
            purpose: $this->purpose,
            motherboard: $this->motherboardType,
            ram: $this->ramSize,
            storageSize: $this->storageSize,
            storageType: $this->storageType,
            externalGraphicsCard: $this->externalGraphicsCard
        );
    }
}
