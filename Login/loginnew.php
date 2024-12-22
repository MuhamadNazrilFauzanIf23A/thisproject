<?php
session_start();
require_once "../DB/zahra.php";
require_once "Auth.php";

// Variabel untuk menampilkan pesan error
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        // Inisialisasi koneksi database
        $database = new Database();
        $conn = $database->getConnection();

        // Inisialisasi kelas autentikasi
        $auth = new Auth($conn);

        // Data input dari form
        $email_or_phone = $_POST['email_or_phone'];
        $password = $_POST['password'];

        // Proses login
        $auth->login($email_or_phone, $password);

    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="class-page">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px;">
            <h1 class="text-center mb-4">Login</h1>
            <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
            <form method="POST" action="">
                <div class="mb-3">
                    <input type="text" name="email_or_phone" class="form-control" placeholder="Nomor HP atau email" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-3">Log In</button>
            </form>
            <p class="mt-4 text-center"><a href="lupa_password.php">Lupa Password?</a></p>
            <p class="mt-1 text-center">Belum memiliki akun? <a href="register.php">Daftar dulu</a></p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
