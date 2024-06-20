<?php

declare(strict_types=1);

namespace Rb\Http\Option;

use GuzzleHttp\RequestOptions;
use Rb\Http\Option;

class Multipart implements Option
{
    private array $params;

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function value(): array
    {
        return [RequestOptions::MULTIPART => $this->params];
    }
}