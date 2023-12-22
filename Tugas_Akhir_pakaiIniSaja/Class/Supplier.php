<?php
require_once '../../config/koneksi.php';
class Suppliers{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function createSupplier($namaSupplier,$noTelp){
        $query = "INSERT INTO supplier (NAMA_SUPPLIER,NO_TELP) VALUES ('$namaSupplier','$noTelp')";
        $result = $this->db->conn->query($query);

        return $result;
    }

    public function updateSupplier($id,$namaSupplier,$noTelp)
    {
        $query = "UPDATE supplier SET NAMA_SUPPLIER = '$namaSupplier', NO_TELP = '$noTelp' WHERE ID_SUPPLIER = '$id'";
        $result = $this->db->conn->query($query);

        return $result;
    }

    public function deleteSupplier($id)
    {
        include 'Produk.php';
        $produk = new Produks();
        $selectIdProduk = "SELECT ID_PRODUK FROM transaksi_supplier WHERE ID_SUPPLIER = '$id'";
        $resultIdProduk = $this->db->conn->query($selectIdProduk);
        $dataProduk = [];
        
        $queryDeleteTransaksiSupplier = "DELETE FROM transaksi_supplier WHERE ID_SUPPLIER = '$id'";
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
        $queryDeleteSupplier = "DELETE FROM supplier WHERE ID_SUPPLIER = '$id'";
        $resultDeleteSupplier = $this->db->conn->query($queryDeleteSupplier);

        if (!$resultDeleteSupplier) {
            throw new Exception("Error menghapus supplier: " . $this->db->conn->error);
        }

        return $this->db->conn->query($queryDeleteSupplier);
    }

    public function readSupplier()
    {
        $query = "SELECT * FROM supplier";
        $result = $this->db->conn->query($query);

        $data = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function searchProduk(){
        $query = "SELECT s.ID_SUPPLIER, s.NAMA_SUPPLIER, s.NO_TELP, p.NAMA_BARANG
        FROM supplier s
        JOIN transaksi_supplier ts ON s.ID_SUPPLIER = ts.ID_SUPPLIER
        JOIN produk p ON ts.ID_PRODUK = p.ID_PRODUK";
        $result = $this->db->conn->query($query);

        return $result;
    }
}