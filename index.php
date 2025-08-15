<?php include './koneksi/db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>My To Do List</title>
    <link rel="stylesheet" href="styles.css">
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background: #d0d0d3ff;
        padding: 30px;
        margin: 0;
    }
    h1 {
        text-align: center;
        color: #0f05a5;
        font-size: 36px;
        margin-bottom: 20px;
    }
    .btn-home {
        display: inline-block;
        background-color: #0f05a5;
        color: white;
        padding: 8px 16px;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        margin-bottom: 20px;
    }
    .btn-home:hover {
        background-color: #251dcf;
    }
    form {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
        margin-bottom: 20px;
    }
    input, select {
        padding: 10px;
        font-size: 14px;
        border-radius: 8px;
        border: 1.5px solid #0f05a5;
        width: 200px;
    }
    button {
        padding: 10px 20px;
        background-color: #0f05a5;
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: bold;
        cursor: pointer;
    }
    button:hover {
        background-color: #251dcf;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: #ffffff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
    }
    th {
        background-color: #0f05a5;
        color: white;
        padding: 12px;
    }
    td {
        padding: 14px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }
    .tinggi {
        background-color: #f44336;
        color: white;
        padding: 5px 10px;
        border-radius: 6px;
        font-weight: bold;
    }
    .sedang {
        background-color: #ff9800;
        color: white;
        padding: 5px 10px;
        border-radius: 6px;
        font-weight: bold;
    }
    .rendah {
        background-color: #4caf50;
        color: white;
        padding: 5px 10px;
        border-radius: 6px;
        font-weight: bold;
    }
    .btn-edit, .btn-hapus, .btn-status, .btn-semat, .btn-lepas {
        text-decoration: none;
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 13px;
        margin: 2px;
        display: inline-block;
        font-weight: 500;
    }
    .btn-edit {
        background-color: #2196f3;
        color: white;
    }
    .btn-edit:hover {
        background-color: #1976d2;
    }
    .btn-hapus {
        background-color: #e53935;
        color: white;
    }
    .btn-hapus:hover {
        background-color: #c62828;
    }
    .btn-status {
        background-color: #c5e1a5;
        color: #0f05a5;
    }
    .btn-status:hover {
        background-color: #aed581;
    }
    .btn-semat, .btn-lepas {
        background-color: #ffeb3b;
        color: #333;
    }
    .btn-semat:hover, .btn-lepas:hover {
        background-color: #fdd835;
    }
    footer {
        text-align: center;
        margin-top: 40px;
        font-size: 14px;
        color: #555;
    }
</style>
</head>
<body>
    <h1>📝 My To Do List</h1>
    <a href="home.php" class="btn-home">🏠 Beranda</a>

    <form action="tambah.php" method="POST">
        <input type="text" name="task" placeholder="Nama tugas" required>
        <input type="text" name="deskripsi" placeholder="Deskripsi" required>
        <select name="prioritas">
            <option value="Tinggi">Tinggi</option>
            <option value="Sedang">Sedang</option>
            <option value="Rendah">Rendah</option>
        </select>
        <input type="date" name="deadline" required>
        <button type="submit">Tambah</button>
    </form>

    <table>
        <tr>
            <th>Tugas</th>
            <th>Deskripsi</th>
            <th>Prioritas</th>
            <th>Status</th>
            <th>Aksi</th>
            <th>Deadline</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM tasks ORDER BY semat DESC, id DESC");
        while ($row = $result->fetch_assoc()):
        ?>
        <tr>
    <td>
        <?php if ($row['status'] == 'selesai'): ?>
            <span style="text-decoration: line-through; color: grey;"><?= htmlspecialchars($row['task']) ?></span>
        <?php else: ?>
            <?= htmlspecialchars($row['task']) ?>
        <?php endif; ?>
    </td>
    <td><?= htmlspecialchars($row['deskripsi']) ?></td>
    <td><span class="<?= strtolower($row['prioritas']) ?>"><?= $row['prioritas'] ?></span></td>
    <td>
        <?= $row['status'] == 'selesai' ? '✅ Selesai' : '⏳ Belum' ?>
        <br>
        <a href="tandai.php?id=<?= $row['id'] ?>" class="btn-status">Tandai</a>
    </td>
    <td>
        <a href="edit.php?id=<?= $row['id'] ?>" class="btn-edit">Edit</a>
        <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus?')" class="btn-hapus">Hapus</a>
        <?php if ($row['semat']): ?>
            <a href="semat.php?id=<?= $row['id'] ?>&aksi=lepas" class="btn-lepas">📌 Lepas</a>
        <?php else: ?>
            <a href="semat.php?id=<?= $row['id'] ?>&aksi=semat" class="btn-semat">📍Semat</a>
        <?php endif; ?>
    </td>
    <td><?= $row['deadline'] ? date('d-m-Y', strtotime($row['deadline'])) : 'Belum diatur'?></td>
</tr>
        <?php endwhile; ?>
    </table>
</body>
<footer class="footer">
<p>By Rian Sebastian  &copy; 2025 | <a href="kontak.php">Kontak</a></p>
</footer>

</html>
