<?php
require_once '../../Class/Users.php';

$users = new Users();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editIdUser'])) {
  $id = $_POST['editIdUser'];
  $username = $_POST['editUsername'];
  $password = md5($_POST['editPassword']);
  $level = $_POST['editLevel'];
  $users->updateUser($id, $username, $password, $level);

  header("Location: dataAdmin.php");
  exit();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  $level = $_POST['level'];
  $users->createUser($username, $password, $level);

  header("Location: dataAdmin.php");
  exit();
}
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
  $id = $_GET['ID_USER'];
  $users->deleteUser($id);
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
      <div class="table-container">
        <!-- Tabel -->
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Id User</th>
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
                  <td><?php echo $show['ID_USER']; ?></td>
                  <td><?php echo $show['USERNAME']; ?></td>
                  <td><?php echo $show['PASSWORD']; ?></td>
                  <td><?php echo $show['LEVEL']; ?></td>
                  <td>
                    <button type="button" class="btn btn-sm btn-warning btn-action" data-bs-toggle="modal" data-bs-target="#editModal" data-iduser="<?php echo $show['ID_USER']; ?>">Edit</button>
                    <?php echo "<a href='dataAdmin.php?action=delete&ID_USER=" . $show['ID_USER'] . "' class='btn btn-danger btn-sm'>Delete</a>"; ?>
                  </td>
                </tr>
            <?php
                $i++;
              }
            }
            ?>
</body>
</table>
</div>
</div>
</div>

<!-- Modal Input -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">Tambah User</h5>
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
<!-- modal edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Form untuk edit data -->
        <form id="editForm" method="post">
          <div class="mb-3">
            <label for="editIdUser" class="form-label">ID User</label>
            <input type="text" class="form-control" id="editIdUser" name="editIdUser">
            <!-- Hidden input untuk menyimpan ID Produk yang diedit -->
          </div>
          <div class="mb-3">
            <label for="editUsername" class="form-label">Username</label>
            <input type="text" class="form-control" id="editUsername" name="editUsername">
          </div>
          <div class="mb-3">
            <label for="editPassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="editPassword" name="editPassword">
          </div>
          <div class="mb-3">
            <label for="editLevel" class="form-label">Level</label>
            <input type="text" class="form-control" id="editLevel" name="editLevel">
          </div>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- ... Bagian lain dari HTML ... -->

<script>
  $(document).ready(function() {
    $('.btn-action').on('click', function() {
      var idUser = $(this).data('ID_USER');

      // Isi nilai ID Produk ke dalam input yang tersembunyi
      $('#editIdUser').val(idUser);

      // Lakukan AJAX GET untuk mengambil data produk yang akan diedit
      $.ajax({
        type: 'GET',
        url: 'dataAdmin.php?action=getUser&ID_USER=' + idUser,
        success: function(response) {
          $('#editUsername').val(response.USERNAME);
          $('#editPassword').val(response.PASSWORD);
          $('#editLevel').val(response.LEVEL);
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
        url: 'dataAdmin.php?action=updateUser', // Endpoint untuk update data
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