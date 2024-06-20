<?php

declare(strict_types=1);

namespace Rb\UserStory\ExternalApplication\ViewPriorityList;

use Rb\Domain\Task\Priority;
use Rb\Domain\Task\Priority\Priorities;
use Rb\Generic\Response;
use Rb\Generic\Response\Ok;
use Rb\Infrastructure\UserStory;

class ViewPriorityList implements UserStory
{
    public function response(): Response
    {
        return
            new Ok(
                array_map(
                    fn(Priority $priority) => [
                        'id' => $priority->id(),
                        'title' => $priority->title(),
                    ],
                    (new Priorities())->all()
                )
            );
    }
}