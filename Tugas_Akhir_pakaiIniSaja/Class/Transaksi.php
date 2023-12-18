<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require '../config/koneksi.php';

class UpdateTransaksi
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

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

    public function __construct()
    {
        $this->db = new Database();
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

            echo "Pemrosesan pilihan barang berhasil. Total Harga: $totalHarga";
        } else {
            echo "Error: " . $this->db->connection->error;
        }
    }
}

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    // Buat objek pilihBarang
    $pilihBarang = new PilihBarang();
    // Buat objek updateTransaksi
    $updateTransaksi = new UpdateTransaksi();
    $searchBarang = new searchBarang();

    switch ($action) {
        case 'pilihBarang':
            // Panggil metode pilihBarang
            $pilihBarang->pilihBarang($_POST['selectedProducts'], $_POST['totalHarga'], $_SESSION['user']);
            break;
        case 'updateTransaksi':
            // Panggil metode updateTransaksi
            $updateTransaksi->updateTransaksi($_POST['amountPaid'], $_POST['paymentMethod']);
            break;
        case 'searchBarang':
            $searchBarang->searchBarang($_POST['keyword']);
            break;
        // Tambahkan case lainnya jika ada lebih banyak aksi yang perlu ditangani
        default:
            echo "Aksi tidak valid.";
            break;
    }
} else {
    echo "Aksi tidak diberikan.";
}

?>
