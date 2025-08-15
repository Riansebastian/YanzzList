<?php
include 'db.php';

$id = $_GET['id'];
$aksi = $_GET['aksi'];

if ($aksi == 'semat') {
    $conn->query("UPDATE tasks SET semat = TRUE WHERE id = $id");
} elseif ($aksi == 'lepas') {
    $conn->query("UPDATE tasks SET semat = FALSE WHERE id = $id");
}

header("Location: index.php");
?>
