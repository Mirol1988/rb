<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Logging;

use Throwable;

interface ThrowableLogging
{
    public function run(Throwable $throwable): void;
}