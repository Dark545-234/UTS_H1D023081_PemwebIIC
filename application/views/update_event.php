<?php
session_start();
include 'koneksi.php';

// Cek jika ada ID event yang dikirim
if (!isset($_GET['id'])) {
    die("Event ID tidak ditemukan.");
}

$event_id = (int) $_GET['id'];

// Ambil data event berdasarkan ID
$event = $conn->query("SELECT * FROM event WHERE id = $event_id");

if ($event->num_rows == 0) {
    die("Event tidak ditemukan.");
}

$row = $event->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Event Kampus</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>Update Event</h2>

    <form method="POST" action="process_update_event.php">
        <input type="hidden" name="event_id" value="<?= $row['id'] ?>">

        <div class="mb-3">
            <label for="nama_event" class="form-label">Nama Event</label>
            <input type="text" class="form-control" id="nama_event" name="nama_event" value="<?= $row['nama_event'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal Event</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $row['tanggal'] ?>" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</body>
</html>
