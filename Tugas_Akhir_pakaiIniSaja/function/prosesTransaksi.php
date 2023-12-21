<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include '../Class/Transaksi.php';
if (isset($_POST['action'])) {
    $action = $_POST['action'];

    // Buat objek pilihBarang
    $pilihBarang = new PilihBarang();
    // Buat objek updateTransaksi
    $transaksi = new Transaksi();
    $searchBarang = new searchBarang();

    switch ($action) {
        case 'pilihBarang':
            // Panggil metode pilihBarang
            $pilihBarang->pilihBarang($_POST['selectedProducts'], $_POST['totalHarga'], $_SESSION['user']);
            break;
        case 'updateTransaksi':
            // Panggil metode updateTransaksi
            $transaksi->updateTransaksi($_POST['amountPaid'], $_POST['paymentMethod']);
            break;
        case 'searchBarang':
            $searchBarang->searchBarang($_POST['keyword']);
            break;
        case 'hapusTransaksi':
            $transaksi->hapusTransaksi($_POST['idTransaksi']);
            break;
        case 'deleteByIdProduk':
            $transaksi->hapusTransaksiByBarang($_POST['idBarang']);
            break;
        // Tambahkan case lainnya jika ada lebih banyak aksi yang perlu ditangani
        default:
            echo "Aksi tidak valid.";
            break;
    }
} else {
    echo "Aksi tidak diberikan.";
}