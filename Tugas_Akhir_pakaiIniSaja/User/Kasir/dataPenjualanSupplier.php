<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../components/Kasir/CSS/styleDataPenjualanSupplier.css">
    <style>
        .canvas {
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="canvas">
        <div class="container">
            <div class="text-start mb-3">
                <h3>Return</h3>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Supplier</th>
                            <th>Nama Barang</th>
                            <th>Jumlah Terjual</th>
                            <th>Harga Total</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Retur</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Include the file with the database connection
                        include "../../config/koneksi.php";

                        // Establish a database connection
                        $conn = new Database();
                        $conn = $conn->getConnection();

                        // Check if the connection is successful
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Execute the SQL query using JOINs
                        $sql = "SELECT
                                    s.NAMA_SUPPLIER,
                                    p.NAMA_PRODUK,
                                    SUM(dt.QTY) AS Jumlah_Terjual,
                                    SUM(dt.SUB_TOTAL) AS Harga_Total,
                                    ts.TGL_SUPPLY AS tgl_pengembalian,
                                    (HARGA_SUPPLIER*dt.QTY) as RETUR
                                FROM transaksi_supplier ts
                                INNER JOIN produk p ON ts.ID_PRODUK = p.ID_PRODUK
                                INNER JOIN supplier s ON ts.ID_SUPPLIER = s.ID_SUPPLIER
                                LEFT JOIN detail_transaksi dt ON ts.ID_PRODUK = dt.ID_PRODUK
                                GROUP BY s.NAMA_SUPPLIER, p.NAMA_PRODUK
                                ORDER BY tgl_pengembalian DESC";

                        $result = $conn->query($sql);

                        // Check if the query was successful
                        if ($result !== false) {
                            if ($result->num_rows > 0) {
                                $counter = 1;
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $counter . "</td>";
                                    echo "<td>" . $row["NAMA_SUPPLIER"] . "</td>";
                                    echo "<td>" . $row["NAMA_PRODUK"] . "</td>";
                                    echo "<td>" . $row["Jumlah_Terjual"] . "</td>";
                                    echo "<td>" . $row["Harga_Total"] . "</td>";
                                    echo "<td>" . $row["tgl_pengembalian"] . "</td>";
                                    echo "<td>" . $row["RETUR"] . "</td>";
                                    echo "</tr>";
                                    $counter++;
                                }
                            } else {
                                echo "<tr><td colspan='6'>No results</td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>Error executing the query: " . $conn->error . "</td></tr>";
                        }

                        // Close the database connection
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php require './menu.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>