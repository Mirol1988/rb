<?php

declare(strict_types=1);

namespace Rb\Controller\Api\V1;

use Rb\Infrastructure\UserStory;
use Rb\UserStory\ExternalApplication\ViewPriorityList\ViewPriorityList;
use Rb\UserStory\ExternalApplication\ViewStatusList\ViewStatusList;
use yii\rest\Controller;

class PriorityController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/priorities",
     *     operationId="viewPriorityList",
     *     summary="View priority list",
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
     *                           "id": "low",
     *                           "title": "low",
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
            new ViewPriorityList();
    }
}