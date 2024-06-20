<?php

declare(strict_types=1);

namespace Rb\Domain\Task\Status;

use Rb\Domain\Task\Status;

class TaskInProgress implements Status
{
    public function id(): string
    {
        return 'in_progress';
    }

    public function title(): string
    {
        return 'В процесе';
    }

}