<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Environment;

class BoolEnv extends ExistedEnv
{
    public function value(): bool
    {
        return in_array(mb_strtolower($this->value), ['1', 'true', 'yes', 'on']);
    }
}