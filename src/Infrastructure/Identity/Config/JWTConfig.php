<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Identity\Config;

use bizley\jwt\Jwt;
use Lcobucci\Clock\SystemClock;
use Lcobucci\JWT\Validation\Constraint\LooseValidAt;
use Lcobucci\JWT\Validation\Constraint\SignedWith;
use Rb\Infrastructure\Application\Config;
use Rb\Infrastructure\Environment\Env;

class JWTConfig implements Config
{
    public function value(): array
    {
        return [
            'class' => Jwt::class,
            'signer' => Jwt::HS256,
            'signingKey' => [
                'key' => (new Env('JWT_SECRET'))->value(),
                'method' => Jwt::METHOD_PLAIN,
            ],
            'verifyingKey' => [
                'key' => (new Env('JWT_SECRET'))->value(),
                'method' => Jwt::METHOD_PLAIN,
            ],
            'validationConstraints' => function (Jwt $jwt) {
                $config = $jwt->getConfiguration();
                return [
                    new SignedWith($config->signer(), $config->verificationKey()),
                    new LooseValidAt(new SystemClock(new \DateTimeZone('UTC')))
                ];
            },
        ];
    }
}