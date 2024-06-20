<?php

declare(strict_types=1);

namespace Rb\Http;

interface ExtendedRequest extends Request
{
    public function options(): array;
}