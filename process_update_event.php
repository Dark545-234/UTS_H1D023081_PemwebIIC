<?php
session_start();
include 'koneksi.php';

// Cek apakah event_id, nama_event, dan tanggal ada di POST
if (!isset($_POST['event_id'], $_POST['nama_event'], $_POST['tanggal'])) {
    die("Data tidak lengkap.");
}

$event_id = (int) $_POST['event_id'];
$nama_event = $conn->real_escape_string($_POST['nama_event']);
$tanggal = $conn->real_escape_string($_POST['tanggal']);

// Update event
$update = $conn->query("UPDATE event SET nama_event = '$nama_event', tanggal = '$tanggal' WHERE id = $event_id");

if ($update) {
    header("Location: index.php");
    exit();
} else {
    die("Gagal memperbarui event: " . $conn->error);
}
?>
