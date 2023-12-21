<?php
session_start();

//include fungsi/pesan_kilat.php;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kantin JTI</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="Login.css">
  <link rel="icon" href="img/Logo-JTI.png" type="png">
</head>

<body>
  <div class="header">
    <img src="img/Man1.jpg" alt="">
    <h1>SIKAN</h1>
  </div>
  <div class="login-box">
    <h2>Login</h2>
    <form action="cek_login.php" method="post">
      <?php
      //if (isset($_SESSION['_flashdata'])) {
      //foreach ($_SESSION['_flashdata'] as $key => $val) {
      //echo get_flashdata($key);
      //}
      //}
      ?>
      <div class="user-box">
        <input type="text" id="Username" name="Username" placeholder="Username" required="">
        <label>Username</label>
      </div>
      <div class="user-box">
        <input type="password" id="Password" name="Password" placeholder="Password" required="">
        <label>Password</label>
      </div>
      <button type="submit">

        <span></span>
        <span></span>
        <span></span>
        <span></span>
        Submit

      </button>

    </form>
  </div>
  </a>
</body>

</html>