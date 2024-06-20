<?php

declare(strict_types=1);

namespace Rb\Http\Option;

use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\SetCookie;
use GuzzleHttp\RequestOptions;
use Rb\Http\HttpCookie;
use Rb\Http\Option;

class Cookies implements Option
{
    private array $params;

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function value(): array
    {
        return [RequestOptions::COOKIES => $this->cookieJar()];
    }

    private function cookieJar(): CookieJar
    {
        $cookieJar = new CookieJar();
        $cookies = $this->params;
        array_walk(
            $cookies,
            function (HttpCookie $cookie) use ($cookieJar) {
                $cookieJar->setCookie(
                    new SetCookie([
                        'Name' => $cookie->name(),
                        'Value' => $cookie->value(),
                        'Domain' => $cookie->domain(),
                        'Path' => $cookie->path(),
                        'Expires' => $cookie->expires(),
                        'Secure' => $cookie->secure(),
                        'HttpOnly' => $cookie->httpOnly(),
                    ])
                );
            }
        );

        return $cookieJar;
    }
}