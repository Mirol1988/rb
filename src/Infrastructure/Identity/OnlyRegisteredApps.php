<?php

namespace Rb\Infrastructure\Identity;

use yii\filters\auth\QueryParamAuth;

trait OnlyRegisteredApps
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::class,
            'tokenParam' => 'app_token',
        ];
        return $behaviors;
    }
}