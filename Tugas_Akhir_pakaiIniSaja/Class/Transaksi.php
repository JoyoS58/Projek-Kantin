<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require 'StokBarang.php';
require '../config/koneksi.php';

class Transaksi {
    private $db;

    public function __construct()
    {
        $this->db = new Database();
        $this->stokBarang = new StokBarang();
    }

    // ... (fungsi-fungsi transaksi lainnya)

    public function updateTransaksi($amountPaid, $paymentMethod)
    {
        $id_transaksi = $_SESSION['id_transaksi'];

        $query = "UPDATE TRANSAKSI SET jenis_pembayaran = '$paymentMethod', jumlah_bayar = '$amountPaid', sisa_bayar = '$amountPaid' - TOTAL_HARGA WHERE ID_TRANSAKSI = '$id_transaksi'";
        
        $result = $this->db->executeQuery($query);

        if ($result) {
            echo "Pemrosesan update transaksi berhasil.";
        } else {
            echo "Error: " . $this->db->connection->error;
        }
    }

    public function hapusTransaksi($id_transaksi) {
        // Ambil data transaksi sebelum dihapus
        $transaksi_sebelum_hapus = $this->ambilDataTransaksi($id_transaksi);
    
        // Hapus detail transaksi
        $queryDetailTransaksi = "DELETE FROM DETAIL_TRANSAKSI WHERE ID_TRANSAKSI = '$id_transaksi'";
        $resultDetailTransaksi = $this->db->executeQuery($queryDetailTransaksi);
    
        // Hapus transaksi
        $queryTransaksi = "DELETE FROM TRANSAKSI WHERE ID_TRANSAKSI = '$id_transaksi'";
        $resultTransaksi = $this->db->executeQuery($queryTransaksi);
    
        if ($resultDetailTransaksi && $resultTransaksi) {
            // Transaksi berhasil dihapus, kembalikan stok barang ke nilai awal
            $this->kembalikanStokBarang($transaksi_sebelum_hapus);
    
            return true;
        } else {
            return false;
        }
    }
    
    private function ambilDataTransaksi($id_transaksi) {
        // Implementasikan pengambilan data transaksi berdasarkan ID_TRANSAKSI
        // Sesuaikan dengan struktur tabel dan kebutuhan aplikasi Anda
    
        $query = "SELECT * FROM TRANSAKSI WHERE ID_TRANSAKSI = '$id_transaksi'";
        $resultTransaksi = $this->db->executeQuery($query);
    
        if ($resultTransaksi->num_rows == 1) {
            $transaksi = $resultTransaksi->fetch_assoc();
    
            // Ambil detail transaksi
            $queryDetail = "SELECT * FROM DETAIL_TRANSAKSI WHERE ID_TRANSAKSI = '$id_transaksi'";
            $resultDetail = $this->db->executeQuery($queryDetail);
    
            $detail_transaksi = [];
    
            while ($detail = $resultDetail->fetch_assoc()) {
                $detail_transaksi[] = $detail;
            }
    
            $transaksi['detail_transaksi'] = $detail_transaksi;
    
            return $transaksi;
        } else {
            return null; // Atau implementasikan cara penanganan ketika transaksi tidak ditemukan
        }
    }

    public function hapusTransaksiByBarang($id_barang)
    {
        // Ambil data transaksi sebelum dihapus
        $transaksi_sebelum_hapus = $this->ambilDataTransaksiByBarang($id_barang);

        // Hapus detail transaksi
        $queryDetailTransaksi = "DELETE FROM DETAIL_TRANSAKSI WHERE ID_PRODUK = '$id_barang'";
        $resultDetailTransaksi = $this->db->executeQuery($queryDetailTransaksi);

        // Hapus transaksi
        $queryTransaksi = "DELETE FROM TRANSAKSI WHERE ID_TRANSAKSI = '{$transaksi_sebelum_hapus['ID_TRANSAKSI']}'";
        $resultTransaksi = $this->db->executeQuery($queryTransaksi);

        if ($resultDetailTransaksi && $resultTransaksi) {
            // Transaksi berhasil dihapus, kembalikan stok barang ke nilai awal
            $this->kembalikanStokBarang($transaksi_sebelum_hapus);

            echo "Transaksi berhasil dihapus berdasarkan ID Barang.";
        } else {
            echo "Error: " . $this->db->connection->error;
        }
    }

    private function ambilDataTransaksiByBarang($id_barang)
    {
        // Implementasikan pengambilan data transaksi berdasarkan ID_PRODUK
        // Sesuaikan dengan struktur tabel dan kebutuhan aplikasi Anda

        $query = "SELECT t.ID_TRANSAKSI, t.TGL_TRANSAKSI 
                  FROM DETAIL_TRANSAKSI dt
                  INNER JOIN TRANSAKSI t ON dt.ID_TRANSAKSI = t.ID_TRANSAKSI
                  WHERE dt.ID_PRODUK = '$id_barang'";
        $resultTransaksi = $this->db->executeQuery($query);

        if ($resultTransaksi->num_rows == 1) {
            return $resultTransaksi->fetch_assoc();
        } else {
            return null; // Atau implementasikan cara penanganan ketika transaksi tidak ditemukan
        }
    }
    
    
    private function kembalikanStokBarang($transaksi) {
        // Kembalikan stok barang ke nilai awal sebelum transaksi dilakukan
        foreach ($transaksi['detail_transaksi'] as $detail) {
            $id_barang = $detail['ID_PRODUK']; // Ubah ke 'id_produk'
            $stok_awal = $_SESSION['stok_awal'][$id_barang];
    
            // Update stok barang di database dengan nilai stok awal
            $this->stokBarang->updateStokBarang($id_barang, $stok_awal);
        }
    }    
}
class SearchBarang
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function searchBarang($keyword)
    {
        $keyword = $this->db->escapeString($keyword);

        $query = "SELECT * FROM PRODUK WHERE NAMA_PRODUK LIKE '%$keyword%'";
        $result = $this->db->executeQuery($query);

        while ($row = $result->fetch_assoc()) {
            echo '<div class="result-item" onclick="pilihBarang(' . $row['ID_PRODUK'] . ', \'' . $row['NAMA_PRODUK'] . '\', \'' . $row['HARGA_JUAL'] . '\')">' . $row['NAMA_PRODUK'] . '</div>';
        }
    }
}
class PilihBarang
{
    private $db;
    private $stokBarang;

    public function __construct()
    {
        $this->db = new Database();
        $this->stokBarang = new StokBarang();
    }

    public function pilihBarang($selectedProducts, $totalHarga, $idUser)
    {
        $queryTransaksi = "INSERT INTO TRANSAKSI (ID_user, jenis_pembayaran, tgl_transaksi, TOTAL_HARGA) VALUES ('$idUser', 'QRis', CURDATE(), '$totalHarga')";
        $resultTransaksi = $this->db->executeQuery($queryTransaksi);

        if ($resultTransaksi) {
            $id_transaksi = $this->db->conn->insert_id;
            $_SESSION['id_transaksi'] = $id_transaksi;

            foreach ($selectedProducts as $product) {
                $id_barang = $product['id_barang'];
                $qty = $product['qty'];
                $harga_barang = $product['harga_barang'];

                $queryDetailTransaksi = "INSERT INTO DETAIL_TRANSAKSI (ID_PRODUK, ID_TRANSAKSI, QTY, HARGA, SUB_TOTAL) VALUES ('$id_barang', '$id_transaksi', '$qty', '$harga_barang', '$qty' * '$harga_barang')";
                $this->db->executeQuery($queryDetailTransaksi);
            }

            $_SESSION['selected_products'] = $selectedProducts;

            // Kurangi stok barang
            $this->stokBarang->kurangiStokBarang($selectedProducts);
            
            echo "Pemrosesan pilihan barang berhasil. Total Harga: $totalHarga";
        } else {
            echo "Error: " . $this->db->connection->error;
        }
    }

    // Metode lainnya
}

//  indexindexindexindexindexindexindexindex
//  indexindexindexindexindexindexindexindex


?>
