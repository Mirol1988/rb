<?php

declare(strict_types=1);

use Rb\Infrastructure\Application\Config\Restful as RestfulConfig;
use Rb\Infrastructure\Application\Database\MariaDb;
use Rb\Infrastructure\Application\Database\MariaDbUbet;
use Rb\Infrastructure\Application\Language\Russian;
use Rb\Infrastructure\Application\Web;
use Rb\Infrastructure\Application\System\Admin;
use Rb\Infrastructure\Identity\JWT\ByJWTToken;
use Rb\Routes\Admin as AdminRoutes;

require_once __DIR__ . '/../bootstrap.php';

$application =
    (new Web(
        new RestfulConfig(
            new Admin(),
            new MariaDb(),
            new Russian(),
            new AdminRoutes(),
            new ByJWTToken()
        )
    ))
        ->application()
        ->run();

