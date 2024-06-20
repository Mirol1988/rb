<?php

declare(strict_types=1);

namespace Rb\UserStory\ExternalApplication\ViewStatusList;

use Rb\Domain\Task\Status;
use Rb\Domain\Task\Status\Statuses;
use Rb\Generic\Response;
use Rb\Generic\Response\Ok;
use Rb\Infrastructure\UserStory;

class ViewStatusList implements UserStory
{
    public function response(): Response
    {
        return
            new Ok(
                array_map(
                    fn(Status $status) => [
                        'id' => $status->id(),
                        'title' => $status->title(),
                    ],
                    (new Statuses())->all()
                )
            );
    }

}