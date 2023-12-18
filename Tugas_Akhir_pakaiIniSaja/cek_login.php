<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['Username'];
    $password = $_POST['Password'];

    include "config/koneksi.php";
    $database = new Database();
    $koneksi = $database->getConnection();

    if ($koneksi->connect_error) {
        die("Connection Failed " . $koneksi->connect_error);
    }

    if ($koneksi) {
        // Sanitize input to prevent SQL injection
        $username = mysqli_real_escape_string($koneksi, $username);

        $query = "SELECT ID_USER, PASSWORD, LEVEL FROM users WHERE USERNAME = '$username'";
        $result = mysqli_query($koneksi, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            if ($row && md5($password) === $row['PASSWORD']) {
                $_SESSION["user"] = $row['ID_USER'];
                $_SESSION["levelUser"] = $row['LEVEL'];

                if ($row['LEVEL'] === "kasir") {
                    header("Location: index.php");
                }elseif ($row['LEVEL'] === "pemilik") {
                    header("Location: index.php");
                }
            }
        }

        mysqli_close($koneksi);
    }
}
?>