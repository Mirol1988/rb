<?php

declare(strict_types=1);

namespace Rb\Infrastructure\Application\Config;

use Rb\Infrastructure\Application\Config;
use Rb\Infrastructure\Logging\Target\StdOut;
use Rb\Infrastructure\Application\Database;
use Rb\Infrastructure\Application\Language;
use Rb\Infrastructure\Application\Routes;
use Rb\Infrastructure\Application\System;
use yii\i18n\PhpMessageSource;
use yii\web\HtmlResponseFormatter;
use yii\web\JsonParser;
use yii\web\Response;
use yii\web\User;

class Html implements Config
{
    private System $system;
    private Database $database;
    private Language $language;
    private Routes $routes;

    public function __construct(System $system, Database $database, Language $language, Routes $routes)
    {
        $this->database = $database;
        $this->language = $language;
        $this->system = $system;
        $this->routes = $routes;
    }

    public function value(): array
    {
        return [
            'id' => 'ru.Rb.site',
            'basePath' => dirname(dirname(dirname(dirname(__DIR__)))),
            'language' => $this->language->value(),
            'controllerNamespace' => $this->system->controllerNamespace(),
            'bootstrap' => ['log'],
            'modules' => [],
            'components' => [
                'request' => [
                    'enableCookieValidation' => true,
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
                    'format' => Response::FORMAT_HTML,
                    'formatters' => [
                        Response::FORMAT_XML => [ // enforce HTML output for browser
                            'class' => HtmlResponseFormatter::class,
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
                    'identityClass' => User::class,
                    'enableSession' => 'true',
                ],
            ],
        ];
    }
}