<?php
require_once '../../Class/Users.php';

$users = new users();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $level = $_POST['level'];
  $users->createUser($username,$password,$level);
}
$tampil = $users->readUser();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD Tabel User</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../components/Pemilik/CSS/styleDataAdmin.css">
</head>
<body>
    <div class="canvas">
  <div class="container">
    <div class="text-start mb-3">
      <!-- Tombol Add -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">Add</button>
    </div>
    <hr>
    <div class="table-responsive">
      <!-- Tabel -->
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Username</th>
            <th scope="col">Password</th>
            <th scope="col">Level</th>
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
                <td><?php echo $show['USERNAME']; ?></td>
                <td><?php echo $show['PASSWORD']; ?></td>
                <td><?php echo $show['LEVEL']; ?></td>
                <td>
                  <button type="button" class="btn btn-sm btn-warning btn-action" data-bs-toggle="modal" data-bs-target="#editModal" data-userid="<?php echo $user['ID_USER']; ?>">Edit</button>
                  <button type="button" class="btn btn-sm btn-danger btn-action" data-userid="<?php echo $show['ID_USER']; ?>">Delete</button>
                </td>
              </tr>
              <?php
              $i++;
            }
          }
          ?>
          <!-- <tr>
            <th scope="row">1</th>
            <td>Rafly</td>
            <td>Rafly123</td>
            <td>Raflyxxx</td>
            <td>Pemilik</td>            
            <td>
              <button type="button" class="btn btn-sm btn-warning btn-action" data-bs-toggle="modal" data-bs-target="#editModal"">Edit</button>
              <button type="button" class="btn btn-sm btn-danger btn-action">Delete</button>
            </td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Ikhwan</td>
            <td>Ikhwan121</td>
            <td>Ikhwanxxx</td>
            <td>Kasir</td>
            <td>
              <button type="button" class="btn btn-sm btn-warning btn-action" data-bs-toggle="modal" data-bs-target="#editModal"">Edit</button>
              <button type="button" class="btn btn-sm btn-danger btn-action">Delete</button>
            </td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Joyo</td>
            <td>Joyo111</td>
            <td>Joyoxxx</td>
            <td>Kasir</td>
            <td>
              <button type="button" class="btn btn-sm btn-warning btn-action" data-bs-toggle="modal" data-bs-target="#editModal"">Edit</button>
              <button type="button" class="btn btn-sm btn-danger btn-action">Delete</button>
            </td>
          </tr> -->
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
          <h5 class="modal-title" id="addModalLabel">Tambah Admin</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Form untuk input data -->
          <form method="post">
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="text" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
              <label for="level" class="form-label">Level</label>
              <input type="text" class="form-control" id="level" name="level" required>
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
          <h5 class="modal-title" id="editModalLabel">Edit Admin</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Form untuk edit data -->
          <form>
            <div class="mb-3">
              <label for="editIdBarang" class="form-label">Nama</label>
              <input type="text" class="form-control" id="editIdBarang">
            </div>
            <div class="mb-3">
              <label for="editNamaBarang" class="form-label">Username</label>
              <input type="text" class="form-control" id="editNamaBarang">
            </div>
            <div class="mb-3">
              <label for="editKategori" class="form-label">Password</label>
              <input type="text" class="form-control" id="editKategori">
            </div>
            <div class="mb-3">
              <label for="editStok" class="form-label">Level</label>
              <input type="number" class="form-control" id="editStok">
            </div>
            <div class="mb-3">
              <label for="editSupplier" class="form-label">Supplier</label>
              <input type="text" class="form-control" id="editSupplier">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap JS (optional) -->
  <?php 
  require './menu.php';
  ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>