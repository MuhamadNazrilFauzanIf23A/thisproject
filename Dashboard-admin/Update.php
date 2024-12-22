<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "zahrarental");

if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit;
}

// Fungsi Hapus Data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM list_mobil WHERE id='$id'");

    header("Location: Update.php");
    exit; // Tambahkan exit untuk memastikan redirect berhenti di sini
}

// Ambil data mobil dengan JOIN detail_mobil
$query = "SELECT list_mobil.id, list_mobil.nama, list_mobil.tipe, list_mobil.harga, list_mobil.gambar, 
                 detail_mobil.deskripsi, detail_mobil.spesifikasi, detail_mobil.stok 
          FROM list_mobil 
          LEFT JOIN detail_mobil ON list_mobil.id = detail_mobil.id_mobil";
$dataMobil = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mobil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: #fff;
        }
        .btn {
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            color: #fff;
            text-decoration: none;
        }
        .btn-edit {
            background-color: #007bff;
        }
        .btn-hapus {
            background-color: #dc3545;
        }
        .btn-tambah {
            background-color: #28a745;
            display: inline-block;
            margin-left: 0;
            margin: 20px;
            color: #fff;
            text-decoration: none;
            padding: 10px 10px;
            border-radius: 5px;
        }
        img {
            width: 100px;
            height: auto;
        }

        /* Responsive Styles - Menjadi Kartu pada Layar Kecil */
        @media screen and (max-width: 768px) {
            table, thead, tbody, th, td, tr {
                display: block;
            }
            thead {
                display: none; /* Sembunyikan header */
            }
            tr {
                margin-bottom: 15px;
                border: 1px solid #ddd;
                border-radius: 10px;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                padding: 10px;
                background-color: #fff;
            }
            td {
                display: flex;
                justify-content: space-between;
                padding: 10px;
            }
            td::before {
                content: attr(data-label); /* Gunakan label untuk setiap kolom */
                font-weight: bold;
                color: #333;
            }
            img {
                display: block;
                margin: 0 auto 10px auto;
                width: 70px;
            }
            .btn {
                display: inline-block;
                margin: 5px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
<div class="header">
    <a href="admin.php" style="color: #fff; text-decoration: none;">
        <h1>Daftar Mobil</h1>
    </a>
</div>
    <a href="tambahmobil.php" class="btn btn-tambah">Tambah</a>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Nama Mobil</th>
                <th>Tipe</th>
                <th>Harga</th>
                <th>Deskripsi</th>
                <th>Spesifikasi</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; while ($row = mysqli_fetch_assoc($dataMobil)) { ?>
                <tr>
                    <td data-label="No"><?= $no++; ?></td>
                    <td data-label="Gambar">
                        <img src="../Foto/<?= $row['gambar']; ?>" alt="Gambar Mobil">
                    </td>
                    <td data-label="Nama Mobil"><?= $row['nama']; ?></td>
                    <td data-label="Tipe"><?= $row['tipe']; ?></td>
                    <td data-label="Harga"><?= number_format($row['harga']); ?></td>
                    <td data-label="Deskripsi"><?= $row['deskripsi']; ?></td>
                    <td data-label="Spesifikasi"><?= $row['spesifikasi']; ?></td>
                    <td data-label="Stok"><?= $row['stok']; ?></td>
                    <td data-label="Aksi">
                        <a href="editmobil.php?id=<?= $row['id']; ?>" class="btn btn-edit">Edit</a>
                        <a href="?hapus=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin hapus?');" class="btn btn-hapus">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
