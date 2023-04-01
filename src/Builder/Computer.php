<?php

declare(strict_types=1);

namespace App\Builder;

class Computer
{
    public function __construct(
        private readonly string $purpose,
        private readonly string $motherboard,
        private readonly int $ram,
        private readonly string $storageSize,
        private readonly string $storageType,
        private readonly bool $externalGraphicsCard
    ) {
    }

    public function getCompletionNotes(): string
    {
        $notes = sprintf(
            "%s computer build completed.\n
            %s Motherboard, %s ram, %s %s storage",
            ucfirst($this->purpose),
            $this->motherboard,
            $this->ram,
            $this->storageSize,
            $this->storageType
        );

        if ($this->externalGraphicsCard) {
            $notes .= " with external graphics card.";
        }

        return $notes;
    }
}
