<?php
// require_once '../../Class/Produk.php';
// require_once  '../../Class/Supplier.php';
// require_once  '../../Class/Transaksi.php';
require_once '../../config/koneksi.php';
// $produk = new Produks();
// $supplier = new Suppliers();
// $transaksi = new Transaksi();
$database = new Database();
$conn = $database->getConnection();

$query = "SELECT COUNT(*) AS jumlah_barang FROM produk";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$jumlah_barang = $row['jumlah_barang'];

$query = "SELECT COUNT(*) AS jumlah_Supplier FROM supplier";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$jumlah_supplier = $row['jumlah_Supplier'];

$query = "SELECT COUNT(*) AS jumlah_transaksi FROM transaksi";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$jumlah_transaksi = $row['jumlah_transaksi'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman dengan Card dan Grafik</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../components/Kasir/CSS/styleHome.css">
</head>

<body>
  <div class="container mt-5">

  <div class="row">
      <div class="col-md-3">
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">Barang</h5>
            <p class="card-text">barang sejumlah <?= $jumlah_barang ?>.</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">Supplier</h5>
            <p class="card-text">Supplier sejumlah <?= $jumlah_supplier ?>.</p>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">Penjualan</h5>
            <p class="card-text">Penjualan sejumlah <?= $jumlah_transaksi ?>.</p>
          </div>
        </div>
      </div>
      <!-- <div class="col-md-3">
        <div class="card mb-3">
          <div class="card-body">
            <h5 class="card-title">Card 1</h5>
            <p class="card-text">Isi konten untuk Card 1 disini.</p>
          </div>
        </div>
      </div> -->
    </div>
    <div class="container-fluid pt-4 px-4">
      <div class="text-center rounded p-4 bungkus">
        <div class="d-flex align-items-center justify-content-between mb-4">
          <h4 class="mb-0">Barang Paling Laku</h4>
        </div>
        <div class="table-responsive">
          <table class="table text-start align-middle table-bordered table-hover mb-0">
            <thead>
              <tr class="text-white">
                <th scope="col">No</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Jumlah Terjual</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = "SELECT p.NAMA_PRODUK, SUM(dt.qty) AS total_terjual
              FROM produk p
              JOIN detail_transaksi dt ON p.id_produk = dt.id_produk
              GROUP BY p.NAMA_PRODUK
              ORDER BY total_terjual DESC
              LIMIT 5;
              ";
              $result = mysqli_query($conn, $query);
              $i = 1;
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $i . "</td>";
                echo "<td>" . $row['NAMA_PRODUK'] . "</td>";
                echo "<td>" . $row['total_terjual'] . "</td>";
                echo "</tr>";
                $i++;
              }
  
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- Recent Sales End -->


  <?php
  require './menu.php';
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>