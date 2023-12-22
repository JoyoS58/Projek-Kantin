<?php
require_once '../../Class/Produk.php';
require_once  '../../Class/Supplier.php';
require_once  '../../Class/Transaksi.php';
$produk = new Produks();
$supplier = new Suppliers();
$transaksi = new Transaksi();
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
  <div class="container">

    <div class="row">

      <div class="four col-md-3">
        <div class="counter-box card-1">
          <span class="counter"><?php echo $produk->sumProduk() ?></span>
          <p>Jumlah Barang</p>
        </div>
      </div>
      <div class="four col-md-3">
        <div class="counter-box card-2">
          <span class="counter"><?php echo $supplier->sumSupplier() ?></span>
          <p>Jumlah Supplier</p>
        </div>
      </div>
      <div class="four col-md-3">
        <div class="counter-box card-3">
          <span class="counter"><?php echo $transaksi->sumTransaksi() ?></span>
          <p>Jumlah Transaksi</p>
        </div>
      </div>
      <div class="four col-md-3">
        <div class="counter-box card-4">
          <span class="counter"><?php echo $transaksi->sumBarangTerjual() ?></span>
          <p>Jumlah Barang Terjual</p>
        </div>
      </div>
    </div>
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
            $barangLaris = $transaksi->readProdukPalingLaku();
            $i = 1;
            while ($row = mysqli_fetch_assoc($barangLaris)) {
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
  <!-- Recent Sales End -->


  <?php
  require './menu.php';
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>