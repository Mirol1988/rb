<?php

declare(strict_types=1);

namespace Rb\Tests\Infrastructure\Application\Config;

use Rb\Infrastructure\Application\Config;
use Rb\Infrastructure\Application\Database;
use Rb\Infrastructure\Application\Language;
use Rb\Infrastructure\Environment\Env;
use Rb\Models\Identity\ByAppToken;
use yii\caching\DummyCache;
use yii\redis\Connection;

class TestConfig implements Config
{
    private Database $database;
    private Language $language;

    public function __construct(Database $database, Language $language)
    {
        $this->database = $database;
        $this->language = $language;
    }

    public function value(): array
    {
        return [
            'id' => 'ru.Rb.test',
            'basePath' => dirname(dirname(dirname(dirname(__DIR__)))),
            'language' => $this->language->value(),
            'components' => [
                'db' => $this->database->value(),
                'request' => [
                    'enableCookieValidation' => false,
                ],
                'user' => [
                    'identityClass' => new ByAppToken(),
                    'enableSession' => 'false',
                ],
                'cache' => [
                    'class' => DummyCache::class,
                ],
            ],
        ];
    }
}