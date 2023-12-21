
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../components/Kasir/CSS/styleHistory.css">
    <div class="canvas">
        <div class="container">
            <div class="text-start mb-3">
                <h3>History</h3>
            </div>
            <style>
                table {
                    border-collapse: collapse;
                    width: 100%;
                }

                th,
                td {
                    border: 1px solid #dddddd;
                    text-align: left;
                    padding: 8px;
                }

                th {
                    background-color: #f2f2f2;
                }

                tr:hover {
                    background-color: #f5f5f5;
                }
            </style>
                <hr>
                <div class="table-responsive">
                    <!-- Tabel -->
                    <table class="table table-striped table-bordered">
                        <tbody>
                            <!-- <tr>
                                <th scope="row">1</th>
                                <td>001</td>
                                <td>Produk A</td>
                                <td>Kategori A</td>
                                <td>50</td>
                                <td>50.000</td>
                                <td>Cash</td>
                                <td>01-12-2023</td>
                            </tr> -->


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

                            // Execute the SQL query using ROW_NUMBER()
                            $sql = "SELECT
            ROW_NUMBER() OVER (ORDER BY t.TGL_TRANSAKSI DESC) AS No,
            dt.ID_PRODUK,
            p.NAMA_PRODUK,
            p.KATEGORI,
            dt.QTY,
            dt.SUB_TOTAL AS HARGA_TOTAL,
            t.JENIS_PEMBAYARAN,
            t.TGL_TRANSAKSI
        FROM detail_transaksi dt
        INNER JOIN transaksi t ON dt.ID_TRANSAKSI = t.ID_TRANSAKSI
        INNER JOIN produk p ON dt.ID_PRODUK = p.ID_PRODUK
        ORDER BY t.TGL_TRANSAKSI DESC";

                            $result = $conn->query($sql);

                            // Check if the query was successful
                            if ($result !== false) {
                                if ($result->num_rows > 0) {
                                    echo "<table border='1'>";
                                    echo "<tr><th>No</th><th>ID Produk</th><th>Nama Produk</th><th>Kategori</th><th>Qty</th><th>Harga Total</th><th>Jenis Pembayaran</th><th>Tanggal Transaksi</th></tr>";

                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["No"] . "</td>";
                                        echo "<td>" . $row["ID_PRODUK"] . "</td>";
                                        echo "<td>" . $row["NAMA_PRODUK"] . "</td>";
                                        echo "<td>" . $row["KATEGORI"] . "</td>";
                                        echo "<td>" . $row["QTY"] . "</td>";
                                        echo "<td>" . $row["HARGA_TOTAL"] . "</td>";
                                        echo "<td>" . $row["JENIS_PEMBAYARAN"] . "</td>";
                                        echo "<td>" . $row["TGL_TRANSAKSI"] . "</td>";
                                        echo "</tr>";
                                    }

                                    echo "</table>";
                                } else {
                                    echo "0 results";
                                }
                            } else {
                                echo "Error executing the query: " . $conn->error;
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
