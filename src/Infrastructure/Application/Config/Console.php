<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Application\Config;

use Rb\Controller\Console\AppTokenController;
use Rb\Controller\Console\FeedMatchController;
use Rb\Controller\Console\HistoryController;
use Rb\Controller\Console\ProfitController;
use Rb\Controller\Console\RecreateController;
use Rb\Controller\Console\TestController;
use Rb\Controller\Console\TreeController;
use Rb\Controller\Console\WebSocket;
use Rb\Infrastructure\Application\Config;
use Rb\Infrastructure\Application\Database;
use Rb\Infrastructure\Environment\Env;
use Rb\Infrastructure\Logging\Target\StdOut;
use yii\console\controllers\MigrateController;
use yii\i18n\PhpMessageSource;
use yii\queue\amqp_interop\Queue;
use yii\redis\Cache;
use yii\redis\Connection;

class Console implements Config
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function value(): array
    {
        return [
            'id' => 'kz.ubet.nl.console',
            'basePath' => dirname(dirname(dirname(dirname(__DIR__)))),
            'language' => 'en',
            'bootstrap' => [
                'log',
            ],
            'controllerMap' => [
                'migrate' => [
                    'class' => MigrateController::class,
                    'migrationPath' => [
                        __DIR__ . '/../../../../migrations',
                    ],
                    'migrationTable' => '_migration',
                ],
                'appToken' => [
                    'class' => AppTokenController::class,
                ]
            ],
            'components' => [
                'db' => $this->database->value(),
                'log' => [
                    'traceLevel' => YII_DEBUG ? 3 : 0,
                    'targets' => [
                        [
                            'class' => StdOut::class,
                            'levels' => ['trace'],
                            'logVars' => [],
                            'categories' => ['application'],
                        ],
                    ],
                ],
                'i18n' => [
                    'translations' => [
                        '*' => [
                            'class' => PhpMessageSource::class,
                            'sourceLanguage' => 'en',
                            'fileMap' => [
                                'Rb' => 'Rb.php',
                            ],
                        ],
                    ],
                ],
                'cache' => [
                    'class' => Cache::class,
                    'keyPrefix' => 'RB',
                ],
                'redis' => [
                    'class' => Connection::class,
                    'hostname' => (new Env('REDIS_HOST'))->value(),
                    'port' => (new Env('REDIS_PORT'))->value(),
                    'database' => (new Env('REDIS_INDEX'))->value(),
                    'password' => (new Env('REDIS_PASSWORD'))->value(),
                    'username' => (new Env('REDIS_USER'))->value(),
                ],
            ],
        ];
    }
}