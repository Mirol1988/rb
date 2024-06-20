<?php

declare(strict_types=1);

namespace Rb\Http;

use Rb\Http\Request\Method;
use Rb\Http\Request\Url;

interface Request extends MinimalRequest
{
    public function method(): Method;
    public function url(): Url;
}