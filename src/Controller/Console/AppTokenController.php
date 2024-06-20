<?php

declare(strict_types=1);

namespace Rb\Controller\Console;

use Rb\Infrastructure\Console\Message\FromResult;
use Rb\UserStory\Console\AppToken\CreateAppToken;
use yii\console\Controller;
use yii\console\ExitCode;

class AppTokenController extends Controller
{
    /**
     * Добавление токена(app_token) для внешних приложений. Аргумент: string applicationName, string token(20+ chars)
     */
    public function actionCreate(string $application, string $token)
    {
        $result = (new CreateAppToken($application, $token))->run();

        echo (new FromResult($result))->value();

        if (!$result->isSuccessful()) {
            return ExitCode::DATAERR;
        }

        return ExitCode::OK;
    }
}