<?php

declare(strict_types=1);

namespace Rb\Controller\Api\V1;

use Rb\UserStory\ExternalApplication\ViewVersion\ViewVersion;
use yii\rest\Controller;

/**
 *  @OA\OpenApi(
 *      @OA\Info(
 *          title="rb line application API",
 *          version="1.0"
 *      ),
 *      @OA\Server(
 *          url="http://localhost:1902",
 *          description="Dev"
 *     ),
 *      @OA\Server(
 *          url="https://",
 *          description="Test"
 *     ),
 *      @OA\Server(
 *          url="https://",
 *          description="Stage"
 *     ),
 *      @OA\Server(
 *          url="https://",
 *          description="Prod"
 *     ),
 * )
 */
class SiteController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/version",
     *     operationId="viewVersion",
     *     summary="View current application version",
     *     @OA\Parameter(
     *         name="app_token",
     *         in="query",
     *         description="Application token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *        response=200,
     *        description="OK",
     *        @OA\JsonContent(
     *          example=
     *          {
     *              "result": {
     *                  "successful": true,
     *                  "code": 200
     *              },
     *              "payload": {
     *                 "version": "0.1.0"
     *              }
     *           }
     *        ),
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized user",
     *     ),
     * )
     */
    public function actionVersion()
    {
        return new ViewVersion();
    }
}
