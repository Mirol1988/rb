<?php

declare(strict_types=1);

namespace Rb\Domain\Task\Priority;

class Priorities
{
    public function all(): array
    {
        return [
            new PriorityLow(),
            new PriorityMedium(),
            new PriorityHigh(),
        ];
    }
}