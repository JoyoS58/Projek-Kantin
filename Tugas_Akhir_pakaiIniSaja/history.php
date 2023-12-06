<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="components/css/styleHistory.css">
</head>
<body>
    <div class="canvas">
        <div class="container">
            <div class="text-start mb-3">
                <h3>History</h3>
            </div>
            <hr>
            <div class="table-responsive">
      <!-- Tabel -->
                <table class="table table-striped table-bordered">
                    <thead>
                         <tr>
                            <th scope="col">No</th>
                            <th scope="col">ID Barang</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Harga Total</th>
                            <th scope="col">Jenis Pembayaran</th>
                            <th scope="col">Tanggal Penjualan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                                <td>001</td>
                                <td>Produk A</td>
                                <td>Kategori A</td>
                                <td>50</td>
                                <td>50.000</td>
                                <td>Cash</td>
                                <td>01-12-2023</td>
                        </tr>
                    <?php
                    include config/koneksi.php;

                    $sql = "SELECT no, nama_barang, kategori, harga_total, jenis_pembayaran, tanggal_pembelian FROM Transaksi";
                    $result = $conn->query($sql);
                
                    if ($result->num_rows > 0) {
                      // output data of each row
                      while($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["no"]. "</td><td>" . $row["nama_barang"]. "</td><td>" . $row["kategori"]. "</td><td>" . $row["harga_total"]. "</td><td>" . $row["jenis_pembayaran"]. "</td><td>" . $row["tanggal_pembelian"]. "</td></tr>";
                      }
                    } else {
                      echo "0 results";
                    }
                    $conn->close();
                    ?>

                    
                    </tbody>
                </table>
        </div>
    </div>
    </div>
    <?php require 'menu.php';?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>