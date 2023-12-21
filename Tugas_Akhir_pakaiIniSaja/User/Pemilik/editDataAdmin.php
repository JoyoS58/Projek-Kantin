<?php
require_once '../../Class/Users.php';
$users = new Users();
$id = $_GET['ID_USER'];
$tampil = $users->readUserById($id);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['editIdUser'];
    $username = $_POST['editUser'];
    $password = $_POST['editUser'];
    $level = $_POST['editUser'];
    $users->updateUser($id, $username, $password, $level);
    header("Location: dataAdmin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h2>Edit User</h2>
<form method="post">
            <?php foreach ($tampil as $data) { ?>
                <div class="mb-3">
                    <label for="editIdUser" class="form-label">ID User</label>
                    <input type="text" class="form-control" id="editIdUser" name="editIdUser" value="<?php echo $data['ID_USER']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="editUsername" class="form-label">Username</label>
                    <input type="text" class="form-control" id="editUsername" name="editUsername" value="<?php echo $data['USERNAME']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="editPassword" class="form-label">Password</label>
                    <input type="password" class="form-control" id="editPassword" name="editPassword" value="<?php echo $data['PASSWORD']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="editLevel" class="form-label">Level</label>
                    <input type="text" class="form-control" id="editLevel" name="editLevel" value="<?php echo $data['Level']; ?>" required>
                </div>
            <?php } ?>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>