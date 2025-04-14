<?php
session_start();
include 'koneksi.php';

// Ambil data event
$events = $conn->query("SELECT * FROM event");

// Tentukan akun admin
$admin_email = "admin@unsoed.ac.id"; // Ganti dengan email admin yang ditentukan
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Event Kampus</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>KAMPUS PUNYA CERITA</h2>

    <?php if (isset($_SESSION['email'])): ?>
        <p>Login sebagai: <b><?= htmlspecialchars($_SESSION['email']) ?></b> | <a href="logout.php">Logout</a></p>
    <?php else: ?>
        <a href="login.php" class="btn btn-secondary mb-3">Login Mahasiswa</a>
    <?php endif; ?>

    <?php if (isset($_SESSION['email']) && $_SESSION['email'] == $admin_email): ?>
        <a href="create_event.php" class="btn btn-sm btn-primary mb-3">Create Event</a>
    <?php endif; ?>

    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th>Nama Event</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $events->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['nama_event']) ?></td>
                    <td><?= htmlspecialchars($row['tanggal']) ?></td>
                    <td>
                        <?php if (isset($_SESSION['email']) && $_SESSION['email'] != $admin_email): ?>
                            <!-- Tombol Daftar hanya muncul untuk mahasiswa -->
                            <form method="POST" action="daftar.php" style="display:inline;">
                                <input type="hidden" name="event_id" value="<?= $row['id'] ?>">
                                <button class="btn btn-sm btn-success">Daftar</button>
                            </form>
                        <?php elseif (!isset($_SESSION['email'])): ?>
                            <small><i>Silakan login terlebih dahulu</i></small>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['email']) && $_SESSION['email'] == $admin_email): ?>
                            <!-- Tombol Update dan Delete hanya muncul untuk admin -->
                            <a href="update_event.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Update</a>
                            <a href="delete_event.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus event ini?')">Delete</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="laporan.php" class="btn btn-info mt-3">Lihat Laporan Peserta</a>
</body>
</html>
