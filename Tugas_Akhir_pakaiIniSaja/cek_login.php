<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "config/koneksi.php";
include "function/pesanKilat.php";
include "function/antiInjection.php";

$username = antiinjection($koneksi, $_POST['username']);
$password = antiinjection($koneksi, $_POST['password']);

$query = "SELECT username, level, password FROM users WHERE username = '$username'";
$result = mysqli_query($koneksi, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        mysqli_close($koneksi);
        // $salt=$row['salt'];
        $hashed_password = password_hash($row['password'], PASSWORD_DEFAULT);
        echo $password . "password <br>";
        echo $hashed_password . "hashed <br>";
        if ($hashed_password !== null) {
            if (password_verify($password, $hashed_password)) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['level'] = $row['level'];
                header("Location: index.php");
            } else {
                pesan('danger', "Login gagal. Password Anda Salah");
                header("Location: login.php");
                // echo "Apa ini";
            }
        } else {
            pesan('warning', "Username tidak ditemukan.");
            header("Location: login.php");
            // echo "Atau ini";
        }
    } else {
        echo "Username tidak ditemukan";
    }
} else {
    echo "Query error: " . mysqli_error($koneksi);
}
// header("Location: index.php");
