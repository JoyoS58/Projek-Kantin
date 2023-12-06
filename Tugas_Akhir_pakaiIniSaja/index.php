x<?php
if (session_status()=== PHP_SESSION_NONE){
    session_start();
}
if(empty($_SESSION['level'])){
    require 'config/koneksi.php';
    require 'function/pesanKilat.php';
    if($_SESSION['level']=="kasir"){
        include 'head.php';
        if(!empty($_GET['page'])){
            include 'user/' . $_GET['page'] . '/index.php';
        } else{
            include 'home.php';
        }
        include 'Footer.php';
    } else{
        include 'headPemilik.php';
        if(!empty($_GET['page'])){
            include 'user' . $_GET['page'] . '/index.php';
        } else{
            include 'homePemilik.php';
        }
    }
} else{
    header("Location: Login.php");
}
