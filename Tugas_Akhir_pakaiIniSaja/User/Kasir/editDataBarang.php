<?php
require_once '../../Class/Produk.php';
$produk = new Produks();
$id = $_GET['ID_PRODUK'];
$tampil = $produk->readProdukById($id);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['editIdBarang'];
    $namaProduk = $_POST['editBarang'];
    $kategori = $_POST['editKategori'];
    $stok = $_POST['editStok'];
    $harga = $_POST['editHarga'];
    $produk->updateProduk($id, $namaProduk, $kategori, $stok, $harga);
    header("Location: dataBarang.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h2>Edit Barang</h2>
        <!-- Form untuk edit data -->
        <form method="post">
            <?php foreach ($tampil as $data) { ?>
                <div class="mb-3">
                    <label for="editIdBarang" class="form-label">ID Barang</label>
                    <input type="text" class="form-control" id="editIdBarang" name="editIdBarang" value="<?php echo $data['ID_PRODUK']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="editNamaBarang" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" id="editNamaBarang" name="editBarang" value="<?php echo $data['NAMA_PRODUK']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="editKategori" class="form-label">Kategori</label>
                    <input type="text" class="form-control" id="editKategori" name="editKategori" value="<?php echo $data['KATEGORI']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="editStok" class="form-label">Stok</label>
                    <input type="number" class="form-control" id="editStok" name="editStok" value="<?php echo $data['STOK']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="editHarga" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="editHarga" name="editHarga" value="<?php echo $data['HARGA_JUAL']; ?>" required>
                </div>
            <?php } ?>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>