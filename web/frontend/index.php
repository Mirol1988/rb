<?php

declare(strict_types=1);

use Rb\Infrastructure\Application\Database\MariaDb;
use Rb\Infrastructure\Application\Language\Russian;
use Rb\Infrastructure\Application\System\Frontend;
use Rb\Infrastructure\Application\Web;
use Rb\Infrastructure\Application\Config\Restful as RestfulConfig;
use Rb\Infrastructure\Identity\JWT\ByJWTToken;
use Rb\Models\Identity\ByAppToken;
use Rb\Routes\Frontend as FrontendRoutes;
use Rb\Infrastructure\Application\Database\MariaDbUbet;

require_once __DIR__ . '/../bootstrap.php';

(new Web(
    new RestfulConfig(
        new Frontend(),
        new MariaDb(),
        new Russian(),
        new FrontendRoutes(),
        new ByJWTToken()
    )
))
    ->application()
    ->run();
