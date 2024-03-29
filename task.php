<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "basededatos";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Operaciones CRUD
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Crear tarea
    if ($_POST["action"] == "create") {
        $task = $_POST["task"];
        $sql = "INSERT INTO tasks (task) VALUES ('$task')";
        if ($conn->query($sql) === TRUE) {
            echo "Task created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    // Eliminar tarea
    elseif ($_POST["action"] == "delete") {
        $id = $_POST["id"];
        $sql = "DELETE FROM tasks WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Task deleted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Mostrar tareas
$sql = "SELECT * FROM tasks";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<li data-id='" . $row["id"] . "'>" . $row["task"] . " <button class='deleteBtn'>Delete</button></li>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
