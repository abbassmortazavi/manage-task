<?php
/**
 * RegisterUserController.php
 * @author Abbass Mortazavi <abbassmortazavi@gmail.com | Abbass Mortazavi>
 * @copyright Copyright &copy; from assessment
 * @version 1.0.0
 * @date 2024/12/04 21:50
 */


namespace app\controllers\Api;

use app\core\Controller;
use app\core\Database;
use app\core\Request;
use app\models\RegisterModel;
use app\models\Task;
use app\services\User\UserService;
use Exception;


class TaskController extends Controller
{
    protected $task;

    public function __construct()
    {
        $this->task = new Task();
    }

    /**
     * @param Request $request
     * @return bool|mixed
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
     * @param Request $request
     * @return false|mixed|string
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
        } catch (\Exception $exception) {
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