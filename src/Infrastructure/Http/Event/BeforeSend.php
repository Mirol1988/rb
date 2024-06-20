<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Http\Event;

use Rb\Infrastructure\Http\DefaultResponseFormat;
use Rb\Infrastructure\UserStory;
use yii\db\Exception;
use Yii;

class BeforeSend
{
    public function __invoke($event)
    {
        /** @var UserStory $userStory */
        $userStory = $event->sender->data;

        if (Yii::$app->controller->id !== 'swagger') {
            if (!$userStory instanceof UserStory) {
                throw new Exception(
                    sprintf(
                        'Response of `%sController` must implements `UserStory` interface',
                        ucfirst(Yii::$app->controller->id)
                    )
                );
            }

            if (Yii::$app->request->method === 'OPTIONS') {
                Yii::$app->end();
            }

            $response = $userStory->response();

            $event->sender->data = (new DefaultResponseFormat($response))->value();
            $event->sender->statusCode = $response->code();
        }
    }
}