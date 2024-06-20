<?php

declare(strict_types=1);

namespace Rb\Http\Option;

use GuzzleHttp\RequestOptions;
use Rb\Http\Option;

final class Auth implements Option
{
    private string $username;
    private string $password;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function value(): array
    {
        return [RequestOptions::AUTH => [$this->username, $this->password]];

    }
}