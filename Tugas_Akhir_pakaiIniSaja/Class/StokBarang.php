<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// File: StokBarang.php
class StokBarang
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function kurangiStokBarang($selectedProducts)
    {
        foreach ($selectedProducts as $product) {
            $id_barang = $product['id_barang']; // Ubah ke 'id_produk'
            $qty = $product['qty'];

            // Ambil stok barang dari database
            $stok_barang = $this->ambilStokBarang($id_barang);
            $_SESSION['stok_awal'][$id_barang] = $stok_barang;
            // Kurangkan stok barang
            $stok_baru = $stok_barang - $qty;

            // Update stok barang di database
            $this->updateStokBarang($id_barang, $stok_baru);
        }
    }

    private function ambilStokBarang($id_barang)
    {
        $query = "SELECT STOK FROM PRODUK WHERE ID_PRODUK = '$id_barang'";
        $result = $this->db->executeQuery($query);
        $row = $result->fetch_assoc();

        return $row['STOK'];
    }

    public function updateStokBarang($id_barang, $stok_baru)
    {
        $query = "UPDATE PRODUK SET STOK = '$stok_baru' WHERE ID_PRODUK = '$id_barang'";
        $this->db->executeQuery($query);
    }
}
?>
