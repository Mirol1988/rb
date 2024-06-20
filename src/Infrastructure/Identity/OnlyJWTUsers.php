<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Identity;

use bizley\jwt\JwtHttpBearerAuth;

trait OnlyJWTUsers
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['auth'] = [
            'class' => JwtHttpBearerAuth::class,
        ];
        return $behaviors;
    }
}