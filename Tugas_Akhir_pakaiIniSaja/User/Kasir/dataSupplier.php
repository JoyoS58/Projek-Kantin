<?php
require_once '../../Class/Supplier.php';

$supplier = new Suppliers();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editIdSupplier'])) {
  $id = $_POST['editIdSupplier'];
  $namaSupplier = $_POST['editNamaSupplier'];
  $noTelp = $_POST['editNoTelpSupplier'];
  $supplier->updateSupplier($id, $namaSupplier, $noTelp);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $namaSupplier = $_POST['namaSupplier'];
  $noTelp = $_POST['noTelp'];
  $supplier->createSupplier($namaSupplier, $noTelp);
}
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
  $id = $_GET['ID_SUPPLIER'];
  $supplier->deleteSupplier($id);
}
$tampil = $supplier->readSupplier();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Supplier</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../components/Kasir/CSS/styleDataSupplier.css">
</head>

<body>
  <div class="canvas">
    <div class="container">
      <div class="text-start mb-3">
        <!-- Tombol Add -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSupplier">Add</button>
      </div>
      <hr>
      <div class="table-responsive">
        <!-- Tabel -->
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">ID Supplier</th>
              <th scope="col">Nama</th>
              <th scope="col">No Telepon</th>
              <th scope="col">Nama Barang</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (!empty($tampil)) {
              $i = 1;
              $namaBarang = "SELECT p.NAMA_BARANG
FROM supplier s
JOIN transaksi_supplier ts ON s.ID_SUPPLIER = ts.ID_SUPPLIER
JOIN produk p ON ts.ID_PRODUK = p.ID_PRODUK
";
              foreach ($tampil as $show) {
            ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $show['ID_SUPPLIER']; ?></td>
                  <td><?php echo $show['NAMA_SUPPLIER']; ?></td>
                  <td><?php echo $show['NO_TELP']; ?></td>
                  <td><?php echo $namaBarang ?></td>

                  <td>
                    <button type="button" class="btn btn-sm btn-warning btn-action" data-bs-toggle="modal" data-bs-target="#editModal" data-idproduk="<?php echo $show['ID_SUPPLIER']; ?>">Edit</button>
                    <!-- <a href="dataBarang.php?action=edit&id=<?php echo $show['ID_PRODUK']; ?>" class="btn btn-warning btn-sm">Edit</a> -->
                    <!-- <button type="button" class="btn btn-sm btn-warning btn-action" data-bs-toggle="modal" data-bs-target="#editModal" data-userid="<?php echo $show['ID_USER']; ?>">Edit</button> -->
                    <!-- <button type="button" class="btn btn-sm btn-warning btn-action" data-userid="<?php echo $show['ID_USER']; ?>" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button> -->
                    <?php echo "<a href='dataSupplier.php?action=delete&ID_SUPPLIER=" . $show['ID_SUPPLIER'] . "' class='btn btn-danger btn-sm'>Delete</a>"; ?>
                  </td>
                </tr>
            <?php
                $i++;
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Modal Input -->
  <div class="modal fade" id="addSupplier" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Tambah Supplier</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Form untuk input data -->
          <form method="post">
            <div class="mb-3">
              <label for="namaSupplier" class="form-label">Nama</label>
              <input type="text" class="form-control" id="namaSupplier" name="namaSupplier" required>
            </div>
            <div class="mb-3">
              <label for="noTelp" class="form-label">No Telepon</label>
              <input type="text" class="form-control" id="noTelp" name="noTelp" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Akhir Modal Input -->
  <!-- modal edit -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Supplier</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Form untuk edit data -->
          <form id="editForm" method="post">
            <div class="mb-3">
              <label for="editIdSupplier" class="form-label">ID Supplier</label>
              <input type="text" class="form-control" id="editIdSupplier" name="editIdSupplier" required>
            </div>
            <div class="mb-3">
              <label for="editNamaSupplier" class="form-label">Nama Supplier</label>
              <input type="text" class="form-control" id="editNamaSupplier" name="editNamaSupplier" required>
            </div>
            <div class="mb-3">
              <label for="editNoTelp" class="form-label">No Telepon</label>
              <input type="text" class="form-control" id="editNoTelpSupplier" name="editNoTelpSupplier" required>
            </div>
            <!-- <div class="mb-3">
              <label for="editNamaBarang" class="form-label">Nama Barang</label>
              <input type="number" class="form-control" id="editNamaBarang">
            </div> -->
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      $('.btn-action').on('click', function() {
        var idSupplier = $(this).data('ID_SUPPLIER');

        // Isi nilai ID Produk ke dalam input yang tersembunyi
        $('#editIdSupplier').val(idSupplier);

        // Lakukan AJAX GET untuk mengambil data produk yang akan diedit
        $.ajax({
          type: 'GET',
          url: 'dataSupplier.php?action=getSupplier&ID_SUPPLIER=' + idSupplier,
          success: function(response) {
            $('#editNamaSupplier').val(response.NAMA_SUPPLIER);
            $('#editNoTelpSupplier').val(response.NO_TELP);
            // $('#editStok').val(response.STOK);
            // $('#editHarga').val(response.HARGA_JUAL);
          },
          error: function(error) {
            console.error('Terjadi kesalahan:', error);
          }
        });
      });

      $('#editForm').submit(function(e) {
        e.preventDefault();

        var formData = $(this).serialize(); // Ambil semua data form

        $.ajax({
          type: 'POST',
          url: 'dataSupplier.php?action=updateSupplier', // Endpoint untuk update data
          data: formData, // Kirim data form
          success: function(response) {
            console.log('Data berhasil diubah:', response);
            $('#editModal').modal('hide');
            // Refresh halaman atau perbarui tabel dengan data yang baru diubah
          },
          error: function(error) {
            console.error('Terjadi kesalahan:', error);
          }
        });
      });
    });
  </script>
  <!-- Bootstrap JS (optional) -->
  <?php require './menu.php' ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>