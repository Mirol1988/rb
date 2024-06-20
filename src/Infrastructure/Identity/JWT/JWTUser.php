<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Identity\JWT;

use yii\web\IdentityInterface;

class JWTUser implements IdentityInterface
{
    public function __construct(private int $userId)
    {}

    public function getId()
    {
        return $this->userId;
    }

    public static function findIdentity($id) {}
    public static function findIdentityByAccessToken($token, $type = null) {}
    public function getAuthKey() {}
    public function validateAuthKey($authKey) {}
}