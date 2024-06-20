<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Validation\Verifica;

class UuidValidator
{
    public function __invoke($field, $value, array $params, array $fields): bool
    {
        if (is_null($value)) {
            return false;
        }

        return
            (bool)preg_match(
                "/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i",
                $value
            );
    }
}