<?php
session_start();
?>

<header id="header" class="header d-flex align-items-center fixed-top">
  <div class="container-fluid container-xl position-relative d-flex align-items-center">

    <a href="index.php" class="logo d-flex align-items-center me-auto">
      <h1 class="sitename">KVM</h1>
    </a>

    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="index.php" class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Home</a></li>
        <li><a href="services.php" class="<?= basename($_SERVER['PHP_SELF']) == 'services.php' ? 'active' : ''; ?>">Services</a></li>
        <li><a href="portfolio.php" class="<?= basename($_SERVER['PHP_SELF']) == 'portfolio.php' ? 'active' : ''; ?>">Portfolio</a></li>
        <li><a href="packages.php" class="<?= basename($_SERVER['PHP_SELF']) == 'package.html' ? 'active' : ''; ?>">Packages</a></li>
        <li><a href="contact.php" class="<?= basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>">Contact</a></li>
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>

    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
      <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
          <span class="user-initial mx-2 bg-primary text-white rounded-circle text-center" style="width: 40px; height: 40px; display: inline-flex; align-items: center; justify-content: center;">
            <?= strtoupper(substr($_SESSION['username'], 0, 1)); ?>
          </span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end text-small" aria-labelledby="userDropdown">
          <li><a class="dropdown-item" href="#">Profile</a></li>
          <li><a class="dropdown-item" href="bookings.php">My Bookings</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="./partials/logout.php">Logout</a></li>
        </ul>
      </div>
    <?php else: ?>
      <button type="button" class="btn btn-getstarted" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
    <?php endif; ?>
  </div>
</header>
<?php 
include 'login.php';
include 'signup.php';
?>
