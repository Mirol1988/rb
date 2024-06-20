<?php

namespace Rb\Infrastructure\Identity\JWT;

use bizley\jwt\JwtHttpBearerAuth;

trait OptionalJWTUsers
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['auth'] = [
            'class' => JwtHttpBearerAuth::class,
            'optional' => ['*'],
        ];

        return $behaviors;
    }
}