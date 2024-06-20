<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Console;

interface Message
{
    public function value(): string;
}