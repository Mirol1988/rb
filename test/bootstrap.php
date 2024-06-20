<?php

declare(strict_types=1);

use Dotenv\Dotenv;

require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

if (file_exists(dirname(__DIR__) . DIRECTORY_SEPARATOR . '.env.test')) {
    (Dotenv::createMutable(dirname(__DIR__), '.env.test'))->load();
}