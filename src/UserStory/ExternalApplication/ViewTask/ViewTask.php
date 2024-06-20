<?php

declare(strict_types=1);

namespace Rb\UserStory\ExternalApplication\ViewTask;

use Rb\Generic\Response;
use Rb\Generic\Response\BadRequest;
use Rb\Infrastructure\UserStory;
use Rb\Infrastructure\Validation\Validatable;
use Rb\Models\Task;
use Rb\Generic\Response\Ok;
use Yii;

class ViewTask implements UserStory
{
    public function __construct(
        private Validatable $validatable
    ) {
    }

    public function response(): Response
    {
        $validationResult = $this->validatable->result();

        if (!$validationResult->isSuccessful()) {
            Yii::warning($validationResult->error());
            return new BadRequest(
                $validationResult->error()
            );
        }

        $validationValue = $validationResult->value();

        $taskModel = Task::find()
            ->andWhere(['id' => $validationValue['id']])
            ->asArray()
            ->one();

        return new Ok($taskModel);
    }


}