<?php
// Assuming the username is stored in the session after login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // If the user is not logged in, redirect to the login page
    header("Location: /kvm/index.php");
    exit;
}

// Get the first letter of the username
$username = $_SESSION['username'];
$firstLetter = strtoupper(substr($username, 0, 1));
?>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light shadow bg-light">
    <div class="ml-auto">
        <!-- Show username and profile picture -->
        <span class="navbar-text mr-3">Hello, <?php echo $username; ?></span>
        <!-- Display the first letter of the username as profile picture -->
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="rounded-circle" style="width: 30px; height: 30px; display: inline-block; background-color: #007bff; color: white; text-align: center; line-height: 30px;"><?php echo $firstLetter; ?></span>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="./partials/logout.php">Logout</a>
            </div>
        </div>
    </div>
</nav>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-heading">KVM </div>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=bookings"><i class="fas fa-calendar-alt"></i> Bookings</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=advertisement"><i class="fas fa-bullhorn"></i> Advertisements</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=portfolio"><i class="fas fa-briefcase"></i> Portfolios</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=package"><i class="fas fa-box"></i> Packages</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=service"><i class="fas fa-concierge-bell"></i> Services</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=message"><i class="fas fa-envelope"></i> Messages</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?page=user"><i class="fas fa-users"></i> Users</a>
        </li>
    </ul>
</div>
