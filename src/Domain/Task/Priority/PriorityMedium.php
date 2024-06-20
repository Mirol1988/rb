<?php

declare(strict_types=1);

namespace Rb\Domain\Task\Priority;

use Rb\Domain\Task\Priority;

class PriorityMedium implements Priority
{

    public function id(): string
    {
        return 'medium';
    }

    public function title(): string
    {
        return 'Средний';
    }
}