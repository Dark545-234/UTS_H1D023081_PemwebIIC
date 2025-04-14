<?php
include 'koneksi.php';

// Ambil total peserta per event
$laporan = $conn->query("
    SELECT e.nama_event, e.tanggal, COUNT(p.mahasiswa_id) AS total_peserta
    FROM event e
    LEFT JOIN pendaftaran p ON e.id = p.event_id
    GROUP BY e.id, e.nama_event, e.tanggal
");

// Ambil detail peserta
$detail = $conn->query("
    SELECT e.nama_event, m.nama, m.email
    FROM pendaftaran p
    INNER JOIN event e ON p.event_id = e.id
    INNER JOIN mahasiswa m ON p.mahasiswa_id = m.id
    WHERE p.mahasiswa_id IS NOT NULL
    ORDER BY e.nama_event
");
?>


<!DOCTYPE html>
<html>
<head>
    <title>Laporan Peserta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>Laporan Jumlah Peserta per Event</h2>
    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th>Nama Event</th>
                <th>Tanggal</th>
                <th>Total Peserta</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $laporan->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['nama_event'] ?></td>
                    <td><?= $row['tanggal'] ?></td>
                    <td><?= $row['total_peserta'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h4 class="mt-5">Detail Peserta Terdaftar</h4>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Event</th>
                <th>Nama Mahasiswa</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $detail->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['nama_event'] ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['email'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="index.php" class="btn btn-secondary mt-3">Kembali ke Beranda</a>
</body>
</html>
