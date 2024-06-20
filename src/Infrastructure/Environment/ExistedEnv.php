<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Environment;

use Exception;

abstract class ExistedEnv
{
    protected string $value;

    public function __construct(string $name)
    {
        $result = getenv($name);

        if ($result === false) {
            throw new Exception("Environment variable '{$name}' is not defined");
        }

        if (!is_string($result)) {
            throw new Exception("Environment variable '{$name}' has bad definition");
        }

        $this->value = $result;
    }

    abstract public function value();
}