<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Console;

use Rb\Generic\Result;

interface Command
{
    public function run(): Result;
}