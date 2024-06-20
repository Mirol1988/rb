<?php

declare(strict_types=1);

namespace Rb\Domain\Task\Status;

use Rb\Domain\Task\Status;

class TaskCancel implements Status
{
    public function id(): string
    {
        return 'cancel';
    }

    public function title(): string
    {
        return 'Откланён';
    }
}