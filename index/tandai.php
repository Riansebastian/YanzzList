<?php
include 'db.php';
$id = $_GET['id'];

$cek = $conn->query("SELECT status FROM tasks WHERE id=$id")->fetch_assoc();
$statusBaru = $cek['status'] == 'selesai' ? 'belum' : 'selesai';

$conn->query("UPDATE tasks SET status='$statusBaru' WHERE id=$id");
header("Location: index.php");
?>
