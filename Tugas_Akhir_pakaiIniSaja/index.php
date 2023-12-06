<?php
if (session_status()=== PHP_SESSION_NONE){
    session_start();
}
// $user=$_GET['username'];
// if(!empty($user)){
    // require 'config/koneksi.php';
    // require 'function/pesanKilat.php';
    // if($user=="kasir"){
        if(!empty($_GET['page'])){
            // include 'admin/module/' . $_GET['page'] . '/index.php';
        } else{
            include 'home.php';
        }
        include 'menu.php';
        include 'Footer.php';
    // } else{
        // include 'admin/template/headPemilik.php';
        // if(!empty($_GET['page'])){
        //     // include 'admin/module/' . $_GET['page'] . '/index.php';
        // } else{
        //     // include 'admin/template/homePemilik.php';
        // }
    // }
// } else{
//     header("Location: Login.php");
// } 