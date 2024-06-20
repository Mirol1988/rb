<?php

declare(strict_types=1);

namespace Rb\Domain\Task\Status;

use Rb\Domain\Task\Status;

class TaskReturn implements Status
{
    public function id(): string
    {
        return 'return';
    }

    public function title(): string
    {
        return 'Возвращен';
    }

}