<link rel="stylesheet" href="components/css/stylePilihBarang.css">
  <div class="container mt-5">
    <div class="canvas">
    <h1 class="text-center mb-4">Pilih Barang</h1>
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
    <a aria-current="page" href="index.php?page=kasir/bayar" style="display: inline-block;">
        <button class="btn btn-danger">Selanjutnya >></button>
    </a>
  </div>
  </div>
  </div>
  <?php
  // require '../menu.php';
  // require '../Head.php';
  ?>

