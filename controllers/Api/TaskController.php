<?php
/**
 * TaskController.php
 * @author Abbass Mortazavi <abbassmortazavi@gmail.com | Abbass Mortazavi>
 * @copyright Copyright &copy; from assessment
 * @version 1.0.0
 * @date 2024/12/04 21:50
 */


namespace app\controllers\Api;

use app\core\Controller;
use app\core\Request;
use app\models\Task;
use Exception;
use OpenApi\Annotations as OA;


class TaskController extends Controller
{
    protected $task;

    public function __construct()
    {
        $this->task = new Task();
    }

    /**
     * @OA\Post(
     *     path="/api/task/create",
     *     summary="Create a new task",
     *     description="This endpoint allows you to create a new task by providing the task details.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\Content(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 required={"task_name", "description", "assigned_to", "due_date", "status"},
     *                 @OA\Property(
     *                     property="task_name",
     *                     type="string",
     *                     description="The name of the task",
     *                     example="Complete the report"
     *                 ),
     *                 @OA\Property(
     *                     property="description",
     *                     type="string",
     *                     description="A detailed description of the task",
     *                     example="Write the final report for the project"
     *                 ),
     *                 @OA\Property(
     *                     property="assigned_to",
     *                     type="string",
     *                     description="The person to whom the task is assigned",
     *                     example="John Doe"
     *                 ),
     *                 @OA\Property(
     *                     property="due_date",
     *                     type="string",
     *                     format="date",
     *                     description="The due date for the task",
     *                     example="2024-12-10"
     *                 ),
     *                 @OA\Property(
     *                     property="status",
     *                     type="string",
     *                     description="The current status of the task",
     *                     enum={"pending", "in_progress", "completed"},
     *                     example="pending"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Task created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Task created successfully"),
     *             @OA\Property(property="task_id", type="integer", example=123)
     *         )
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Bad Request, invalid input",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Invalid input data")
     *         )
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Internal Server Error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Server error, please try again later")
     *         )
     *     )
     * )
     */
    public function create(Request $request): mixed
    {
        try {
            return $this->prepareData($request->getBody());
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            return json_decode($exception->getMessage());
        }
    }

    /**
     * @OA\Get(
     *     path="/api/task/lists",
     *     summary="This Api Show All Tasks",
     *    @OA\Parameter(
     *          name="name",
     *          in="query",
     *          description="Please enter Owner like: abbassmortazavi",
     *          required=false,
     *          @OA\Schema(type="string")
     *      ),
     *     @OA\Response(response="200", description="Create successful"),
     *     @OA\Response(response="401", description="Invalid credentials")
     * )
     *
     */
    public function lists(Request $request): mixed
    {
        try {
            $status = $request->getBody()['status'] ?? null;
            $due_date = $request->getBody()['due_date'] ?? null;
            return $this->task->getTasks($status, $due_date);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            return json_decode($exception->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */

    public function update(Request $request): mixed
    {
        try {
            $id = $request->getBody()['id'] ?? null;
            $task_name = $request->getBody()['task_name'] ?? null;
            $description = $request->getBody()['description'] ?? null;
            $assigned_to = $request->getBody()['assigned_to'] ?? null;
            $due_date = $request->getBody()['due_date'] ?? null;
            $status = $request->getBody()['status'] ?? null;
            //$data = json_decode(file_get_contents('php://input'), true);
            if (isset($task_name, $description, $assigned_to, $due_date, $status)) {
                $this->task->update(
                    $id,
                    $task_name,
                    $description,
                    $assigned_to,
                    $due_date,
                    $status

                );
                return json_encode(['message' => 'Task updated successfully']);
            } else {
                return json_encode(['error' => 'Missing required fields']);
            }
        } catch (Exception $exception) {
            echo $exception->getMessage();
            return json_decode($exception->getMessage());
        }
    }

    /**
     * @param array $attributes
     * @return bool
     */
    private function prepareData(array $attributes): bool
    {
        $taskName = $attributes['task_name'];
        $description = $attributes['description'];
        $assignedTo = $attributes['assigned_to'];
        $dueDate = $attributes['due_date'];
        $status = $attributes['status'];
        $model = new Task();
        return $model->create($taskName, $description, $assignedTo, $dueDate, $status);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request): mixed
    {
        try {
            $id = $request->getBody()['id'] ?? null;
            $this->task->delete($id);
            return json_encode(['message' => 'Task deleted successfully']);
        } catch (Exception $exception) {
            echo $exception->getMessage();
            return json_decode($exception->getMessage());
        }
    }
}