<?php
session_start();
include 'koneksi.php';

// Pastikan hanya admin yang bisa mengakses halaman ini
$admin_email = "admin@unsoed.ac.id"; // Ganti dengan email admin yang ditentukan
if (!isset($_SESSION['email']) || $_SESSION['email'] != $admin_email) {
    die("⛔ ERROR: Hanya admin yang dapat mengakses halaman ini.");
}

// Cek apakah parameter 'id' ada
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("⛔ ERROR: ID event tidak ditemukan.");
}

// Ambil id event dari parameter GET
$event_id = (int) $_GET['id'];

// Hapus event dari database
$delete = $conn->query("DELETE FROM event WHERE id = $event_id");

if ($delete) {
    echo "🎉 Event berhasil dihapus!<br>";
    echo "<a href='index.php'>Kembali ke Daftar Event</a>";
} else {
    echo "❌ Gagal menghapus event: " . $conn->error;
}
?>
