<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD Tabel Supplier</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="components/css/styleDataBarang.css">
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
          <tr>
            <th scope="row">1</th>
            <td>001</td>
            <td>Ikhwan</td>
            <td>081xxx</td>
            <td>Donut</td>
            <td>
              <button type="button" class="btn btn-sm btn-warning btn-action" data-bs-toggle="modal" data-bs-target="#editModal"">Edit</button>
              <button type="button" class="btn btn-sm btn-danger btn-action">Delete</button>
            </td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>002</td>
            <td>Rafly</td>
            <td>082xxx</td>
            <td>Risol</td>
            <td>
              <button type="button" class="btn btn-sm btn-warning btn-action" data-bs-toggle="modal" data-bs-target="#editModal"">Edit</button>
              <button type="button" class="btn btn-sm btn-danger btn-action">Delete</button>
            </td>
          </tr>
          <tr>
            <th scope="row">3</th>
            <td>003</td>
            <td>Joyo</td>
            <td>083xxx</td>
            <td>Tahu</td>
            <td>
              <button type="button" class="btn btn-sm btn-warning btn-action" data-bs-toggle="modal" data-bs-target="#editModal"">Edit</button>
              <button type="button" class="btn btn-sm btn-danger btn-action">Delete</button>
            </td>
          </tr>
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
          <form>
            <div class="mb-3">
              <label for="namaSupplier" class="form-label">Nama</label>
              <input type="text" class="form-control" id="namaSupplier">
            </div>
            <div class="mb-3">
              <label for="noTelp" class="form-label">No Telepon</label>
              <input type="text" class="form-control" id="noTelp">
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
          <form>
            <div class="mb-3">
              <label for="editIdSupplier" class="form-label">ID Supplier</label>
              <input type="text" class="form-control" id="editIdSupplier">
            </div>
            <div class="mb-3">
              <label for="editNamaSupplier" class="form-label">Nama Supplier</label>
              <input type="text" class="form-control" id="editNamaSupplier">
            </div>
            <div class="mb-3">
              <label for="editNoTelp" class="form-label">No Telepon</label>
              <input type="text" class="form-control" id="editNoTelp">
            </div>
            <div class="mb-3">
              <label for="editNamaBarang" class="form-label">Nama Barang</label>
              <input type="number" class="form-control" id="editNamaBarang">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap JS (optional) -->
  <?php require 'menu.php'?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
