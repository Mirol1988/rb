<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Application;

use Rb\Infrastructure\Application;
use yii\base\Application as BaseApplication;
use yii\console\Application as ConsoleApplication;

class Console implements Application
{
	private Config $config;

	public function __construct(Config $config)
	{
		$this->config = $config;
	}

	public function application(): BaseApplication
	{
        return
            new ConsoleApplication(
                $this->config->value()
            );
	}
}