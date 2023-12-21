<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Barang</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../components/Kasir/CSS/stylePilihBarang.css">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <div class="canvas">
        <h1 class="text-center mb-4">Pilih Barang</h1>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Cari barang..." id="searchBarang">
            <button class="btn btn-outline-secondary" type="button" onclick="searchBarang()">Cari</button>
        </div>
        <div id="searchResult" class="mt-3"></div>
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
            <tbody id="barangTableBody">
                <!-- Isi tabel disini -->
            </tbody>
        </table>
        <div style="text-align: center;">
            <p id="pesan"></p>
            <button type="submit" class="btn btn-danger" name="submit" id="selanjutnyaButton" onclick="prosesPilihanBarang()">Selanjutnya >></button>
        </div>
    </div>
</div>
  <?php
  require 'menu.php';
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    #searchResult {
        margin-top: 10px;
    }

    .result-item {
        cursor: pointer;
        padding: 10px;
        border: 1px solid #ddd;
        margin-bottom: 10px;
        transition: background-color 0.3s;
    }

    .result-item:hover {
        background-color: #f9f9f9;
    }
</style>

<script>
    function searchBarang() {
        var keyword = $('#searchBarang').val();

        $.ajax({
            type: 'POST',
            url: '../../function/prosesTransaksi.php',
            data: {action: 'searchBarang', keyword: keyword },
            success: function (response) {
                $('#searchResult').html(response);
            }
        });
    }

    function pilihBarang(id_barang, nama_barang, harga_barang) {
    var qty = prompt("Masukkan jumlah barang yang akan dibeli:", "1");

    if (qty !== null && qty !== "") {
        var totalHargaBarang = parseFloat(harga_barang);

        $('#barangTableBody').append('<tr><td>' + id_barang + '</td><td>' + nama_barang + '</td><td>' + qty + '</td><td>$' + totalHargaBarang.toFixed(2) + '</td><td><input type="checkbox" name="selected_products[]" value="' + id_barang + '"></td></tr>');
    }
}

function prosesPilihanBarang() {
    var selectedProducts = [];
    var totalHarga = 0;

    // Ambil data barang yang dipilih dari tabel
    $('input[name="selected_products[]"]:checked').each(function () {
        var id_barang = $(this).val();
        var nama_barang = $(this).closest('tr').find('td:eq(1)').text();
        var harga_barang = parseFloat($(this).closest('tr').find('td:eq(3)').text().replace('$', ''));
        var qty = parseInt($(this).closest('tr').find('td:eq(2)').text());

        totalHarga += qty * harga_barang;

        selectedProducts.push({
            id_barang: id_barang,
            nama_barang: nama_barang,
            harga_barang: harga_barang,
            qty: qty
        });
    });

    // Lakukan validasi apakah ada barang yang dipilih
    if (selectedProducts.length > 0) {
        // Tombol selanjutnya diaktifkan
        $('#selanjutnyaButton').prop('disabled', false);

        // Sembunyikan pesan
        $('#pesan').hide();

        // Lakukan AJAX untuk mengirim data ke server
        $.ajax({
            type: 'POST',
            url: '../../function/prosesTransaksi.php',
            data: { action: 'pilihBarang',selectedProducts: selectedProducts, totalHarga: totalHarga },
            success: function (response) {
                // Handle respons dari server
                console.log(response);
                // Redirect atau lakukan operasi lainnya setelah pemrosesan selesai
                window.location.href = 'bayar.php';
                // window.location.href = '#';
            }
        });
    } else {
        // Tidak ada barang yang dipilih, nonaktifkan tombol selanjutnya
        $('#selanjutnyaButton').prop('disabled', true);

        // Tampilkan pesan bahwa tidak ada barang yang dipilih
        $('#pesan').text("Tidak ada barang yang dipilih. Klik tombol aksi terlebih dahulu.").show();
        setTimeout(function () {
            $('#selanjutnyaButton').prop('disabled', false);
            $('#pesan').hide();
        }, 1500);
    }
}
</script>
</body>
</html>
