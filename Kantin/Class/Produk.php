<?php
require_once '../../config/koneksi.php';
class Produks{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function createProduk($namaProduk, $kategori,$stok,$hargaJual)
    {
        $query = "INSERT INTO produk (NAMA_PRODUK,KATEGORI,STOK,HARGA_JUAL) VALUES ('$namaProduk','$kategori','$stok','$hargaJual')";
        $result = $this->db->conn->query($query);

        return $result;
    }

    public function updateProduk($id, $namaProduk, $kategori,$stok,$hargaJual)
    {
        $query = "UPDATE produk SET NAMA_PRODUK = '$namaProduk', KATEGORI = '$kategori', STOK = '$stok', HARGA_JUAL = '$hargaJual' WHERE ID_PRODUK = '$id'";
        $result = $this->db->conn->query($query);

        return $result;
    }

    public function deleteProduk($id)
    {
        $query = "DELETE FROM produk WHERE ID_PRODUK = '$id'";
        $result = $this->db->conn->query($query);

        return $result;
    }

    public function readProduk()
    {
        $query = "SELECT * FROM produk";
        $result = $this->db->conn->query($query);

        $data = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function readProdukById($id)
    {
        $query = "SELECT * FROM produk WHERE ID_PRODUK = '$id'";
        $result = $this->db->conn->query($query);
        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
}