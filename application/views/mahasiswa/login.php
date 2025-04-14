

<!DOCTYPE html>
<html>
<head>
    <title>Login Mahasiswa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>Login Mahasiswa</h2>
    <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

    <form action="<?= base_url('mahasiswa/login') ?>" name="loginForm" method="POST">
        <input type="email" name="email" class="form-control mb-2" placeholder="Email @unsoed.ac.id" required>
        <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
        <button class="btn btn-primary">Login</button>
        <a href="registrasi.php" class="btn btn-link">Belum punya akun? Daftar</a>
    </form>
</body>
</html>
