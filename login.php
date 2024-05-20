<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "todo";

    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
    if ($conn->connect_error) {
        die('Could not connect to the database.');
    } else {
        $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        if ($stmt_result->num_rows > 0) {
            $data = $stmt_result->fetch_assoc();
            if ($data['password'] === $password) {
                echo "<h1>Login Successful</h1>";

                
                $idData = array("id" => $data['id']);
                file_put_contents('id.json', json_encode($idData));

                Header('Location: todo.php');

            } else {
                echo "<h1>Login Failed</h1>";
            }
        } else {
            echo "<h1>Login Failed</h1>";
        }
        $stmt->close();
    }
    $conn->close();
}
?>
