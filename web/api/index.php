<?php

declare(strict_types=1);

use Rb\Infrastructure\Application\Database\MariaDb;
use Rb\Infrastructure\Application\Database\MariaDbUbet;
use Rb\Infrastructure\Application\Language\Russian;
use Rb\Infrastructure\Application\Web;
use Rb\Infrastructure\Application\Routes\MergedRoutes;
use Rb\Infrastructure\Application\Config\Restful as RestfulConfig;
use Rb\Infrastructure\Application\System\ApiV1;
use Rb\Models\Identity\ByAppToken;
use Rb\Routes\Api\ApiV1 as ApiV1Routes;

require_once __DIR__ . '/../bootstrap.php';

(new Web(
    new RestfulConfig(
        new ApiV1(),
        new MariaDb(),
        new Russian(),
        new MergedRoutes(
            new ApiV1Routes()
        ),
        new ByAppToken()
    )
))
    ->application()
    ->run();
