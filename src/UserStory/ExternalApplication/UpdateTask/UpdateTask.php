<?php

declare(strict_types=1);

namespace Rb\UserStory\ExternalApplication\UpdateTask;

use Ramsey\Uuid\Uuid;
use Rb\Domain\Task\Save\Persistent;
use Rb\Domain\Task\Save\SaveTask;
use Rb\Domain\Task\Save\WithCash;
use Rb\Domain\Task\Status\TaskNew;
use Rb\Generic\Response;
use Rb\Generic\Response\BadRequest;
use Rb\Generic\Response\Ok;
use Rb\Infrastructure\UserStory;
use Rb\Infrastructure\Validation\Validatable;
use Rb\Models\Task;
use Yii;

class UpdateTask implements UserStory
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

        $createTaskResult =
            (new WithCash(
                new SaveTask(
                    new Persistent(
                        Task::findOne(['id' => $validationValue['id']]),
                        $validationValue
                    )
                )
            ))
                ->result();

        if(!$createTaskResult->isSuccessful()) {
            Yii::warning($createTaskResult->error());
            return new BadRequest(
                $createTaskResult->error()
            );
        }

        return new Ok();
    }
}