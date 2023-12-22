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
    public function getLastInsertedId() {
        return $this->db->conn->insert_id;
    }

    public function updateProduk($id, $namaProduk, $kategori,$stok,$hargaJual)
    {
        $query = "UPDATE produk SET NAMA_PRODUK = '$namaProduk', KATEGORI = '$kategori', STOK = '$stok', HARGA_JUAL = '$hargaJual' WHERE ID_PRODUK = '$id'";
        $result = $this->db->conn->query($query);

        return $result;
    }

    public function deleteProduk($id)
{
    // Get ID_TRANSAKSI from DETAIL_TRANSAKSI
    $selectIdDetail = "SELECT ID_TRANSAKSI FROM DETAIL_TRANSAKSI WHERE ID_PRODUK = '$id'";
    $result = $this->db->conn->query($selectIdDetail);
    $data = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row['ID_TRANSAKSI'];
        }

        // Delete from DETAIL_TRANSAKSI
        $queryDeleteDetail = "DELETE FROM DETAIL_TRANSAKSI WHERE ID_TRANSAKSI = '$data[0]'";
        $resultDeleteDetail = $this->db->conn->query($queryDeleteDetail);
        
        if ($resultDeleteDetail) {
            // Delete from TRANSAKSI
            foreach ($data as $idTransaksi) {
                $queryDeleteTransaksi = "DELETE FROM TRANSAKSI WHERE ID_TRANSAKSI = '$idTransaksi'";
                $resultDeleteTransaksi = $this->db->conn->query($queryDeleteTransaksi);

                if (!$resultDeleteTransaksi) {
                    echo "Error menghapus transaksi: " . $this->db->conn->error;
                    // Stop the loop if there's an error
                    break;
                }
            }

            // Delete from TRANSAKSI_SUPPLIER
            $queryDeleteSupplier = "DELETE FROM TRANSAKSI_SUPPLIER WHERE ID_PRODUK = '$id'";
            $resultDeleteSupplier = $this->db->conn->query($queryDeleteSupplier);

            if ($resultDeleteSupplier) {
                // Finally, delete from PRODUK
                $queryDeleteProduk = "DELETE FROM produk WHERE ID_PRODUK = '$id'";
                $resultDeleteProduk = $this->db->conn->query($queryDeleteProduk);

                if ($resultDeleteProduk) {
                    return true;
                } else {
                    echo "Error menghapus produk: " . $this->db->conn->error;
                    return false;
                }
            } else {
                echo "Error menghapus transaksi supplier: " . $this->db->conn->error;
                return false;
            }
        } else {
            echo "Error menghapus detail transaksi: " . $this->db->conn->error;
            return false;
        }
    } else {
        // If there are no related transactions, just delete from PRODUK
        $queryDeleteProduk = "DELETE FROM produk WHERE ID_PRODUK = '$id'";
        $resultDeleteProduk = $this->db->conn->query($queryDeleteProduk);

        if ($resultDeleteProduk) {
            return true;
        } else {
            echo "Error menghapus produk: " . $this->db->conn->error;
            return false;
        }
    }
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