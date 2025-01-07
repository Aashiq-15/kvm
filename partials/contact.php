<?php

include 'db.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $userId = $_SESSION['user_id'];

    $message_sql = "INSERT INTO messages (subject, message, email, user_id) VALUES ('$subject', '$message', '$email', '$userId');";
    $stmt = $conn->prepare($message_sql);
    if ($stmt->execute()) {
        echo "<script>window.location.href = '/kvm/contact.php';alert('Message sent!');</script>";
    }
}