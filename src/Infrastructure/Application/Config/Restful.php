<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Application\Config;

use Rb\Infrastructure\Http\Event\BeforeSend;
use Rb\Infrastructure\Application\Config;
use Rb\Infrastructure\Identity\Config\JWTConfig;
use Rb\Infrastructure\Logging\Target\StdOut;
use Rb\Infrastructure\Application\Database;
use Rb\Infrastructure\Application\Language;
use Rb\Infrastructure\Application\Routes;
use Rb\Infrastructure\Application\System;
use Rb\Infrastructure\Environment\Env;
use yii\i18n\PhpMessageSource;
use yii\queue\amqp_interop\Queue;
use yii\redis\Cache;
use yii\redis\Connection;
use yii\web\IdentityInterface;
use yii\web\JsonParser;
use yii\web\JsonResponseFormatter;
use yii\web\Response;

class Restful implements Config
{
    private System $system;
    private Database $database;
    private Language $language;
    private Routes $routes;
    private IdentityInterface $identityClass;

    public function __construct(System $system, Database $database, Language $language, Routes $routes, IdentityInterface $identityClass)
    {
        $this->database = $database;
        $this->language = $language;
        $this->system = $system;
        $this->routes = $routes;
        $this->identityClass = $identityClass;
    }

    public function value(): array
    {
        return [
            'id' => 'ru.devices',
            'basePath' => dirname(dirname(dirname(dirname(__DIR__)))),
            'language' => $this->language->value(),
            'controllerNamespace' => $this->system->controllerNamespace(),
            'bootstrap' => ['log'],
            'modules' => [],
            'components' => [
                'request' => [
                    'enableCsrfValidation' => false,
                    'enableCsrfCookie' => false,
                    'enableCookieValidation' => false,
                    'parsers' => [
                        'application/json' => JsonParser::class,
                    ],
                ],
                'log' => [
                    'traceLevel' => 0,
                    'targets' => [
                        [
                            'class' => StdOut::class,
                            'levels' => ['trace'],
                            'logVars' => [],
                            'categories' => ['application'],
                        ],
                    ],
                ],
                'urlManager' => [
                    'enablePrettyUrl' => true,
                    'enableStrictParsing' => true,
                    'showScriptName' => false,
                    'rules' => $this->routes->value(),
                ],
                'response' => [
                    'class' => Response::class,
                    'on beforeSend' => new BeforeSend(),
                    'format' => Response::FORMAT_JSON,
                    'formatters' => [
                        Response::FORMAT_XML => [ // enforce JSON output for browser
                            'class' => JsonResponseFormatter::class,
                            'prettyPrint' => YII_DEBUG,
                            'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                        ],
                    ],
                ],
                'db' => $this->database->value(),
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
                'user' => [
                    'identityClass' => $this->identityClass,
                    'enableSession' => 'false',
                ],
                'cache' => [
                    'class' => Cache::class,
                    'keyPrefix' => 'Rb',
                ],
                'redis' => [
                    'class' => Connection::class,
                    'hostname' => (new Env('REDIS_HOST'))->value(),
                    'port' => (new Env('REDIS_PORT'))->value(),
                    'database' => (new Env('REDIS_INDEX'))->value(),
                    'password' => (new Env('REDIS_PASSWORD'))->value(),
                    'username' => (new Env('REDIS_USER'))->value(),
                ],
                'jwt' => (new JWTConfig())->value(),
            ],
        ];
    }
}