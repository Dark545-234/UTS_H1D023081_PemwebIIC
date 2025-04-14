<?php
$conn = new mysqli("localhost", "root", "", "event_kampus");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
