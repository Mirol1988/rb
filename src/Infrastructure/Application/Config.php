<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Application;

interface Config
{
    public function value(): array;
}