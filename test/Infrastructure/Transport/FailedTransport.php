<?php

declare(strict_types=1);

namespace Rb\Tests\Infrastructure\Transport;

use Rb\Generic\Result;
use Rb\Generic\Result\Failed;
use Rb\Http\Request;
use Rb\Http\Transport;

class FailedTransport implements Transport
{
    public function response(Request $request): Result
    {
        return new Failed(['fail transport']);
    }
}