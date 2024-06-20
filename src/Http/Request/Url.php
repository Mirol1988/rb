<?php

declare(strict_types=1);

namespace Rb\Http\Request;

interface Url
{
    public function value(): string;
}