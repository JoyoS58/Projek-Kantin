<?php
if (session_status()=== PHP_SESSION_NONE){
    session_start();
}
if(!empty($_SESSION['level'])){
    require 'config/koneksi.php';
    require 'function/pesanKilat.php';
    if($_SESSION['level']=="kasir"){
        if(!empty($_GET['page'])){
            include $_GET['page'] . '/index.php'; // untuk kasir kayak gini
        } else{
            include 'home.php';
        }
        include 'menu.php';
        include 'Footer.php';
    } else if($_SESSION['level']=="pemilik"){
        if(!empty($_GET['page'])){
            include $_GET['page'] . '/index.php';
        } else{
            include 'homePemilik.php';
        }
        include 'menuPemilik.php';
        include 'footer.php';
    }
} else{
    header("Location: Login.php");
} 