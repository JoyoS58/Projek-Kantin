<?php
// include 'Produk.php';
class Retur
{
    private $db;

    public function __construct()
    {
        // Menginisialisasi koneksi database
        $this->db = new Database(); // Sesuaikan dengan implementasi koneksi database Anda
    }

    public function tambahTransaksi($idProduk, $idSupplier, $hargaSupplier, $jumlahProduk)
    {
        $idProduk = $this->db->escapeString($idProduk);
        $idSupplier = $this->db->escapeString($idSupplier);
        $hargaSupplier = $this->db->escapeString($hargaSupplier);
        $jumlahProduk = $this->db->escapeString($jumlahProduk);

        $queryQty = "SELECT SUM(QTY) AS TOTAL_QTY FROM detail_transaksi WHERE ID_PRODUK = '$idProduk'";
        $resultQty = $this->db->executeQuery($queryQty);
        $rowQty = $resultQty->fetch_assoc();
        $totalQty = $rowQty['TOTAL_QTY'];

        // Hitung nilai RETURNS
        $returnsValue = $hargaSupplier * $totalQty;

        $query = "INSERT INTO transaksi_supplier (ID_PRODUK, ID_SUPPLIER, HARGA_SUPPLIER, JUMLAH_PRODUK, TGL_SUPPLY, RETURNS)
                VALUES ('$idProduk', '$idSupplier', '$hargaSupplier', '$jumlahProduk', CURDATE(), '$returnsValue')";

        return $this->db->executeQuery($query);
    }

    public function ambilTransaksi($idTransaksiSupplier)
    {
        $idTransaksiSupplier = $this->db->escapeString($idTransaksiSupplier);

        $query = "SELECT * FROM transaksi_supplier WHERE ID_PRODUK = '$idTransaksiSupplier'";
        $result = $this->db->executeQuery($query);

        return $result->fetch_assoc();
    }

    public function updateTransaksi($idProduk, $hargaSupplier, $jumlahProduk)
    {
        $idProduk = $this->db->escapeString($idProduk);
        $hargaSupplier = $this->db->escapeString($hargaSupplier);
        $jumlahProduk = $this->db->escapeString($jumlahProduk);

        $queryQty = "SELECT SUM(QTY) AS TOTAL_QTY FROM detail_transaksi WHERE ID_PRODUK = '$idProduk'";
        $resultQty = $this->db->executeQuery($queryQty);
        $rowQty = $resultQty->fetch_assoc();
        $totalQty = $rowQty['TOTAL_QTY'];

        // Hitung nilai RETURNS
        $returnsValue = $hargaSupplier * $totalQty;

        $query = "UPDATE transaksi_supplier
                  SET HARGA_SUPPLIER = '$hargaSupplier', JUMLAH_PRODUK = '$jumlahProduk', RETURNS = '$returnsValue'
                  WHERE ID_PRODUK = '$idProduk'";

        return $this->db->executeQuery($query);
    }

    public function hapusTransaksi($idTransaksiSupplier)
    {
        include 'Produk.php';
        $produk = new Produks();
        $selectIdProduk = "SELECT ID_PRODUK FROM transaksi_supplier WHERE ID_SUPPLIER = '$idTransaksiSupplier'";
        $resultIdProduk = $this->db->conn->query($selectIdProduk);
        $dataProduk = [];
        
        $queryDeleteTransaksiSupplier = "DELETE FROM transaksi_supplier WHERE ID_SUPPLIER = '$idTransaksiSupplier'";
        $resultDeleteTransaksiSupplier = $this->db->conn->query($queryDeleteTransaksiSupplier);
        if ($resultIdProduk->num_rows > 0) {
            while ($rowProduk = $resultIdProduk->fetch_assoc()) {
                $dataProduk[] = $rowProduk['ID_PRODUK'];
            }

            // Delete each product
            foreach ($dataProduk as $idProduk) {
                $produk->deleteProduk($idProduk);
            }
        }

        // Finally, delete from supplier
        $queryDeleteSupplier = "DELETE FROM supplier WHERE ID_SUPPLIER = '$idTransaksiSupplier'";
        $resultDeleteSupplier = $this->db->conn->query($queryDeleteSupplier);

        if (!$resultDeleteSupplier) {
            throw new Exception("Error menghapus supplier: " . $this->db->conn->error);
        }

        return $this->db->executeQuery($resultDeleteSupplier);
    }

    private function escapeString($value)
    {
        return $this->db->escapeString($value);
    }
}

?>
