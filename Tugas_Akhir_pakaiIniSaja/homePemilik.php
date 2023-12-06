<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman dengan Card dan Grafik</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="components/css/styleHome.css">
</head>
<body class="home">
<?php
    require 'menu.php';
    ?>
    <div class="container">
        <div class="row">
            <div class="col align-self-start">
                <div class="card-body">
                    <i class='bx bx-cart'></i>
                    <!-- jumlah kasir -->
                    <p class="card-text">Isi konten untuk Card 1 disini.</p>
                </div>
            </div>
            <div class="row">
            <div class="col">
                <div class="graph-box">
                    <h4>Grafik dari hasil penjualan</h4>
                <!-- Grafik atau konten lainnya akan ditempatkan di sini -->
                </div>
            </div>
            </div>
        </div>
    </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
