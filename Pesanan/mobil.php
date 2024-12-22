<?php
class Mobil {
    private $id;
    private $nama;
    private $tipe;
    private $harga;
    private $gambar;
    private $harga_per6jam;
    private $harga_per12jam;
    private $harga_per24jam;

    public function __construct($id, $nama, $tipe, $harga, $gambar, $harga_per6jam, $harga_per12jam, $harga_per24jam) {
        $this->id = $id;
        $this->nama = $nama;
        $this->tipe = $tipe;
        $this->harga = $harga;
        $this->gambar = $gambar;
        $this->harga_per6jam = $harga_per6jam;
        $this->harga_per12jam = $harga_per12jam;
        $this->harga_per24jam = $harga_per24jam;
    }

    public function getNama() {
        return $this->nama;
    }

    public function getGambar() {
        return $this->gambar;
    }

    public static function getMobilById($id, $conn) {
        $sql = "SELECT * FROM list_mobil WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return new Mobil(
                $row['id'],
                $row['nama'],
                $row['tipe'],
                $row['harga'],
                $row['gambar'],
                $row['harga_per6jam'],
                $row['harga_per12jam'],
                $row['harga_per24jam']
            );
        }
        return null;
    }
}
?>
