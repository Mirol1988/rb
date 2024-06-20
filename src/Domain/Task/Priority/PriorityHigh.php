<?php

declare(strict_types=1);

namespace Rb\Domain\Task\Priority;

use Rb\Domain\Task\Priority;

class PriorityHigh implements Priority
{

    public function id(): string
    {
        return 'high';
    }

    public function title(): string
    {
        return 'Высокий';
    }
}