<?php

declare(strict_types=1);

namespace Rb\Controller\Api\V1;

use Rb\Infrastructure\UserStory;
use Rb\UserStory\ExternalApplication\ViewStatusList\ViewStatusList;
use yii\rest\Controller;

class StatusController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/statuses",
     *     operationId="viewStatusList",
     *     summary="View status list",
     *     tags={"Status"},
     *      @OA\Parameter(
     *           name="app_token",
     *           in="query",
     *           description="Application token default = GZWWFFDw",
     *           required=true,
     *           @OA\Schema(type="string")
     *       ),
     *     @OA\Response(
     *        response=200,
     *        description="Ok",
     *        @OA\JsonContent(
     *               example=
     *               {
     *                   "result": {
     *                       "successful": true,
     *                       "code": 200
     *                   },
     *                   "payload": {{
     *                           "id": "new",
     *                           "title": "new",
     *                    }}
     *                }
     *           ),
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized user",
     *      ),
     * )
     */
    public function actionList(): UserStory
    {
        return
            new ViewStatusList();
    }
}