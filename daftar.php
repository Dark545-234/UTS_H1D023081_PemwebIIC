<?php
session_start();
include 'koneksi.php';

echo "<pre>";

// 1. Cek session login
if (!isset($_SESSION['email'])) {
    die("⛔ ERROR: Belum login. <a href='login.php'>Login dulu</a>");
}

$email = $conn->real_escape_string($_SESSION['email']);
echo "✅ Session email: $email\n";

// 2. Cek event_id dari POST
if (!isset($_POST['event_id']) || empty($_POST['event_id'])) {
    die("⛔ ERROR: event_id tidak dikirim dari form.");
}

$event_id = (int) $_POST['event_id'];
echo "✅ event_id dari form: $event_id\n";

// 3. Cek apakah mahasiswa ada di database
$result = $conn->query("SELECT id FROM mahasiswa WHERE email = '$email'");

if ($result->num_rows === 0) {
    die("⛔ ERROR: Mahasiswa dengan email '$email' tidak ditemukan di tabel mahasiswa.");
}

$row = $result->fetch_assoc();
$mahasiswa_id = $row['id'];
echo "✅ ID mahasiswa ditemukan: $mahasiswa_id\n";

// 4. Cek apakah sudah pernah daftar
$cek = $conn->query("SELECT * FROM pendaftaran WHERE mahasiswa_id = $mahasiswa_id AND event_id = $event_id");

if ($cek->num_rows > 0) {
    die("⚠️ Kamu sudah pernah daftar event ini!");
}

// 5. Insert ke tabel pendaftaran
$insert = $conn->query("INSERT INTO pendaftaran (mahasiswa_id, event_id) VALUES ($mahasiswa_id, $event_id)");

if ($insert) {
    echo "🎉 Berhasil daftar event!";
    echo "\n<a href='index.php'>Kembali ke beranda</a>";
} else {
    echo "❌ Gagal insert ke pendaftaran: " . $conn->error;
}
echo "</pre>";
?>
