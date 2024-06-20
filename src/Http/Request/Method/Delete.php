<?php

declare(strict_types=1);

namespace Rb\Http\Request\Method;

use Rb\Http\Request\Method;

class Delete implements Method
{
    public function value(): string
    {
        return 'DELETE';
    }
}