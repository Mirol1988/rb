<?php

declare(strict_types=1);

namespace Rb\Domain\Task\Status;

class Statuses
{
    public function all(): array
    {
        return [
            new TaskNew(),
            new TaskInProgress(),
            new TaskReturn(),
            new TaskFinish(),
            new TaskCancel(),
        ];
    }
}