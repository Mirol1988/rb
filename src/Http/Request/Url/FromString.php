<?php

declare(strict_types=1);

namespace Rb\Http\Request\Url;

use Exception;
use Rb\Http\Request\Url;

class FromString implements Url
{
    private string $url;

    public function __construct(string $uri)
    {
        if (!preg_match('@^(https?|ftp)://[^\s/$.?#].[^\s]*$@iS', $uri)) {
            throw new Exception('Url is invalid');
        }

        $this->url = $uri;
    }

    public function value(): string
    {
        return $this->url;
    }
}