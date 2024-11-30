<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "db_siswa");

// Cek apakah tombol register diklik
if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    // Validasi input
    if (empty($username) || empty($password)) {
        $error = "Username dan Password harus diisi!";
    } else {
        // Cek apakah username sudah ada
        $query_check = "SELECT * FROM user WHERE username='$username'";
        $result_check = mysqli_query($koneksi, $query_check);

        if (mysqli_num_rows($result_check) > 0) {
            $error = "Username sudah digunakan!";
        } else {
            // Simpan data ke database
            $query = "INSERT INTO user (username, password) VALUES ('$username', '$password')";
            if (mysqli_query($koneksi, $query)) {
                // Redirect ke halaman login
                header("Location: login.php");
                exit;
            } else {
                $error = "Terjadi kesalahan saat registrasi!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h3>Register</h3>
    <?php if (isset($error)) : ?>
        <p style="color: red;"><?= $error; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required><br><br>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required><br><br>

        <button type="submit" name="register">Register</button>
    </form>
    <p>Sudah punya akun? <a href="login.php">Login</a></p>
</body>
</html>
