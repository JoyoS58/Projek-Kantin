<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="components/css/styleDataPenjualanSupplier.css">
</head>
<body>
    <div class="canvas">
        <div class="container">
            <div class="text-start mb-3">
                <h3>Return</h3>
            </div>
            <hr>
            <div class="table-responsive">
      <!-- Tabel -->
                <table class="table table-striped table-bordered">
                    <thead>
                         <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Supplier</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Jumlah Terjual</th>
                            <th scope="col">Harga Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                                <td>Rafly</td>
                                <td>Sate</td>
                                <td>1</td>
                                <td>10.000</td>
                        </tr>

                        <?php
                        include "config/koneksi.php";
                        $sql = "SELECT no, nama_supplier, nama_barang_terjual, jumlah, harga_total FROM transaksi_supplier";
                        $result = $conn->query($sql);
                    
                        if ($result->num_rows > 0) {
                          // output data of each row
                          while($row = $result->fetch_assoc()) {
                            echo "<tr><td>" . $row["no"]. "</td><td>" . $row["nama_supplier"]. "</td><td>" . $row["nama_barang_terjual"]. "</td><td>" . $row["jumlah"]. "</td><td>" . $row["harga_total"]. "</td></tr>";
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