<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Cek apakah email sudah digunakan
    $cek = $conn->query("SELECT * FROM mahasiswa WHERE email = '$email'");
    if ($cek->num_rows > 0) {
        $error = "Email sudah terdaftar.";
    } else {
        $stmt = $conn->prepare("INSERT INTO mahasiswa (nama, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nama, $email, $password);
        $stmt->execute();
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrasi Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script>
        function validateForm() {
            const nama = document.forms["regForm"]["nama"].value;
            const email = document.forms["regForm"]["email"].value;
            const pass = document.forms["regForm"]["password"].value;
            const conf = document.forms["regForm"]["confirm_password"].value;

            if (nama == "" || email == "" || pass == "" || conf == "") {
                alert("Semua field wajib diisi.");
                return false;
            }

            const emailRegex = /^[a-zA-Z0-9._%+-]+@unsoed\.ac\.id$/;
            if (!emailRegex.test(email)) {
                alert("Gunakan email @unsoed.ac.id.");
                return false;
            }

            if (pass.length < 4) {
                alert("Password minimal 4 karakter.");
                return false;
            }

            if (pass !== conf) {
                alert("Konfirmasi password tidak sama.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body class="container mt-5">
    <h2>Registrasi Mahasiswa</h2>
    <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form name="regForm" method="POST" onsubmit="return validateForm()">
        <input type="text" name="nama" class="form-control mb-2" placeholder="Nama Lengkap" required>
        <input type="email" name="email" class="form-control mb-2" placeholder="Email @unsoed.ac.id" required>
        <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
        <input type="password" name="confirm_password" class="form-control mb-2" placeholder="Konfirmasi Password" required>
        <button class="btn btn-success">Daftar</button>
        <a href="login.php" class="btn btn-secondary">Kembali ke Login</a>
    </form>
</body>
</html>
