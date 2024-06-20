<?php

declare(strict_types=1);

namespace Rb\Models\Identity;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * @property string $id
 */
class ByAccessToken extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'user';
    }

    public static function findIdentity($id)
    {
        return null;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
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