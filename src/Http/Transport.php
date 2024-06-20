<?php

declare(strict_types=1);

namespace Rb\Http;

use Rb\Generic\Result;

interface Transport
{
    public function response(Request $request): Result;
}