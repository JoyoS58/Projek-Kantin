<!-- KALAU KALIAN SUDAH PULL SIAP-SIAP ADA ERROR CSS YA ^_^ -->
<link rel="stylesheet" href="components/css/styleSidebarKasir.css">
<nav>
        <?php
        require 'Head.php';
        ?>
      <div class="sidebar">
        <div class="logo">
          <i class="bx bx-menu menu-icon"></i>
          <span class="logo-name">Dashboard</span>
        </div>

        <div class="sidebar-content">
          <ul class="lists">
            <li class="list">
              <a href="index.php" class="nav-link">
                <i class="bx bx-home-alt icon"></i>
                <span class="link">Dashboard</span>
              </a>
            </li>
            <li class="list">
              <a aria-current="page" href="index.php?page=kasir" class="nav-link"> 
                <!-- untuk href lain tambahkan kayak gini + kasih aria-current ya  TERGANTUNG LOKASI FILENYA!!!-->
                <i class="bx bx-bar-chart-alt-2 icon"></i>
                <span class="link">Transaksi</span>
              </a>
            </li>
            <li class="list">
              <a aria-current="page" href="index.php?page=barang" class="nav-link">
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
              <a aria-current="page" href="index.php?page=supplier" class="nav-link">
                <i class="bx bxs-truck icon"></i>
                <span class="link">Supplier</span>
              </a>
            </li>
            <li class="list">
              <a aria-current="page" href="index.php?page=return" class="nav-link">
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

    <script src="components/js/scriptMenu.js"></script>
    