<?php

declare(strict_types=1);

namespace Rb\Controller\Api\V1;

use Rb\Infrastructure\Identity\OnlyRegisteredApps;
use Rb\Infrastructure\UserStory;
use Rb\UserStory\ExternalApplication\CreateTask\CreateTask;
use Rb\UserStory\ExternalApplication\CreateTask\Validation\ValidatedCreateTaskCommand;
use Rb\UserStory\ExternalApplication\DeletedTask\DeletedTask;
use Rb\UserStory\ExternalApplication\DeletedTask\Validation\ValidatedDeletedTaskCommand;
use Rb\UserStory\ExternalApplication\UpdateTask\UpdateTask;
use Rb\UserStory\ExternalApplication\UpdateTask\Validation\ValidatedUpdateTaskCommand;
use Rb\UserStory\ExternalApplication\ViewTaskList\ViewTaskList;
use Rb\UserStory\ExternalApplication\ViewTask\Validation\ValidatedViewTaskCommand;
use Rb\UserStory\ExternalApplication\ViewTask\ViewTask;
use Yii;
use yii\rest\Controller;

class TaskController extends Controller
{
    use OnlyRegisteredApps;

    /**
     * @OA\Post(
     *     path="/api/v1/tasks",
     *     operationId="createTask",
     *     summary="Create task",
     *     tags={"Task"},
     *     @OA\Parameter(
     *         name="app_token",
     *         in="query",
     *         description="Application token default = GZWWFFDw",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *              required={"title", "description", "due_date", "priority"},
     *                 @OA\Property(
     *                     property="title",
     *                     type="string",
     *                     description="Title task",
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string",
     *                     description="Description task",
     *                 ),
     *                 @OA\Property(
     *                     property="due_date",
     *                     type="date",
     *                     description="Date",
     *                 ),
     *                 @OA\Property(
     *                     property="priority",
     *                     type="string",
     *                     description="low|medium|high",
     *                 ),
     *                 example={
     *                      "title": "title",
     *                      "description": "description",
     *                      "due_date": "2024-06-04 13:26:49",
     *                      "priority": "low",
     *                  }
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *          response=201,
     *          description="Create",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized user",
     *      ),
     *      @OA\Response(
     *           response=400,
     *           description="Validation error",
     *       ),
     * )
     */
    public function actionCreate(): UserStory
    {
        return
            new CreateTask(
                new ValidatedCreateTaskCommand(
                    Yii::$app->request->getRawBody()
                )
            );
    }

    /**
     * @OA\Put(
     *     path="/api/v1/tasks/{id}",
     *     operationId="updateTask",
     *     summary="Update task",
     *     tags={"Task"},
     *     @OA\Parameter(
     *         name="app_token",
     *         in="query",
     *         description="Application token default = GZWWFFDw",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Task id",
     *         required=true,
     *         @OA\Schema(type="uuid")
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *              required={"title", "description", "due_date", "priority", "status"},
     *                 @OA\Property(
     *                     property="title",
     *                     type="string",
     *                     description="Title task",
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string",
     *                     description="Description task",
     *                 ),
     *                 @OA\Property(
     *                     property="due_date",
     *                     type="date",
     *                     description="Date",
     *                 ),
     *                 @OA\Property(
     *                     property="priority",
     *                     type="string",
     *                     description="low|medium|high",
     *                 ),
     *                 @OA\Property(
     *                      property="status",
     *                      type="string",
     *                      description="new|in_progress|return|finish|cancel",
     *                  ),
     *                 example={
     *                      "title": "title",
     *                      "description": "description",
     *                      "due_date": "2024-06-04 13:26:49",
     *                      "priority": "low",
     *                      "status": "return",
     *                  }
     *             )
     *         )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Ok",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized user",
     *      ),
     *      @OA\Response(
     *           response=400,
     *           description="Validation error",
     *       ),
     * )
     */
    public function actionUpdate($id): UserStory
    {
        return
            new UpdateTask(
                new ValidatedUpdateTaskCommand(
                    $id,
                    Yii::$app->request->getRawBody()
                )
            );
    }

    /**
     * @OA\Get(
     *     path="/api/v1/tasks/{id}",
     *     operationId="viewTask",
     *     summary="View task",
     *     tags={"Task"},
     *     @OA\Parameter(
     *          name="app_token",
     *          in="query",
     *          description="Application token default = GZWWFFDw",
     *          required=true,
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *           name="id",
     *           in="path",
     *           description="Task id",
     *           required=true,
     *           @OA\Schema(type="uuid")
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
     *                   "payload": {
     *                           "id": "c0f14ca5-aa97-4a62-bd4c-56798f3a727d",
     *                           "title": "title1",
     *                           "description": "description2",
     *                           "due_date": "2024-07-04 13:26:49.000",
     *                           "status": "in_progress",
     *                           "priority": "low",
     *                           "created_at": "2024-06-20 15:17:43.000",
     *                           "updated_at": "2024-06-20 15:39:52.000",
     *                           "is_deleted": "0"
     *                    }
     *                }
     *           ),
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized user",
     *      ),
     *           @OA\Response(
     *            response=400,
     *            description="Validation error",
     *        ),
     * )
     */
    public function actionView($id): UserStory
    {
        return
            new ViewTask(
                new ValidatedViewTaskCommand($id)
            );
    }

    /**
     * @OA\Get(
     *     path="/api/v1/tasks",
     *     operationId="viewTaskList",
     *     summary="View task list",
     *     tags={"Task"},
     *     @OA\Parameter(
     *          name="sort",
     *          in="query",
     *          description="Sort to title|-title",
     *          required=true,
     *          @OA\Schema(type="string")
     *      ),
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
     *                           "id": "c0f14ca5-aa97-4a62-bd4c-56798f3a727d",
     *                           "title": "title1",
     *                           "description": "description2",
     *                           "due_date": "2024-07-04 13:26:49.000",
     *                           "status": "in_progress",
     *                           "priority": "low",
     *                           "created_at": "2024-06-20 15:17:43.000",
     *                           "updated_at": "2024-06-20 15:39:52.000",
     *                           "is_deleted": "0"
     *                    }}
     *                }
     *           ),
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized user",
     *      ),
     *           @OA\Response(
     *            response=400,
     *            description="Validation error",
     *        ),
     * )
     */
    public function actionList(): UserStory
    {
        return
            new ViewTaskList();
    }

    /**
     * @OA\Delete (
     *     path="/api/v1/tasks/{id}",
     *     operationId="deletedTask",
     *     summary="Deleted task",
     *     tags={"Task"},
     *     @OA\Parameter(
     *         name="app_token",
     *         in="query",
     *         description="Application token default = GZWWFFDw",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Task id",
     *         required=true,
     *         @OA\Schema(type="uuid")
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Ok",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthorized user",
     *      ),
     *      @OA\Response(
     *           response=400,
     *           description="Validation error",
     *       ),
     * )
     */
    public function actionDeleted($id): UserStory
    {
        return
            new DeletedTask(
                new ValidatedDeletedTaskCommand($id)
            );
    }
}
