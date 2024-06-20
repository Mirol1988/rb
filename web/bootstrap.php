<?php

declare(strict_types=1);

use Rb\Infrastructure\Application\TypeHinting;
use Rb\Infrastructure\Environment\EnvironmentDependentEnvFile;
use Rb\Infrastructure\Error\ErrorHandler;
use Rb\Infrastructure\Error\JsonExceptionHandler;
use yii\BaseYii;

header ("Access-Control-Allow-Origin: *");
header ("Access-Control-Expose-Headers: Content-Length, X-JSON");
header ("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header ("Access-Control-Allow-Headers: *, Authorization");
header ("Access-Control-Allow-Credentials: true");

if (($_SERVER['REQUEST_METHOD'] ?? '') == 'OPTIONS') { exit(0); }

require_once __DIR__ . '/../vendor/autoload.php';

(new EnvironmentDependentEnvFile(dirname(__DIR__), getallheaders()))->load();

define('YII_DEBUG', getenv('YII_DEBUG') === 'true');
define('YII_ENABLE_ERROR_HANDLER', false); // need to use our `set_error_handler`, `set_exception_handler`

(new ErrorHandler())->set();
(new JsonExceptionHandler())->set();

require_once __DIR__ . '/../vendor/yiisoft/yii2/BaseYii.php';

class Yii extends BaseYii
{
    /**
     * @var TypeHinting hack for component type hinting
     */
    public static $app;
}

spl_autoload_register(['Yii', 'autoload'], true, true);
Yii::$classMap = require __DIR__ . '/../vendor/yiisoft/yii2/classes.php';
Yii::$container = new yii\di\Container();
