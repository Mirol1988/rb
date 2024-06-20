<?php

declare(strict_types=1);

namespace Rb\Domain\Task;

interface Status
{
    public function id(): string;
    public function title(): string;
}