<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Validation\Verifica;

class StringValidator
{
    public function __invoke($field, $value, array $params, array $fields): bool
    {
        return is_string($value);
    }
}