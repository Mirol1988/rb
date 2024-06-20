<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Logging\Target;

use yii\log\Target;

class StdOut extends Target
{
    private $handler;

    public function init()
    {
        $this->handler = fopen('php://stdout', 'w');
        parent::init();
    }

    public function export()
    {
        foreach ($this->messages as $message) {
            fwrite($this->handler, $this->formatMessage($message) . PHP_EOL);
        }

    }
}