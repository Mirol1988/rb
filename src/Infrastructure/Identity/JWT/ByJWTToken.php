<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Identity\JWT;

use Lcobucci\JWT\UnencryptedToken;
use yii\web\IdentityInterface;
use yii\web\UnauthorizedHttpException;

class ByJWTToken implements IdentityInterface
{
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $jwt = \Yii::$app->jwt;

        if (!$jwt->validate($token)) {
            return null;
        }

        /** @var UnencryptedToken $parsedToken */
        $parsedToken = $jwt->parse($token);

        $invalidateTimestamp = \Yii::$app->cache->get('INVALIDATED_JWT_' . $parsedToken->claims()->get('user_id'));

        if ($invalidateTimestamp &&  $invalidateTimestamp > $parsedToken->claims()->get('dttm')->format('U')) {
            throw new UnauthorizedHttpException('Invalidated JWT');
        }

        return
            new JWTUser(
                (int) $parsedToken->claims()->get('user_id'),
            );
    }

    public function getId() {}
    public function getAuthKey() {}
    public function validateAuthKey($authKey) {}
    public static function findIdentity($id) {}
}