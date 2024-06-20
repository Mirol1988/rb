<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Validation\Verifica;

class ExistsValidator
{
    private string $class;

    public function __construct(string $class)
    {
        $this->class = $class;
    }

    public function __invoke($field, $value, array $params, array $fields): bool
    {
        return !is_null(($this->class)::findOne($value));
    }
}