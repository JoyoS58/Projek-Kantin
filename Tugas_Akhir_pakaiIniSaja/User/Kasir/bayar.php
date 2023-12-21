<?php
// Pastikan session telah dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kembalian</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="../../components/Kasir/CSS/styleBayar.css">
</head>
<body>
<div class="container">
    <div class="canvas">
        <div class="card float-end mb-2 mt-3">
            <div class="card-body text-bg-success">
              <p id="kembalianText">Kembalian: Rp. 0.00</p>
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
              <?php
                // Iterasi melalui data produk yang dipilih dari session
                $hargaTotal = 0;
                $index = 1; // Menyimpan nomor urut
                foreach ($_SESSION['selected_products'] as $product) {
                    ?>
                    <tr>
                        <th scope="row"><?= $index++; ?></th>
                        <td><?= $product['nama_barang']; ?></td>
                        <td><?= $product['qty']; ?></td>
                        <td><?= $product['qty'] * $product['harga_barang']; ?></td>
                    </tr>
                    <?php
                    $hargaTotal += $product['qty'] * $product['harga_barang'];
                }
              ?>
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
                        <option value="Qris">QRIS</option>
                        <!-- Tambahkan opsi pembayaran lainnya jika diperlukan -->
                    </select>
                </div>
                <div class="col-md-4 offset-md-4 total">
                    <div class="totalharga">
                        <h5 class="card-title">Total Pembelian</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Total yang harus dibayarkan</h6>
                        <p class="card-text" id="totalHarga"><?php echo $hargaTotal; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-4 offset-md-9">
                    <div class="mb-3 ps-5">
                      <label for="amountPaid" class="form-label">Jumlah yang dibayarkan</label>
                      <input type="number" class="form-control" id="amountPaid" placeholder="Masukkan jumlah yang dibayarkan" oninput="updateKembalian()">
                    </div>
                </div>
            </div>
            <div class="container">
            <div class="row">
                <div class="col-md-4 offset-md-10">
                    <button type="button" class="btn btn-primary" onclick="kembaliKePilihBarang()">Kembali</button>
                    <button type="button" class="btn btn-success" onclick="updateTransaksi()">Bayar</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php
require './menu.php';
?>
  <!-- Bootstrap JS (optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    function kembaliKePilihBarang() {
        // Ambil nilai ID transaksi dari PHP
        var idTransaksi = <?php echo $_SESSION['id_transaksi']; ?>;

        // Lakukan AJAX untuk menghapus transaksi
        $.ajax({
            type: 'POST',
            url: '../../function/prosesTransaksi.php',
            data: { action: 'hapusTransaksi', idTransaksi: idTransaksi },
            success: function(response) {
                // Handle respons dari server
                console.log(response);
                // Redirect atau lakukan operasi lainnya setelah pemrosesan selesai
                window.location.href = 'pilihBarang.php';
                // window.location.href = '#';
            }
        });
    }
    function updateKembalian() {
        // Ambil nilai total pembelian dari PHP
        var hargaTotal = <?php echo $hargaTotal; ?>;

        // Ambil nilai yang dibayarkan dari input
        var amountPaid = parseFloat(document.getElementById('amountPaid').value) || 0;

        // Hitung kembalian
        var kembalian = amountPaid - hargaTotal;

        // Update teks kembalian di card
        document.querySelector('.card-body p').textContent = 'Kembalian: Rp. ' + kembalian.toFixed(2);
    }
    function updateTransaksi() {
        // Ambil nilai yang dibayarkan dari input
        var amountPaid = parseFloat(document.getElementById('amountPaid').value) || 0;
        var paymentMethod = document.getElementById('paymentMethod').value;
        var hargaTotal = parseFloat(document.getElementById('totalHarga').textContent.replace('Rp. ', '')) || 0;

        // Lakukan AJAX untuk mengirim data ke server
        $.ajax({
            type: 'POST',
            url: '../../function/prosesTransaksi.php', // Ganti dengan alamat file yang sesuai
            data: { action: 'updateTransaksi',amountPaid: amountPaid, paymentMethod: paymentMethod, hargaTotal: hargaTotal },
            success: function(response) {
                // Handle respons dari server
                console.log(response);
                // Redirect atau lakukan operasi lainnya setelah pemrosesan selesai
                window.location.href = 'pilihBarang.php';
                // window.location.href = '#';
            }
        });
    }
</script>
</body>
</html>
