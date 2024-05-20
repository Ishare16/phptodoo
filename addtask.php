<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['task'])) {
    $task = $_POST['task'];

    
    $idData = json_decode(file_get_contents('id.json'), true);
    $userId = $idData['id'];

    
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "todo";

    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
    if ($conn->connect_error) {
        die('Could not connect to the database.');
    }

   
    $stmt = $conn->prepare("INSERT INTO task (opravilo, id_up) VALUES (?, ?)");
    $stmt->bind_param("si", $task, $userId);
    if ($stmt->execute()) {
        echo "Task added successfully";
    } else {
        echo "Failed to add task";
    }
    $stmt->close();
    $conn->close();

   
    header("Location: todo.php");
    exit();
}
?>
