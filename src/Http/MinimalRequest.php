<?php

declare(strict_types=1);

namespace Rb\Http;

interface MinimalRequest
{
    public function headers(): array;
    public function body(): string;
}