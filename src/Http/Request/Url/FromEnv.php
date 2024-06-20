<?php

declare(strict_types=1);

namespace Rb\Http\Request\Url;

use Exception;
use Rb\Http\Request\Url;

class FromEnv implements Url
{
    private Url $url;

    public function __construct(string $envName)
    {
        $result = getenv($envName);

        if ($result === false) {
            throw new Exception("Environment variable '{$envName}' is not defined");
        }

        if (!is_string($result)) {
            throw new Exception("Environment variable '{$envName}' has bad definition");
        }

        $this->url = new FromString($result);
    }

    public function value(): string
    {
        return $this->url->value();
    }
}