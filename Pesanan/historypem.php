<?php
session_start();

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../Login/loginnew.php");
    exit;
}

// Koneksi ke database
require '../DB/Dbzahra.php';

// Sertakan file kelas
require 'Mobil.php';
require 'Pemesanan.php';

// Ambil ID pengguna yang sedang login
$userId = $_SESSION['user_id'];

// Ambil semua pemesanan milik pengguna
$pemesananList = Pemesanan::getPemesananByUser($userId, $conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Pemesanan - Zahrarental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" />
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
    <div class="container">
        <a class="navbar-brand fs-4 " href="#">Zahrarental</a>
        <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Sidebar -->
        <div class="sidebar offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header" style="border-bottom: 1px solid black;">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Zahrarental</h5>
                <button type="button" class="btn-close btn-close shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <!-- sidebar body -->
            <div class="offcanvas-body d-flex flex-column flex-lg-row p-4 p-lg-0">
                <ul class="navbar-nav justify-content-center align-items-center fs-6 flex-grow-1 pe-3">
                    <li class="nav-item mx-2">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="AboutRental/About.php">About rental</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="Contact/contact.php">Contact</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="Pesanan/historypem.php">Pemesanan</a>
                    </li>
                </ul>
                <div class="d-flex flex-column flex-lg-row justify-content-center align-items-center gap-3">
                    <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'user'): ?>
                        <!-- Jika pengguna sudah login -->
                        <div class="dropdown">
                            <img src="imgprofil/su.jpg" alt="" class="profile-img dropdown-toggle" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="profil/profile.php">Profil</a></li>
                                <li><a class="dropdown-item text-danger" href="Login/logout.php">Logout</a></li>
                            </ul>
                        </div>
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

    <!-- History Pemesanan -->
    <div class="container mt-5 pt-5">
        <h2 class="text-center mb-4">History Pemesanan</h2>
        
        <?php if (!empty($pemesananList)): ?>
            <?php foreach ($pemesananList as $pemesanan): ?>
                <?php 
                    // Pastikan bahwa metode getMobil() mengembalikan objek Mobil
                    $mobil = $pemesanan->getMobil($conn); 
                    // Cek jika mobil ada, jika tidak, lanjutkan ke pemesanan berikutnya
                    if (!$mobil) {
                        continue; 
                    }
                ?>
                <div class="row mb-4 border-bottom pb-4">
                    <!-- Informasi Pemesanan Kiri -->
                    <div class="col-md-6">
                        <h5><?= htmlspecialchars($mobil->getNama(), ENT_QUOTES, 'UTF-8'); ?></h5>
                        <p><strong>Status:</strong> <?= htmlspecialchars($pemesanan->status, ENT_QUOTES, 'UTF-8'); ?></p>
                        <p><strong>Harga:</strong> Rp <?= number_format($pemesanan->harga, 0, ',', '.'); ?></p>
                        <p><strong>Masa Sewa:</strong> <?= htmlspecialchars($pemesanan->masa_sewa, ENT_QUOTES, 'UTF-8'); ?> Hari</p>
                        <p><strong>Tanggal Mulai:</strong> <?= htmlspecialchars($pemesanan->tanggal_mulai, ENT_QUOTES, 'UTF-8'); ?></p>
                        <p><strong>Tanggal Selesai:</strong> <?= htmlspecialchars($pemesanan->tanggal_selesai, ENT_QUOTES, 'UTF-8'); ?></p>
                        <p><strong>Paket Sewa:</strong> <?= htmlspecialchars($pemesanan->paket_sewa, ENT_QUOTES, 'UTF-8'); ?> Jam</p>
                        <p><strong>Dengan Sopir:</strong> <?= ($pemesanan->sopir == 'iya') ? 'Ya' : 'Tidak'; ?></p>
                    </div>
                    
                    <!-- Gambar Mobil Kanan -->
                    <div class="col-md-6">
                        <img src="../Foto/<?= htmlspecialchars($mobil->getGambar(), ENT_QUOTES, 'UTF-8'); ?>" alt="<?= htmlspecialchars($mobil->getNama(), ENT_QUOTES, 'UTF-8'); ?>" class="img-fluid rounded">
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">Belum ada pemesanan yang dilakukan.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
