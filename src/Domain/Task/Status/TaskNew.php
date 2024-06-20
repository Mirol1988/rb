<?php

declare(strict_types=1);

namespace Rb\Domain\Task\Status;

use Rb\Domain\Task\Status;

class TaskNew implements Status
{
    public function id(): string
    {
        return 'new';
    }

    public function title(): string
    {
        return 'Новый';
    }

}