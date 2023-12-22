<?php
require_once '../../Class/Produk.php';
require_once '../../Class/Supplier.php';
require_once '../../Class/Retur.php';

$produk = new Produks();
$transaksiSupplier = new Retur();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editIdBarang'])) {
  $id = $_POST['editIdBarang'];
  $namaProduk = $_POST['editNamaBarang'];
  $kategori = $_POST['editKategori'];
  $stok = $_POST['editStok'];
  $harga = $_POST['editHarga'];
  $transaksiSupplierData = $transaksiSupplier->ambilTransaksi($id);
  $hargaSupplier = $_POST['editHargaSupplier'];

    if ($transaksiSupplierData) {
        // Jika transaksi sudah ada, lakukan updateTransaksi
        $transaksiSupplier->updateTransaksi($id, $hargaSupplier, $stok);
    } else {
        // Jika transaksi belum ada, lakukan tambahTransaksi
        $idSupplier = $_POST['editSupplier'];
        $transaksiSupplier->tambahTransaksi($id, $idSupplier, $hargaSupplier, $stok);
    }

    $produk->updateProduk($id, $namaProduk, $kategori, $stok, $harga);

    header("Location: dataBarang.php");
    exit();
}elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $namaProduk = $_POST['namaBarang'];
    $kategori = $_POST['kategori'];
    $stok = $_POST['stok'];
    $harga = $_POST['harga'];

    // Simpan produk baru
    $produk->createProduk($namaProduk, $kategori, $stok, $harga);

    // Ambil ID produk yang baru dibuat
    $idProdukBaru = $produk->getLastInsertedId(); // Tentukan metode yang sesuai di class Produk

    // Ambil nilai dari formulir
    $idSupplier = $_POST['supplier'];
    $hargaSupplier = $_POST['hargaSupplier']; // Harga Supplier null sesuai dengan permintaan Anda
    $jumlahProduk = $stok; // Ambil jumlah produk dari stok

    // Panggil metode tambahTransaksi
    $transaksiSupplier->tambahTransaksi($idProdukBaru, $idSupplier, $hargaSupplier, $jumlahProduk);

    header("Location: dataBarang.php");
    exit();
}
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
  $id = $_GET['ID_PRODUK'];
  $produk->deleteProduk($id);
}
$tampil = $produk->readProduk();
?>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../components/Kasir/CSS/styleDataBarang.css">
  
  <div class="container-fluid">
    <div class="row">
  <div class="canvas">
      <div class="col mb-3"> <!-- Gunakan kolom setengah lebar pada layar medium dan lebih besar -->
                <!-- <div class="text-start mb-3"> -->
                    <!-- Tombol Add -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add</button>
                <!-- </div> -->
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
              <th scope="col">Stok</th>
              <th scope="col">Harga</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if (!empty($tampil)) {
              $i = 1;
              foreach ($tampil as $show) {
            ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $show['ID_PRODUK']; ?></td>
                  <td><?php echo $show['NAMA_PRODUK']; ?></td>
                  <td><?php echo $show['KATEGORI']; ?></td>
                  <td><?php echo $show['STOK']; ?></td>
                  <td><?php echo $show['HARGA_JUAL']; ?></td>
                  <td>
                    <button type="button" class="btn btn-sm btn-warning btn-action" data-bs-toggle="modal" data-bs-target="#editModal" data-idproduk="<?php echo $show['ID_PRODUK']; ?>">Edit</button>
                    <!-- <a href="dataBarang.php?action=edit&id=<?php echo $show['ID_PRODUK']; ?>" class="btn btn-warning btn-sm">Edit</a> -->
                    <!-- <button type="button" class="btn btn-sm btn-warning btn-action" data-bs-toggle="modal" data-bs-target="#editModal" data-userid="<?php echo $show['ID_USER']; ?>">Edit</button> -->
                    <!-- <button type="button" class="btn btn-sm btn-warning btn-action" data-userid="<?php echo $show['ID_USER']; ?>" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button> -->
                    <?php echo "<a href='dataBarang.php?action=delete&ID_PRODUK=" . $show['ID_PRODUK'] . "' class='btn btn-danger btn-sm'>Delete</a>"; ?>
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
  <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Tambah Barang</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Form untuk input data -->
          <form method="post">
            <div class="mb-3">
              <label for="namaBarang" class="form-label">Nama Barang</label>
              <input type="text" class="form-control" id="namaBarang" name="namaBarang" required>
            </div>
            <div class="mb-3">
              <label for="kategori" class="form-label">Kategori</label>
              <input type="text" class="form-control" id="kategori" name="kategori" required>
            </div>
            <div class="mb-3">
              <label for="stok" class="form-label">Stok</label>
              <input type="number" class="form-control" id="stok" name="stok" required>
            </div>
            <div class="mb-3">
              <label for="harga" class="form-label">Harga</label>
              <input type="number" class="form-control" id="harga" name="harga" required>
            </div>
            <div class="mb-3">
              <label for="harga" class="form-label">Supplier</label>
              <select class="form-select" name="supplier" aria-label="Default select example">
              <option selected>Pilih Supplier</option>
              <?php
                $row3 = new Suppliers();
                $supplierData = $row3->readSupplier();
                if ($supplierData) {
                    // Melakukan loop untuk menampilkan opsi dropdown
                    foreach ($supplierData as $supplier) {
                        ?>
                        <option value="<?= $supplier['ID_SUPPLIER']; ?>"><?= $supplier['NAMA_SUPPLIER']; ?></option>
                        <?php
                    }
                } else {
                    // Menampilkan pesan jika tidak ada data supplier
                    echo "<option value=''>Tidak ada data supplier</option>";
                }
                ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="HargaSupplier" class="form-label">Harga Supplier</label>
              <input type="number" class="form-control" id="HargaSupplier" name="HargaSupplier" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Akhir Modal Input -->
  <!-- modal edit -->
  <!-- modal edit -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Barang</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Form untuk edit data -->
          <form id="editForm" method="post">
            <div class="mb-3">
              <label for="editIdBarang" class="form-label">ID Barang</label>
              <input type="text" class="form-control" id="editIdBarang" name="editIdBarang">
              <!-- Hidden input untuk menyimpan ID Produk yang diedit -->
            </div>
            <div class="mb-3">
              <label for="editNamaBarang" class="form-label">Nama Barang</label>
              <input type="text" class="form-control" id="editNamaBarang" name="editNamaBarang">
            </div>
            <div class="mb-3">
              <label for="editKategori" class="form-label">Kategori</label>
              <input type="text" class="form-control" id="editKategori" name="editKategori">
            </div>
            <div class="mb-3">
              <label for="editStok" class="form-label">Stok</label>
              <input type="number" class="form-control" id="editStok" name="editStok">
            </div>
            <div class="mb-3">
              <label for="editHarga" class="form-label">Harga</label>
              <input type="number" class="form-control" id="editHarga" name="editHarga" required>
            </div>
            <div class="mb-3">
              <label for="editSupplier" class="form-label">Supplier</label>
              <select class="form-select" name="editSupplier" id="editSupplier" aria-label="Default select example">
              <option selected>Pilih Supplier</option>
              <?php
                $row3 = new Suppliers();
                $supplierData = $row3->readSupplier();
                if ($supplierData) {
                    // Melakukan loop untuk menampilkan opsi dropdown
                    foreach ($supplierData as $supplier) {
                        ?>
                        <option value="<?= $supplier['ID_SUPPLIER']; ?>"><?= $supplier['NAMA_SUPPLIER']; ?></option>
                        <?php
                    }
                } else {
                    // Menampilkan pesan jika tidak ada data supplier
                    echo "<option value=''>Tidak ada data supplier</option>";
                }
                ?>
              </select>
            </div>
            <div class="mb-3">
              <label for="editHargaSupplier" class="form-label">Harga Supplier</label>
              <input type="number" class="form-control" id="editHargaSupplier" name="editHargaSupplier" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <?php include 'menu.php';?>

  </div>
</div>
  

  <!-- ... Bagian lain dari HTML ... -->

  <script>
    $(document).ready(function() {
      $('.btn-action').on('click', function() {
        var idProduk = $(this).data('ID_PRODUK');

        // Isi nilai ID Produk ke dalam input yang tersembunyi
        $('#editIdBarang').val(idProduk);

        // Lakukan AJAX GET untuk mengambil data produk yang akan diedit
        $.ajax({
          type: 'GET',
          url: 'dataBarang.php?action=getProduk&ID_PRODUK=' + idProduk,
          success: function(response) {
            $('#editNamaBarang').val(response.NAMA_PRODUK);
            $('#editKategori').val(response.KATEGORI);
            $('#editStok').val(response.STOK);
            $('#editHarga').val(response.HARGA_JUAL);
            $('#editSupplier').val(response.ID_SUPPLIER);
            $('#editHargaSupplier').val(response.HARGA_SUPPLIER);
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
          url: 'dataBarang.php?action=updateProduk', // Endpoint untuk update data
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
