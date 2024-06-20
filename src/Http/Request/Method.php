<?php

declare(strict_types=1);

namespace Rb\Http\Request;

interface Method
{
    public function value(): string;
}