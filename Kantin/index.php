<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();

    if(isset($_SESSION['user']) && isset($_SESSION['levelUser'])){
        include "koneksi.php";
        $level = $_SESSION['levelUser'];

        if($level === "kasir"){
            header("Location: User/Kasir/home.php");
        }elseif($level === "pemilik"){
            header("Location: User/Pemilik/home.php");
        }
    }else{
        header("Location: Login.php");
    }
}

?>