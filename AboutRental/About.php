<?php
session_start();

// Periksa apakah pengguna sudah login
$isLoggedIn = isset($_SESSION['user_id']) && $_SESSION['role'] === 'user';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Zahrarental</title>
    <meta name="description" content="Zahrarental adalah penyedia layanan rental mobil terpercaya. Kami siap memenuhi kebutuhan perjalanan Anda dengan berbagai pilihan kendaraan dan layanan terbaik.">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../css/About.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
        <div class="container">
            <a class="navbar-brand fs-4" href="../Final.php">Zahrarental</a>
            <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Sidebar -->
            <div class="sidebar offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header" style="border-bottom: 1px solid black;">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Zahrarental</h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>

                <!-- Sidebar Body -->
                <div class="offcanvas-body d-flex flex-column flex-lg-row p-4 p-lg-0">
                    <ul class="navbar-nav justify-content-center align-items-center fs-6 flex-grow-1 pe-3">
                        <li class="nav-item mx-2">
                            <a class="nav-link active" aria-current="page" href="../Final.php">Home</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="#">About rental</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="../Contact/contact.php">Contact</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="../Pesanan/pesanan.php">Pemesanan</a>
                        </li>
                    </ul>

                    <div class="d-flex flex-column flex-lg-row justify-content-center align-items-center gap-3">
                        <?php if ($isLoggedIn): ?>
                            <!-- Jika pengguna sudah login -->
                            <span class="text-black">Halo, <?= htmlspecialchars($_SESSION['name'] ?? 'Pengguna'); ?></span>
                            <a href="profil.php" class="text-black">Profil</a>
                            <a href="../Login/logout.php" class="text-danger">Logout</a>
                        <?php else: ?>
                            <!-- Jika pengguna belum login -->
                            <a href="Login/loginnew.php" class="text-black">Login</a>
                            <a href="Login/register.php" class="text-white text-decoration-none px-3 py-1 bg-primary rounded-4">Sign up</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section mt-5">
        <h1 id="typedText"></h1>
    </div>

    <!-- Content Section -->
    <div class="container content-section">
        <h2 class="text-center">Tentang Kami</h2>
        <p class="text-center">
            Kami di "Zahrarental" percaya bahwa setiap perjalanan adalah pengalaman yang berharga. Dengan pilihan kendaraan yang lengkap dan layanan pelanggan terbaik, kami berkomitmen untuk membuat perjalanan Anda nyaman dan menyenangkan.
        </p>
        <p>
            Apakah Anda mencari kendaraan untuk perjalanan keluarga, bisnis, atau liburan? Kami memiliki berbagai jenis mobil yang dapat disesuaikan dengan kebutuhan Anda. Dengan proses pemesanan yang mudah dan dukungan pelanggan yang ramah, Anda tidak perlu khawatir tentang apa pun.
        </p>
        <p class="text-center fw-bold">
            Percayakan perjalanan Anda kepada kami dan nikmati kenyamanan tanpa batas!
        </p>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <div class="mb-3">
                <a href="https://wa.me/6287730041815" class="text-white me-4" target="_blank" aria-label="WhatsApp">
                    <i class="fab fa-whatsapp fs-4"></i>
                </a>
                <a href="https://instagram.com/zahrarentalkarawang" class="text-white me-4" target="_blank" aria-label="Instagram">
                    <i class="fab fa-instagram fs-4"></i>
                </a>
                <a href="https://tiktok.com/@zahrarent" class="text-white" target="_blank" aria-label="TikTok">
                    <i class="fab fa-tiktok fs-4"></i>
                </a>
            </div>
            <p class="mb-0">&copy; 2024 Zahrarental | All rights reserved</p>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="../Js/about.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
