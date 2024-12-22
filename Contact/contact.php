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
    <title>Kontak Kami - Zahrarental</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../css/kontak.css" rel="stylesheet">
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
                <!-- Sidebar body -->
                <div class="offcanvas-body d-flex flex-column flex-lg-row p-4 p-lg-0">
                    <ul class="navbar-nav justify-content-center align-items-center fs-6 flex-grow-1 pe-3">
                        <li class="nav-item mx-2">
                            <a class="nav-link active" aria-current="page" href="../Final.php">Home</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="../AboutRental/About.php">About rental</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="#">Contact</a>
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
        <h1>Kontak Kami</h1>
        <p>Hubungi kami melalui email, telepon, atau kunjungi lokasi kami. Kami siap membantu Anda!</p>
    </div>

    <!-- Contact Section -->
    <div class="container contact-section my-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="contact-card mb-4 p-4 shadow-sm text-center">
                    <h4><i class="fas fa-envelope"></i> Email</h4>
                    <p><a href="mailto:info@zahrarental.com">info@zahrarental.com</a></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-card mb-4 p-4 shadow-sm text-center">
                    <h4><i class="fas fa-phone"></i> Telepon</h4>
                    <p><a href="tel:+628123456789">+62 812-3456-789</a></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="contact-card mb-4 p-4 shadow-sm text-center">
                    <h4><i class="fas fa-map-marker-alt"></i> Lokasi</h4>
                    <p>Jl. Contoh Alamat No. 123, Jakarta, Indonesia</p>
                </div>
            </div>
        </div>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
