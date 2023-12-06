<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

//include fungsi/pesan_kilat.php;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kantin JTI</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="components/css/Login.css">
</head>
<body>
  <div class="header">
    <img src="assets/Logo-JTI.png" alt="">
    <h1>Kantin JTI POLINEMA</h1>
  </div>
  <div class="login-box">
    <h2>Login</h2>
    <form action="cek_login.php" method="post">
      <?php
      if (isset($_SESSION['_flashdata'])) {
        foreach ($_SESSION['_flashdata'] as $key => $val) {
            //echo get_flashdata($key);
        }
      }
      ?>
      <div class="user-box">
        <input type="text" name="Username" placeholder="Username" required="">
        <label>Username</label>
      </div>
      <div class="user-box">
        <input type="password" name="Password" placeholder="Password" required="">
        <label>Password</label>
      </div>
      <!-- sementara pake home.php untuk login -->
      <a href="index.php"> 
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        Submit
      </a>
    </form>
  </div>
</a>
</body>
</html>