<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Environment;

class Env extends ExistedEnv
{
    public function value(): string
    {
        return $this->value;
    }
}