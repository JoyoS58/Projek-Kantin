<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Barang Bro</title>
        
    </head>
    <body>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <!-- menyisipkan javascript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <div class="container-fluid">
            <div class="row">
                <?php
                // require 'admin/template/menu.php';
                ?>
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Barang</h1>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal" data-whatever="@mdo">
                                <i class="fa fa-plus"></i> Tambah Barang
                            </button>
                        </div>
                    </div>
                    <?php
                    // if (isset($_SESSION['_flashdata'])) {
                    //     echo "<br>";
                    //     foreach ($_SESSION['_flashdata'] as $key => $val) {
                    //         echo get_flashdata($key);
                    //     }
                    // }
                    ?>
                    <div class="table-responsive small">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Stok</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // $no = 1;
                                // $query = "SELECT * FROM anggota a, jabatan j, user u where a.jabatan_id=j.id and a.user_id=u.id order by a.id desc";
                                // $result = mysqli_query($koneksi, $query);
                                // while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <th scope="row"></th>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="index.php?page=anggota/edit&id=<?php //echo $row['user_id']; ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                                            <a href="fungsi/hapus.php?anggota=hapus&id=<?php //echo $row['user_id']; ?>" onclick="javascript:return confirm('Hapus Data Jabatan ?');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o" aria-hidden="true"></i> delete</a>
                                        </td>
                                    </tr>
                                <?php //} ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Form Tambah Barang</h1>
                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="#" method="POST">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Nama Barang:</label>
                                            <input type="text" name="nama" class="form-control" id="recipient-name" >
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Kategori:</label>
                                            <select class="form-select" name="kategori" aria-label="Default select example">
                                                <option selected>Pilih Kategori</option>
                                                <?php
                                                // $query2="SELECT * from jabatan order by jabatan asc";
                                                // $result2=mysqli_query($koneksi, $query2);
                                                // while($row2=mysqli_fetch_assoc($result2)){
                                                    ?>
                                                    <option value=""></option>
                                                    <?php
                                                // }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Stok:</label>
                                            <input type="text" name="stok" class="form-control" id="recipient-name" >
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="form-label">Harga:</label>
                                            <input name="harga" class="form-control" id="recipient-name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="form-label">Supplier:</label>
                                            <select class="form-select" name="supplier" aria-label="Default select example">
                                                <option selected>Pilih Kategori</option>
                                                <?php
                                                // $query2="SELECT * from jabatan order by jabatan asc";
                                                // $result2=mysqli_query($koneksi, $query2);
                                                // while($row2=mysqli_fetch_assoc($result2)){
                                                    ?>
                                                    <option value=""></option>
                                                    <?php
                                                // }
                                                ?>
                                            </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Close</button>
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
