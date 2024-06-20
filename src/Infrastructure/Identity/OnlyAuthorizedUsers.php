<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Identity;

use yii\filters\auth\QueryParamAuth;

trait OnlyAuthorizedUsers
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::class,
            'tokenParam' => 'access_token',
        ];
        return $behaviors;
    }
}