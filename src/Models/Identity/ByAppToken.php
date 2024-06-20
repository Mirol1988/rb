<?php

declare(strict_types=1);

namespace Rb\Models\Identity;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class ByAppToken extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'app_token';
    }

    public static function findIdentity($id)
    {
        return null;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['token' => $token]);
    }

    public function getId()
    {
        return null;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return null;
    }
}