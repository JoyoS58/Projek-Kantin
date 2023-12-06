<?php
if (session_status()=== PHP_SESSION_NONE){
    session_start();
}
// $user=$_POST['username'];
// if(!empty($user)){
    // require 'config/koneksi.php';
    // require 'function/pesanKilat.php';
    // if($user=="kasir"){
        if(!empty($_GET['page'])){
            include $_GET['page'] . '/index.php'; // untuk kasir kayak gini
        } else{
            include 'home.php';
        }
        include 'menu.php';
        include 'Footer.php';
    // } else{
        // include 'admin/template/headPemilik.php';
        // if(!empty($_GET['page'])){
        //     // include $_GET['page'] . '/index.php;
        // } else{
        //     // include 'admin/template/homePemilik.php'; // kalau untuk pemilik KAYAKNYA sama
        // }
    // }
// } else{
//     header("Location: Login.php");
// } 