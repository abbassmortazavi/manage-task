<?php
/**
 * Task.php
 * @author Abbass Mortazavi <abbassmortazavi@gmail.com | Abbass Mortazavi>
 * @copyright Copyright &copy; from assessment
 * @version 1.0.0
 * @date 2024/12/04 23:34
 */


namespace app\models;

use app\core\Model;
use PDO;

class Task extends Model
{
    /**
     * @param $task_name
     * @param $description
     * @param $assigned_to
     * @param $due_date
     * @param $status
     * @return bool
     */
    public function create($task_name, $description, $assigned_to, $due_date, $status): bool
    {
        $sql = "INSERT INTO tasks (task_name, description, assigned_to, due_date, status) 
                VALUES (:task_name, :description, :assigned_to, :due_date, :status)";
        $stmt = $this->db->getPDO()->prepare($sql);
        return $stmt->execute([
            ':task_name' => $task_name,
            ':description' => $description,
            ':assigned_to' => $assigned_to,
            ':due_date' => $due_date,
            ':status' => $status
        ]);
    }

    /**
     * @param $status
     * @param $date
     * @return false|string
     */
    public function getTasks($status = null, $date = null): false|string
    {
        $sql = "SELECT * FROM tasks";

        if ($status || $date) {
            $sql .= " WHERE";
            if ($status) {
                $sql .= " status = :status";
            }
            if ($date) {
                if ($status) {
                    $sql .= " AND";
                }
                $sql .= " due_date = :due_date";
            }
        }
        $stmt = $this->db->getPDO()->prepare($sql);

        if ($status) {
            $stmt->bindParam(':status', $status);
        }
        if ($date) {
            $stmt->bindParam(':due_date', $date);
        }
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch the results as an associative array

        // Convert the results to JSON format
        header('Content-Type: application/json'); // Set header for JSON response
        return json_encode($results, JSON_PRETTY_PRINT);
    }


    // Update an existing task
    public function updateTask($id, $task_name, $description, $assigned_to, $due_date, $status) {
        $sql = "UPDATE tasks SET task_name = :task_name, description = :description, 
                assigned_to = :assigned_to, due_date = :due_date, status = :status 
                WHERE id = :id";
        $stmt = $this->db->getPDO()->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':task_name' => $task_name,
            ':description' => $description,
            ':assigned_to' => $assigned_to,
            ':due_date' => $due_date,
            ':status' => $status
        ]);
    }
}