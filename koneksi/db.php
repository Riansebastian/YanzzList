<?php
$servername = "localhost";  // Bukan 'host'
$username = "root";         // Default user XAMPP
$password = "";             // Default password kosong
$dbname = "todo_db";        // Pastikan database sudah dibuat

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
