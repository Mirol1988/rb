<?php

declare(strict_types=1);

namespace Rb\Domain\Task\Status;

use Rb\Domain\Task\Status;

class TaskFinish implements Status
{
    public function id(): string
    {
        return 'finish';
    }

    public function title(): string
    {
        return 'Завершон';
    }
}