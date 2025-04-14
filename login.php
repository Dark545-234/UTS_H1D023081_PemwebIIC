<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM mahasiswa WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $_SESSION['email'] = $email;
        header("Location: index.php");
        exit();
    } else {
        $error = "Email atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script>
        function validateLogin() {
            const email = document.forms["loginForm"]["email"].value;
            const pass = document.forms["loginForm"]["password"].value;

            if (email == "" || pass == "") {
                alert("Harap isi semua field.");
                return false;
            }

            const emailRegex = /^[a-zA-Z0-9._%+-]+@unsoed\.ac\.id$/;
            if (!emailRegex.test(email)) {
                alert("Gunakan email mahasiswa @unsoed.ac.id.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body class="container mt-5">
    <h2>Login Mahasiswa</h2>
    <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

    <form name="loginForm" method="POST" onsubmit="return validateLogin()">
        <input type="email" name="email" class="form-control mb-2" placeholder="Email @unsoed.ac.id" required>
        <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
        <button class="btn btn-primary">Login</button>
        <a href="registrasi.php" class="btn btn-link">Belum punya akun? Daftar</a>
    </form>
</body>
</html>
