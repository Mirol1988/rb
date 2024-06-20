<?php

declare(strict_types=1);

namespace Rb\Http;

class HttpCookie
{
    private string $name;
    private string $value;
    private string $expires;
    private string $path;
    private string $domain;
    private bool $secure;
    private bool $httpOnly;

    public function __construct(string $name, string $value = '', string $expires = '', string $path = '', string $domain = '', bool $secure = false, bool $httpOnly = false)
    {
        $this->name = $name;
        $this->value = $value;
        $this->expires = $expires;
        $this->path = $path;
        $this->domain = $domain;
        $this->secure = $secure;
        $this->httpOnly = $httpOnly;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function expires(): string
    {
        return $this->expires;
    }

    public function path(): string
    {
        return $this->path;
    }

    public function domain(): string
    {
        return $this->domain;
    }

    public function secure(): bool
    {
        return $this->secure;
    }

    public function httpOnly(): bool
    {
        return $this->httpOnly;
    }
}