<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task = $_POST['task'];
    $deskripsi = $_POST['deskripsi'];
    $prioritas = $_POST['prioritas'];
    $deadline = $_POST['deadline'];

    // Gunakan prepared statement dengan placeholder
    $sql = "INSERT INTO tasks (task, deskripsi, prioritas, deadline) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // ssss artinya 4 parameter string
    $stmt->bind_param("ssss", $task, $deskripsi, $prioritas, $deadline);

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: index.php");
        exit();
    } else {
        die("Error executing query: " . $stmt->error);
    }
}
?>
