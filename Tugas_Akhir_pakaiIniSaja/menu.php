<!DOCTYPE html>
<!-- Coding By CodingNepal - codingnepalweb.com -->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>Sidebar Menu | Side Navigation Bar</title>
    <!-- CSS -->
    <link rel="stylesheet" href="components/css/styleSidebarKasir.css">
    <!-- Boxicons CSS -->
    <link
      href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css"
      rel="stylesheet"
    />
  </head>
  <body>
    <nav>
        <?php
        // require 'Head.php';
        ?>
      <div class="sidebar">
        <div class="logo">
          <i class="bx bx-menu menu-icon"></i>
          <span class="logo-name">Dashboard</span>
        </div>

        <div class="sidebar-content">
          <ul class="lists">
            <li class="list">
              <a href="home.php" class="nav-link">
                <i class="bx bx-home-alt icon"></i>
                <span class="link">Dashboard</span>
              </a>
            </li>
            <li class="list">
              <a href="../Tugas_Akhir_pakaiIniSaja/kasir/pilihBarang.php" class="nav-link">
                <i class="bx bx-bar-chart-alt-2 icon"></i>
                <span class="link">Transaksi</span>
              </a>
            </li>
            <li class="list">
              <a href="dataBarang.php" class="nav-link">
                <i class="bx bx-bell icon"></i>
                <span class="link">Data Barang</span>
              </a>
            </li>
            <li class="list">
              <a href="history.php" class="nav-link">
                <i class="bx bx-history icon"></i>
                <span class="link">History</span>
              </a>
            </li>
            <li class="list">
              <a href="dataSupplier.php" class="nav-link">
                <i class="bx bxs-truck icon"></i>
                <span class="link">Supplier</span>
              </a>
            </li>
            <li class="list">
              <a href="dataPenjualanSupplier.php" class="nav-link">
                <i class="bx bx-basket icon"></i>
                <span class="link">Return</span>
              </a>
            </li>

          <div class="bottom-content">
            <li class="list">
              <a href="#" class="nav-link">
                <i class="bx bx-cog icon"></i>
                <span class="link">Settings</span>
              </a>
            </li>
            <li class="list">
              <a href="#" class="nav-link">
                <i class="bx bx-log-out icon"></i>
                <span class="link">Logout</span>
              </a>
            </li>
          </div>
        </div>
      </div>
    </nav>

    <section class="overlay"></section>

    <script src="../Tugas_Akhir_pakaiIniSaja/components/js/scriptMenuKasir.js"></script>
  </body>
</html>