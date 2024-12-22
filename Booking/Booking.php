<?php
session_start();

// Periksa apakah pengguna sudah login
$isLoggedIn = isset($_SESSION['user_id']) && $_SESSION['role'] === 'user';
if (!$isLoggedIn) {
    header('Location: ../Login/loginnew.php');
    exit;
}

// Koneksi ke database
require '../DB/Dbzahra.php';

// Ambil ID pengguna dari session
$userId = $_SESSION['user_id'];

// Ambil ID mobil dari parameter URL
$idMobil = isset($_GET['id']) ? (int)$_GET['id'] : 1; // Ambil ID mobil dari URL

// Query untuk mengambil data mobil berdasarkan ID
$sql = "SELECT * FROM list_mobil WHERE id = $idMobil";
$result = $conn->query($sql);

// Jika data mobil ditemukan
if ($result && $result->num_rows > 0) {
    $mobil = $result->fetch_assoc();
    $harga6jam = $mobil['harga_per6jam'];
    $harga12jam = $mobil['harga_per12jam'];
    $harga24jam = $mobil['harga_per24jam'];
} else {
    echo "Mobil tidak ditemukan.";
    exit;
}

if (isset($_POST['submit'])) {
    // Ambil data dari form
    $tanggalMulai = $_POST['tanggalMulai'];
    $masaSewa = $_POST['masaSewa'];
    $paketSewa = $_POST['paketSewa'];
    $sopir = $_POST['sopir'];
    
    // Hitung harga berdasarkan paket sewa yang dipilih
    $hargaPerPaket = 0;
    if ($paketSewa == '6') {
        $hargaPerPaket = $harga6jam;
    } elseif ($paketSewa == '12') {
        $hargaPerPaket = $harga12jam;
    } elseif ($paketSewa == '24') {
        $hargaPerPaket = $harga24jam;
    }
    
    // Hitung total harga berdasarkan paket dan masa sewa
    $totalHarga = $hargaPerPaket * $masaSewa;

    // Jika menyewa sopir, tambahkan biaya sopir
    if ($sopir == 'iya') {
        $hargaSopir = 100000 * $masaSewa;  // Harga sopir untuk 6 jam
        $totalHarga += $hargaSopir;
    }

    // Proses unggahan file bukti transfer
    if (isset($_FILES['bukti'])) {
        // Direktori tempat file akan disimpan
        $uploadDir = 'uploads/';

        // Nama file sementara
        $fileTmpName = $_FILES['bukti']['tmp_name'];

        // Nama file yang akan disimpan di server
        $fileName = basename($_FILES['bukti']['name']);
        
        // Menentukan path lengkap untuk file yang akan disimpan
        $uploadFilePath = $uploadDir . $fileName;

        // Memindahkan file dari folder sementara ke direktori tujuan
        if (move_uploaded_file($fileTmpName, $uploadFilePath)) {
            // File berhasil diunggah, simpan nama file ke dalam database

            // Query untuk menyimpan data pemesanan ke tabel pemesanan
            $sqlPemesanan = "INSERT INTO pemesanan (user_id, id_mobil, tanggal_mulai, tanggal_selesai, masa_sewa, paket_sewa, harga, sopir, file_unggahan, status)
                             VALUES ($userId, $idMobil, '$tanggalMulai', DATE_ADD('$tanggalMulai', INTERVAL $masaSewa DAY), $masaSewa, '$paketSewa', $totalHarga, '$sopir', '$fileName', 'pending')";
            
            if ($conn->query($sqlPemesanan) === TRUE) {
                // Setelah pemesanan berhasil, alihkan ke halaman utama (index.php atau halaman lainnya)
                header("Location: ../Final.php"); // Ganti dengan halaman utama yang diinginkan
                exit;
            } else {
                echo "Error: " . $sqlPemesanan . "<br>" . $conn->error;
            }
        } else {
            echo "Gagal mengunggah bukti transfer.";
        }
    } else {
        echo "Bukti transfer belum diunggah.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Booking - Zahrarental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" />
    <script>
    // Fungsi untuk memperbarui total harga
    function updateTotalHarga() {
        const paketSewa = document.getElementById('paketSewa').value;
        const masaSewa = document.getElementById('masaSewa').value;
        const sopir = document.getElementById('sopir').value;
        let hargaPerPaket = 0;
        let hargaSopir = 0;

        // Pilih harga per paket berdasarkan pilihan pengguna
        if (paketSewa === '6') {    
            hargaPerPaket = <?= $harga6jam; ?>;
        } else if (paketSewa === '12') {
            hargaPerPaket = <?= $harga12jam; ?>;
        } else if (paketSewa === '24') {
            hargaPerPaket = <?= $harga24jam; ?>;
        }

        // Tentukan harga sopir per paket berdasarkan pilihan pengguna
        if (sopir === 'iya') {
            let hargaSopirPerPaket = 100000; // Harga sopir untuk 6 jam
            if (paketSewa === '12') {
                hargaSopir = 150000 * masaSewa;  // Harga sopir untuk 12 jam
            } else if (paketSewa === '6') {
                hargaSopir = 100000 * masaSewa; // Untuk 6 jam
            } else if (paketSewa === '24') {
                hargaSopir = 250000 * masaSewa;  // Untuk 24 jam
            }
        }

        // Hitung total harga
        if (hargaPerPaket > 0 && masaSewa > 0) {
            const totalHarga = (hargaPerPaket * masaSewa) + hargaSopir;
            document.getElementById('totalHarga').innerText = 'Rp ' + totalHarga.toLocaleString();
        } else {
            document.getElementById('totalHarga').innerText = 'Rp 0';
        }
    }

    function updateTanggalSelesai() {
        const tanggalMulaiInput = document.getElementById('tanggalMulai');
        const masaSewaInput = document.getElementById('masaSewa');
        const tanggalSelesaiInput = document.getElementById('tanggalSelesai');

        const tanggalMulai = new Date(tanggalMulaiInput.value);
        const masaSewa = parseInt(masaSewaInput.value);

        if (tanggalMulai && masaSewa) {
            // Hitung tanggal selesai berdasarkan masa sewa
            const tanggalSelesai = new Date(tanggalMulai);
            tanggalSelesai.setDate(tanggalSelesai.getDate() + masaSewa);

            // Format tanggal selesai menjadi string (YYYY-MM-DD)
            const formattedTanggalSelesai = tanggalSelesai.toISOString().split('T')[0];
            tanggalSelesaiInput.value = formattedTanggalSelesai;
        }
    }
</script>



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
                            <a class="nav-link" href="../Pesanan/historypem.php">Pemesanan</a>
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
                            <a href="../Login/loginnew.php" class="text-black">Login</a>
                            <a href="../Login/register.php" class="text-white text-decoration-none px-3 py-1 bg-primary rounded-4">Sign up</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Formulir Pendaftaran Booking -->
    <div class="container mt-5 pt-5">
        <h2 class="text-center mb-4">Pendaftaran Booking</h2>
        <form action="" method="POST" enctype="multipart/form-data">

            <!-- Sopir -->
            <div class="mb-3">
                <label for="sopir" class="form-label">Pakai Sopir / Tidak</label>
                <select class="form-select" id="sopir" name="sopir" required onchange="updateTotalHarga()">
                    <option value="">Pilih opsi</option>
                    <option value="iya">Iya = 100.000</option>
                    <option value="tidak">Tidak</option>
                </select>
            </div>

            <!-- Masa Sewa -->
            <div class="mb-3">
                <label for="masaSewa" class="form-label">Masa Sewa</label>
                <select class="form-select" id="masaSewa" name="masaSewa" required onchange="updateTanggalSelesai()">
                    <option value="">Pilih masa sewa</option>
                    <option value="1">1 Hari</option>
                    <option value="2">2 Hari</option>
                    <option value="3">3 Hari</option>
                    <option value="4">4 Hari</option>
                </select>   
            </div>

            <!-- Paket Sewa -->
            <div class="mb-3">
                <label for="paketSewa" class="form-label">Paket Sewa</label>
                <select class="form-select" id="paketSewa" name="paketSewa" required onchange="updateTotalHarga()">
                    <option value="">Pilih paket sewa</option>
                    <option value="6">6 Jam (Rp <?= number_format($harga6jam, 0, ',', '.'); ?>)</option>
                    <option value="12">12 Jam (Rp <?= number_format($harga12jam, 0, ',', '.'); ?>)</option>
                    <option value="24">24 Jam (Rp <?= number_format($harga24jam, 0, ',', '.'); ?>)</option>
                </select>
            </div>

            <!-- Tanggal Mulai -->
            <div class="mb-3">
                <label for="tanggalMulai" class="form-label">Tanggal Mulai</label>
                <input type="date" class="form-control" id="tanggalMulai" name="tanggalMulai" required onchange="updateTanggalSelesai()" min="<?php echo date('Y-m-d'); ?>">
            </div>

            <!-- Tanggal Selesai -->
            <div class="mb-3">
                <label for="tanggalSelesai" class="form-label">Tanggal Selesai</label>
                <input type="text" class="form-control" id="tanggalSelesai" name="tanggalSelesai" readonly>
            </div>

            <!-- Waktu Pengambilan -->
            <div class="mb-3">
                <label for="waktuPengambilan" class="form-label">Waktu Pengambilan</label>
                <input type="time" class="form-control" id="waktuPengambilan" name="waktuPengambilan" required>
            </div>

            <!-- Metode Pembayaran -->
        <div class="mb-3">
            <label for="payment" class="form-label">Metode Pembayaran</label>
                <select class="form-select" id="payment" name="payment" required onchange="updatePaymentDetails()">
                    <option value="" selected>Pilih metode pembayaran</option>
                    <option value="dana">Pembayaran via Dana</option>
                    <option value="mandiri">Pembayaran via Bank Mandiri</option>
                    <option value="gopay">Pembayaran via Gopay</option>
                </select>
            </div>
            
            <!-- Informasi Tujuan Pembayaran -->
            <div class="mb-3" id="paymentDetails" style="display: none;">
                <label class="form-label">Tujuan Pembayaran</label>
                <div class="border p-3 rounded bg-light">
                    <p><strong>Nama Tujuan:</strong> <span id="paymentName"></span></p>
                    <p><strong>Nomor Rekening/ID:</strong> <span id="paymentNumber"></span></p>
                </div>
            </div>

            <!-- Total Harga -->
            <div class="mb-3">
                <label for="totalHarga" class="form-label">Total Harga</label>
                <p id="totalHarga" class="form-control">Rp 0</p>
            </div>

              <!-- Unggah Bukti Transfer -->
              <div class="mb-3">
                <label for="bukti" class="form-label">Unggah Bukti Transfer</label>
                <input type="file" class="form-control" id="bukti" name="bukti" accept="image/*,application/pdf" required>
            </div>
            
            <button type="submit" class="btn btn-primary" name="submit">Booking</button>
        </form>
    </div>
    <script src="../Js/payment.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

