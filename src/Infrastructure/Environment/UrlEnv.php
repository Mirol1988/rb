<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Environment;

class UrlEnv extends ExistedEnv
{
    public function value(): string
    {
        return rtrim($this->value, '/');
    }
}