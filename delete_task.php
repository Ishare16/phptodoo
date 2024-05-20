<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['task_id'])) {
    $taskId = $_POST['task_id'];

    
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "todo";

    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
    if ($conn->connect_error) {
        die('Could not connect to the database.');
    }

    $stmt = $conn->prepare("DELETE FROM task WHERE id = ?");
    $stmt->bind_param("i", $taskId);
    if ($stmt->execute()) {
        echo "Task deleted successfully";
    } else {
        echo "Failed to delete task";
    }
    $stmt->close();
    $conn->close();

    
    header("Location: todo.php");
    exit();
}
?>
