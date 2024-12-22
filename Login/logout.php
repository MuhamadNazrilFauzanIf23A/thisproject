<?php
session_start();

// Menghapus session user
session_unset();
session_destroy();

// Mengarahkan pengguna kembali ke halaman awal/dashboard
header("Location: ../Final.php");  // Sesuaikan dengan URL halaman dashboard awal Anda
exit;
?>
