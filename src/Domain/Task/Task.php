<?php

declare(strict_types=1);

namespace Rb\Domain\Task;

use Rb\Generic\Result;

interface Task
{
    public function result(): Result;
}