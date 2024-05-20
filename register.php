<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "todo";

    
    $conn = new mysqli($host, $user, $password, $db);

 
    if ($conn->connect_error) {
        die("Povezava ni uspela: " . $conn->connect_error);
    }


    $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $_POST['email'], $_POST['password']);
    
    if ($stmt->execute()) {
        echo "New record created successfully";
        header("Location: index.html");
        exit(); 
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
