<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Barang</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../components/Kasir/CSS/stylePilihBarang.css">
</head>
<body>
  <div class="container mt-5">
    <div class="canvas">
    <h1 class="text-center mb-4">Data Barang</h1>
    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="Cari barang...">
      <button class="btn btn-outline-secondary" type="button">Cari</button>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th>ID Barang</th>
          <th>Nama Barang</th>
          <th>Qty</th>
          <th>Harga</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <!-- Isi tabel disini -->
        <tr>
          <td>1</td>
          <td>Produk A</td>
          <td>10</td>
          <td>$100</td>
          <td><input type="checkbox"></td>
        </tr>
        <!-- Tambahkan baris untuk data barang lainnya sesuai kebutuhan -->
      </tbody>
    </table>

  <div style="text-align: center;">
    <a href="bayar.php" style="display: inline-block;">
        <button class="btn btn-next">Selanjutnya >></button>
    </a>
  </div>
  </div>
  </div>
  <?php
  require 'menu.php';
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
