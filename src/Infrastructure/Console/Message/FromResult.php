<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Console\Message;

use Rb\Generic\Result;
use Rb\Infrastructure\Console\Message;

class FromResult implements Message
{
    private Message $message;

    public function __construct(Result $result)
    {
        if ($result->isSuccessful()) {
            $this->message = new SuccessfulMessage($result->value());
        } else {
            $this->message = new ErrorMessage($result->error());
        }
    }

    public function value(): string
    {
        return $this->message->value();
    }
}