<?php

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
        $idTransaksiSupplier = $this->db->escapeString($idTransaksiSupplier);

        $query = "DELETE FROM transaksi_supplier WHERE ID_TRANSAKSI_SUPPLIER = '$idTransaksiSupplier'";

        return $this->db->executeQuery($query);
    }

    private function escapeString($value)
    {
        return $this->db->escapeString($value);
    }
}

?>
