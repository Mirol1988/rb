<?php

declare(strict_types=1);

namespace Rb\Http\Request\Extended;

use Rb\Http\ExtendedRequest;
use Rb\Http\Option;
use Rb\Http\Request\Method;
use Rb\Http\Request\Url;

class OptionedRequest implements ExtendedRequest
{
    private Method $method;
    private Url $url;
    private array $options;

    public function __construct(Method $method, Url $url, Option ...$options)
    {
        $this->method = $method;
        $this->url = $url;
        $this->options = $options;
    }

    /** @return Option[] */
    public function options(): array
    {
        return $this->options;
    }

    public function headers(): array
    {
        return [];
    }

    public function body(): string
    {
        return '';
    }

    public function method(): Method
    {
        return $this->method;
    }

    public function url(): Url
    {
        return $this->url;
    }
}
