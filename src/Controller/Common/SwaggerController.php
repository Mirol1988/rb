<?php

declare(strict_types=1);

namespace Rb\Controller\Common;

use Rb\Infrastructure\Environment\Env;
use yii\rest\Controller;
use function OpenApi\scan;

class SwaggerController extends Controller
{
    public function actionAdminExport()
    {
        return
            $this->asJson(
                json_decode((scan(dirname(__DIR__) . '/Admin'))->toJson(), true)
            );
    }

    public function actionV1Export()
    {
        return
            $this->asJson(
                json_decode((scan(dirname(__DIR__) . '/Api/V1'))->toJson(), true)
            );
    }

    public function actionFrontendExport()
    {
        return
            $this->asJson(
                json_decode((scan(dirname(__DIR__) . '/Frontend'))->toJson(), true)
            );

    }
    public function actionAdminDoc()
    {
        return $this->reDoc(rtrim((new Env('COMMON_URL'))->value(), '/') . '/swagger/admin');
    }

    public function actionV1Doc()
    {
        return $this->reDoc(rtrim((new Env('COMMON_URL'))->value(), '/') . '/swagger/v1');
    }

    public function actionFrontendDoc()
    {
        return $this->reDoc(rtrim((new Env('COMMON_URL'))->value(), '/') . '/swagger/frontend');
    }

    private function reDoc(string $swaggerUrl)
    {
        return <<<"HTML"
<!DOCTYPE html>
<html>
  <head>
    <title>Rb public API v.1 Documentation</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700|Roboto:300,400,700" rel="stylesheet">
    <style>
      body {
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
    <redoc spec-url='$swaggerUrl'></redoc>
    <script src="https://cdn.jsdelivr.net/npm/redoc@next/bundles/redoc.standalone.js"> </script>
  </body>
</html>
HTML;
    }
}
