<?php 
require 'function.php';
$id = $_GET["id"];

if (delete_user($id) > 0 ){
    echo "<script>
            alert ('Data Berhasil Hapus');
            document.location.href = 'catatan.php';
          </script>";
} else {
    echo "<script>
            alert ('Data Gagal Hapus');
            document.location.href = 'catatan.php';
          </script>";
}
?>