<?php
session_start();

// Periksa apakah pengguna sudah login
$isLoggedIn = isset($_SESSION['user_id']) && $_SESSION['role'] === 'user';

// penghubungan
require_once "../DB/zahra.php";

// Kelas untuk mengelola data mobil
class Mobil {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getMobilById($id) {
        $sql = "
            SELECT lm.id, lm.nama, lm.tipe, lm.harga, lm.gambar, 
                   dm.deskripsi, dm.spesifikasi, dm.stok
            FROM list_mobil lm
            LEFT JOIN detail_mobil dm ON lm.id = dm.id_mobil
            WHERE lm.id = ?
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}

// Inisialisasi koneksi database dan kelas mobil
$database = new Database();
$conn = $database->getConnection();
$mobilModel = new Mobil($conn);

// Ambil ID mobil dari URL
$id_mobil = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Ambil data mobil berdasarkan ID
$mobil = $mobilModel->getMobilById($id_mobil);

if (!$mobil) {
    echo "Mobil tidak ditemukan.";
    $database->closeConnection();
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Mobil - <?= htmlspecialchars($mobil['nama']); ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/detail.css">
</head>
<body>
    <!-- Detail Mobil -->
    <div class="container detail-container">
        <div class="row">
            <!-- Gambar Mobil -->
            <div class="col-md-6 text-center">
                <img src="../Foto/<?= htmlspecialchars($mobil['gambar']); ?>" alt="<?= htmlspecialchars($mobil['nama']); ?>" class="img-fluid rounded">
            </div>
            
            <!-- Detail Mobil -->
            <div class="col-md-6">
                <h2><?= htmlspecialchars($mobil['nama']); ?></h2>
                <p><strong>Tipe:</strong> <?= htmlspecialchars($mobil['tipe']); ?></p>
                <p><strong>Harga:</strong> Rp <?= number_format($mobil['harga'], 0, ',', '.'); ?></p>
                <p><strong>Stok:</strong> <?= htmlspecialchars($mobil['stok']); ?> unit</p>
                <p><strong>Deskripsi:</strong> <?= nl2br(htmlspecialchars($mobil['deskripsi'])); ?></p>
                <p><strong>Spesifikasi:</strong> <?= nl2br(htmlspecialchars($mobil['spesifikasi'])); ?></p>
                <a href="../Final.php" class="btn btn-secondary">Kembali</a>
                <a href="../booking/Booking.php?id=<?= $id_mobil; ?>" class="btn btn-primary">Pesan Sekarang</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$database->closeConnection();
?>
