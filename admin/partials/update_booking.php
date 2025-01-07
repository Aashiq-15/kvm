<?php
include 'dbconnect.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $booking_id = $_POST['booking_id'];
    if (isset($_POST['edit'])) {
        // Get the data from the form
        $state = $_POST['state'];

        // Update the booking details in the database
        $sql = "UPDATE bookings SET 
                    state = '$state' 
                WHERE booking_id = '$booking_id'";

        $stmt = $conn->prepare($sql);

        if ($stmt->execute()) {
            echo '<script>window.location=document.referrer</script>';
        } else {
            echo "<script>alert('" . $stmt->error . "');window.location=document.referrer;</script>";
        }
    } else if (isset($_POST['delete'])) {

        $sql = "DELETE FROM bookings WHERE booking_id = '$booking_id'";

        $stmt = $conn->prepare($sql);

        if ($stmt->execute()) {
            echo '<script>window.location=document.referrer</script>';
        } else {
            echo "<script>alert('" . $stmt->error . "');window.location=document.referrer;</script>";
        }
    }
}

$conn->close();
