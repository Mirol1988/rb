<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Console\Message;

use Rb\Infrastructure\Console\Message;
use yii\helpers\Console;

class SuccessfulMessage implements Message
{
    private array $messages;

    public function __construct(array $messages)
    {
        $this->messages = $messages;
    }

    public function value(): string
    {
        return
            Console::ansiFormat(
                implode(PHP_EOL, $this->messages) . PHP_EOL,
                [Console::FG_GREEN, Console::BOLD]
            );
    }
}