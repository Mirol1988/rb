<?php

declare(strict_types=1);

namespace Rb\Tests\Infrastructure\Transport;

use Rb\Generic\Result;
use Rb\Http\Transport;
use Rb\Http\Request;

class FakeTransport implements Transport
{
    private Result $result;

    public function __construct(Result $result)
    {
        $this->result = $result;
    }

    public function response(Request $request): Result
    {
        return $this->result;
    }
}