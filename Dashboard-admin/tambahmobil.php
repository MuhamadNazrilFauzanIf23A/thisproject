<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "zahrarental");

if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit;
}

// Proses tambah data mobil
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $tipe = $_POST['tipe'];
    $harga = $_POST['harga'];
    $harga_per6jam = $_POST['harga_per6jam'];
    $harga_per12jam = $_POST['harga_per12jam'];
    $harga_per24jam = $_POST['harga_per24jam'];
    $deskripsi = $_POST['deskripsi'];
    $spesifikasi = $_POST['spesifikasi'];
    $stok = $_POST['stok'];

    // Proses upload gambar
    $gambar = $_FILES['gambar']['name'];
    $gambar_tmp = $_FILES['gambar']['tmp_name'];
    $gambar_path = "../Foto/" . $gambar;

    // Validasi upload gambar
    if (move_uploaded_file($gambar_tmp, $gambar_path)) {
        // Query untuk menyimpan data ke database, termasuk harga per jam
        $query = "INSERT INTO list_mobil (nama, tipe, harga, gambar, harga_per6jam, harga_per12jam, harga_per24jam) 
                  VALUES ('$nama', '$tipe', '$harga', '$gambar', '$harga_per6jam', '$harga_per12jam', '$harga_per24jam')";
        $result = mysqli_query($koneksi, $query);

        // Simpan data detail mobil
        if ($result) {
            $id_mobil = mysqli_insert_id($koneksi);  // Mendapatkan ID mobil yang baru dimasukkan
            $query_detail = "INSERT INTO detail_mobil (id_mobil, deskripsi, spesifikasi, stok) 
                             VALUES ('$id_mobil', '$deskripsi', '$spesifikasi', '$stok')";
            mysqli_query($koneksi, $query_detail);
            echo "<script>alert('Mobil berhasil ditambahkan!'); window.location.href = 'Update.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan mobil!');</script>";
        }
    } else {
        echo "<script>alert('Gagal mengupload gambar!');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mobil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 2px;
        }
        .form-container {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container label {
            font-size: 14px;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        .form-container input, .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-container button {
            padding: 10px 15px;
            background-color: #28a745;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            width: 100%;
        }
        .form-container button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Tambah Mobil Baru</h1>
</div>

<div class="form-container">
    <h2>Form Tambah Mobil</h2>
    <form action="tambahmobil.php" method="POST" enctype="multipart/form-data">
        <label for="gambar">Gambar Mobil:</label>
        <input type="file" id="gambar" name="gambar" required>

        <label for="nama">Nama Mobil:</label>
        <input type="text" id="nama" name="nama" required>

        <label for="tipe">Tipe Mobil:</label>
        <input type="text" id="tipe" name="tipe" required>

        <label for="harga">Harga:</label>
        <input type="number" id="harga" name="harga" required>

        <label for="harga_per6jam">Harga Per 6 Jam:</label>
        <input type="number" id="harga_per6jam" name="harga_per6jam" required>

        <label for="harga_per12jam">Harga Per 12 Jam:</label>
        <input type="number" id="harga_per12jam" name="harga_per12jam" required>

        <label for="harga_per24jam">Harga Per 24 Jam:</label>
        <input type="number" id="harga_per24jam" name="harga_per24jam" required>

        <label for="deskripsi">Deskripsi Mobil:</label>
        <textarea id="deskripsi" name="deskripsi" rows="4" required></textarea>

        <label for="spesifikasi">Spesifikasi Mobil:</label>
        <textarea id="spesifikasi" name="spesifikasi" rows="4" required></textarea>

        <label for="stok">Stok Mobil:</label>
        <input type="number" id="stok" name="stok" required>

        <button type="submit" name="submit">Tambah Mobil</button>
    </form>
</div>

</body>
</html>
