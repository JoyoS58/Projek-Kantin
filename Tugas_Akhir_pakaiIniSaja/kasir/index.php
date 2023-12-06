<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kembalian</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styleBayar.css">
</head>
<>
  <div class="container">
    <div class="canvas">
      <div class="card float-end">
        <div class="card-body">
        <p>Kembalian: $50</p>
        </div>
      </div>
    <table class="table">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama Barang</th>
              <th scope="col">Qty</th>
              <th scope="col">Subtotal</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>Produk A</td>
              <td>2</td>
              <td>$20</td>
            </tr>
            <tr>
              <th scope="row">2</th>
              <td>Produk B</td>
              <td>1</td>
              <td>$30</td>
            </tr>
            <!-- Tambahkan baris sesuai dengan barang yang dibeli -->
          </tbody>
    </table>
    <div class="container">
      <div class="row">
        <div class="col-md-4 jenispembayaran">
          <label for="paymentMethod" class="form">Jenis Pembayaran</label>
          <select class="form-select" id="paymentMethod">
            <option selected>Pilih jenis pembayaran...</option>
            <option value="tunai">Tunai</option>
            <option value="kartu_kredit">Kartu Kredit</option>
            <option value="transfer_bank">Transfer Bank</option>
                        <!-- Tambahkan opsi pembayaran lainnya jika diperlukan -->
          </select>
        </div>
        <div class="col-md-4 offset-md-4 total">
          <div class="totalharga">
            <h5 class="card-title">Total Pembelian</h5>
            <h6 class="card-subtitle mb-2 text-muted">Total yang harus dibayarkan</h6>
            <p class="card-text">Rp. 500.000</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4 offset-md-4">
          <div class="mb-3">
            <label for="amountPaid" class="form-label">Jumlah yang dibayarkan</label>
            <input type="number" class="form-control" id="amountPaid" placeholder="Masukkan jumlah yang dibayarkan">
          </div>
        </div>
      </div>
    <div class="container">
      <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4 offset-md-4">
          <button type="button" class="btn btn-primary">Kembali</button>
          <button type="button" class="btn btn-success">Bayar</button>
      </div>
    </div>
  </div>
</div>
    </div></div>

<?php
require 'menu.php';
?>
  <!-- Bootstrap JS (optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
