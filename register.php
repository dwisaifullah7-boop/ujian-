<?php
include "koneksi.php";

$pesan = "";

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if ($username === "" || $password === "") {
        $pesan = "Username dan password wajib diisi.";
    } else {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = mysqli_prepare($conn, "INSERT INTO users (username, password) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, "ss", $username, $password_hash);

        if (mysqli_stmt_execute($stmt)) {
            $pesan = "Registrasi berhasil. Silakan login.";
        } else {
            $pesan = "Registrasi gagal. Username mungkin sudah digunakan.";
        }

        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi</title>
</head>
<body>
    <h2>Form Registrasi</h2>

    <?php if ($pesan): ?>
        <p><?= htmlspecialchars($pesan) ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Username</label><br>
        <input type="text" name="username" required>

        <br><br>

        <label>Password</label><br>
        <input type="password" name="password" required>

        <br><br>

        <button type="submit" name="register">Daftar</button>
    </form>

    <br>
    <a href="login.php">Sudah punya akun? Login</a>
</body>
</html>
