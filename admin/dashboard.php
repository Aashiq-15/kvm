<?php
include 'partials/dbconnect.php'; // Include database connection file

// Initialize variables
$total_users = $total_active_ads = $total_messages = $total_packages = $total_completed_bookings = $total_pending_bookings = 0;

// Fetch data from the database
// Total users with the role of 'user'
$result = $conn->query("SELECT COUNT(*) AS total FROM users WHERE role = 'user'");
$total_users = $result->fetch_assoc()['total'];

// Total active advertisements
$result = $conn->query("SELECT COUNT(*) AS total FROM advertisements WHERE status = 'active'");
$total_active_ads = $result->fetch_assoc()['total'];

// Total messages
$result = $conn->query("SELECT COUNT(*) AS total FROM messages");
$total_messages = $result->fetch_assoc()['total'];

// Total packages
$result = $conn->query("SELECT COUNT(*) AS total FROM packages");
$total_packages = $result->fetch_assoc()['total'];

// Total completed bookings
$result = $conn->query("SELECT COUNT(*) AS total FROM bookings WHERE state = 'completed'");
$total_completed_bookings = $result->fetch_assoc()['total'];

// Total pending bookings
$result = $conn->query("SELECT COUNT(*) AS total FROM bookings WHERE state != 'completed'");
$total_pending_bookings = $result->fetch_assoc()['total'];

// Close the connection
$conn->close();
?>

<div class="container  my-5">
    <div class="row mx-5">
        <!-- Total Users Card -->
        <div class="col-md-4 mb-4">
            <div class="card shadow text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text"><?php echo $total_users; ?></p>
                </div>
            </div>
        </div>

        <!-- Total Active Ads Card -->
        <div class="col-md-4 mb-4">
            <div class="card shadow text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Active Advertisements</h5>
                    <p class="card-text"><?php echo $total_active_ads; ?></p>
                </div>
            </div>
        </div>

        <!-- Total Messages Card -->
        <div class="col-md-4 mb-4">
            <div class="card shadow text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Total Messages</h5>
                    <p class="card-text"><?php echo $total_messages; ?></p>
                </div>
            </div>
        </div>

        <!-- Total Packages Card -->
        <div class="col-md-4 mb-4">
            <div class="card shadow text-white bg-info">
                <div class="card-body">
                    <h5 class="card-title">Total Packages</h5>
                    <p class="card-text"><?php echo $total_packages; ?></p>
                </div>
            </div>
        </div>

        <!-- Total Completed Bookings Card -->
        <div class="col-md-4 mb-4">
            <div class="card shadow text-white bg-dark">
                <div class="card-body">
                    <h5 class="card-title">Completed Bookings</h5>
                    <p class="card-text"><?php echo $total_completed_bookings; ?></p>
                </div>
            </div>
        </div>

        <!-- Total Pending Bookings Card -->
        <div class="col-md-4 mb-4">
            <div class="card shadow text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Pending Bookings</h5>
                    <p class="card-text"><?php echo $total_pending_bookings; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
