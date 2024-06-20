<?php

declare(strict_types=1);

namespace Rb\Http\Option;

use GuzzleHttp\RequestOptions;
use Rb\Http\Option;

class StringBody implements Option
{
    private string $body;

    public function __construct(string $body)
    {
        $this->body = $body;
    }

    public function value(): array
    {
        return [RequestOptions::BODY => $this->body];
    }
}