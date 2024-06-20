<?php

declare(strict_types=1);

namespace Rb\Domain\Task\Priority;

use Rb\Domain\Task\Priority;

class PriorityLow implements Priority
{

    public function id(): string
    {
        return 'low';
    }

    public function title(): string
    {
        return 'Низкий';
    }
}