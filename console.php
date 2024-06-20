<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use Rb\Http\Transport\DefaultHttpTransport;
use Rb\Http\Transport\JsonDecoded;
use Rb\Infrastructure\Transport\CachedTransport;
use Rb\Infrastructure\Application\Config\Console as ConsoleConfig;
use Rb\Infrastructure\Environment\EnvironmentDependentEnvFile;
use Rb\Infrastructure\Application\Database\MariaDb;
use Rb\Infrastructure\Application\Console;
use Rb\Infrastructure\Error\ErrorHandler;

require_once __DIR__ . '/vendor/autoload.php';

(new EnvironmentDependentEnvFile(__DIR__, getallheaders()))->load();

define('YII_DEBUG', getenv('YII_DEBUG') === 'true');
define('YII_ENABLE_ERROR_HANDLER', false); // need to use our `set_error_handler`, `set_exception_handler`

(new ErrorHandler())->set();

require_once __DIR__ . '/vendor/yiisoft/yii2/Yii.php';

$application =
    (new Console(
        new ConsoleConfig(
            new MariaDb(),
        )
    ))
        ->application();

Yii::$container->setSingleton(
    'transport',
    new JsonDecoded(new DefaultHttpTransport(new Client()))
);

Yii::$container->setSingleton(
    'cachedTransport',
    new CachedTransport(
        new JsonDecoded(new DefaultHttpTransport(new Client())),
        Yii::$app->cache,
        60
    )
);

$exitCode = $application->run();

exit($exitCode);