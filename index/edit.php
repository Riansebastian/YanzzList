<?php
include 'db.php';
$id = $_GET['id'];

// Ambil data tugas berdasarkan id
$data = $conn->query("SELECT * FROM tasks WHERE id=$id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task = $_POST['task'];
    $deskripsi = $_POST['deskripsi'];
    $prioritas = $_POST['prioritas'];
    $status = $_POST['status'];
    $deadline = $_POST['deadline']; // Ambil tanggal dari form

    // Update data termasuk deadline
    $stmt = $conn->prepare("UPDATE tasks SET task=?, deskripsi=?, prioritas=?, status=?, deadline=? WHERE id=?");
    $stmt->bind_param("sssssi", $task, $deskripsi, $prioritas, $status, $deadline, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        die("Error updating data: " . $stmt->error);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Tugas</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background-color: #fff7f0;
            font-family: "Segoe UI", sans-serif;
        }
        .edit-container {
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            max-width: 500px;
            margin: 50px auto;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
        }
        .edit-container h2 {
            color: #ff7e67;
            margin-bottom: 10px;
        }
        .illustration {
            font-size: 48px;
            margin-bottom: 10px;
        }
        .form-group {
            text-align: left;
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #555;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        .btn-simpan {
            background-color: #6ec6ff;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
        }
        .btn-simpan:hover {
            background-color: #4aa3e0;
        }
    </style>
</head>
<body>

<div class="edit-container">
    <div class="illustration">🧾</div>
    <h2>Edit Tugas</h2>
    <a href="home.php" class="btn-home">🏠 Kembali ke Beranda</a>
    <form method="POST">
        <div class="form-group">
            <label>📝 Nama Tugas</label>
            <input type="text" name="task" value="<?= htmlspecialchars($data['task']) ?>" required>
        </div>
        <div class="form-group">
            <label>📄 Deskripsi</label>
            <input type="text" name="deskripsi" value="<?= htmlspecialchars($data['deskripsi']) ?>" required>
        </div>
        <div class="form-group">
            <label>🚦 Prioritas</label>
            <select name="prioritas">
                <option value="Tinggi" <?= $data['prioritas'] == 'Tinggi' ? 'selected' : '' ?>>Tinggi</option>
                <option value="Sedang" <?= $data['prioritas'] == 'Sedang' ? 'selected' : '' ?>>Sedang</option>
                <option value="Rendah" <?= $data['prioritas'] == 'Rendah' ? 'selected' : '' ?>>Rendah</option>
            </select>
        </div>
        <div class="form-group">
            <label>🧩 Status</label>
            <select name="status">
                <option value="belum" <?= $data['status'] == 'belum' ? 'selected' : '' ?>>Belum Selesai</option>
                <option value="selesai" <?= $data['status'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
            </select>
        </div>
        <div class="form-group">
            <label>📅 Deadline</label>
            <input type="date" name="deadline" value="<?= $data['deadline'] ?>" required>
        </div>
        <button type="submit" class="btn-simpan">💾 Simpan Perubahan</button>
    </form>
</div>

</body>
</html>
