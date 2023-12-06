x<?php
if (session_status()=== PHP_SESSION_NONE){
    session_start();
}
if(empty($_SESSION['level'])){
    require 'config/koneksi.php';
    require 'fungsi/pesan_kilat.php';
    if($_SESSION['level']=="kasir"){
        include 'head.php';
        if(!empty($_GET['page'])){
            include 'admin/module/' . $_GET['page'] . '/index.php';
        } else{
            include 'home.php';
        }
        include 'Footer.php';
    } else{
        include 'admin/template/headPemilik.php';
        if(!empty($_GET['page'])){
            include 'admin/module/' . $_GET['page'] . '/index.php';
        } else{
            include 'admin/template/homePemilik.php';
        }
    }
} else{
    header("Location: Login.php");
}
