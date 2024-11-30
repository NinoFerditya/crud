<?php
// koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "db_siswa");

// Cek apakah tombol login diklik
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    // Query untuk memeriksa username dan password
    $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        // Login berhasil
        session_start();
        $_SESSION['username'] = $username;
        header("Location: index.php"); // Ganti dengan halaman utama Anda
        exit();
    } else {
        // Login gagal
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h3>Login</h3>
        <?php if (isset($error)) : ?>
            <p style="color: red;"><?= $error; ?></p>
        <?php endif; ?>
            <form method="POST" action="">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required> <br> <br>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required><br><br>
                <button type="submit" name="login">Login</button>
                <p>Belum Punya Akun? <a href="register.php">Register</a></p>
            </form>
</body
</html>