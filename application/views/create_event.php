<?php
session_start();
include 'koneksi.php';

// Tentukan akun admin
$admin_email = "admin@unsoed.ac.id"; // Ganti dengan email admin yang ditentukan

// Cek apakah admin sudah login
if (!isset($_SESSION['email']) || $_SESSION['email'] != $admin_email) {
    die("⛔ ERROR: Hanya admin yang dapat mengakses halaman ini.");
}

// Proses form submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_event = $_POST['nama_event'];
    $tanggal = $_POST['tanggal'];

    // Cek apakah form sudah diisi
    if (empty($nama_event) || empty($tanggal)) {
        $error = "Semua field harus diisi!";
    } else {
        // Masukkan data ke dalam tabel event
        $stmt = $conn->prepare("INSERT INTO event (nama_event, tanggal) VALUES (?, ?)");
        $stmt->bind_param("ss", $nama_event, $tanggal);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $success = "Event berhasil dibuat!";
        } else {
            $error = "Terjadi kesalahan saat membuat event: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Event Kampus</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>Tambah Event Kampus</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php elseif (isset($success)): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="mb-3">
            <label for="nama_event" class="form-label">Nama Event</label>
            <input type="text" name="nama_event" id="nama_event" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal Event</label>
            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Buat Event</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</body>
</html>
