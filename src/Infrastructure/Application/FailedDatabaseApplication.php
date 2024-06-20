<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Application;

use Rb\Infrastructure\Application;
use Rb\Infrastructure\Application\Database\FailedConnection;
use yii\base\Application as YiiApplication;
use yii\console\Application as ConsoleApplication;

class FailedDatabaseApplication implements Application
{
	public function application(): YiiApplication
	{
		return
            new ConsoleApplication([
                'id' => 'unti.failed_database_test',
                'basePath'   => dirname(__DIR__),
                'components' => [
                    'db' => [
                        'class' => FailedConnection::class
                    ],
                ],
           ]);
	}
}