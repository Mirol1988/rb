<?php

declare(strict_types=1);

namespace Rb\Domain\Task;

interface Priority
{
    public function id(): string;
    public function title(): string;
}