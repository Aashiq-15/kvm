<?php

include 'db.php';
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function sendemail_invoice($username, $email, $id, $package, $date, $place, $time) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mathusha1612@gmail.com'; 
        $mail->Password = 'qrwicjbwotocaalw';       
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom('mathusha1612@gmail.com', 'KVM Creations');
        $mail->addAddress($email); // Recipient
        $mail->addBCC('mathusha1612@gmail.com'); // Sender receives a copy

        $mail->isHTML(true);
        $mail->Subject = 'Booking Confirmation From KVM Creations';

        $email_template = "
        <div style='padding-top:10px;' class='container'>
            <div class='jumbotron'>
                <h1 class='text-center' style='color: green;'><span class='glyphicon glyphicon-ok-circle'></span> Booking Confirmed.</h1>
            </div>
            <h2 class='text-center'> Thank you for choosing KVM Creation! </h2>
            <h3 class='text-center'> <strong>Your Booking Number:</strong> <span style='color: blue;'>'.$id.'</span> </h3>
            <div class='container'>
                <div class='box'>
                    <div class='col-md-10' style='float: none; margin: 0 auto;'>
                        <h3 style='color: orange;'>Your booking has been received and placed into our order processing system.</h3>
                        <h4>We will <strong>contact you</strong> very soon!</h4>
                        <br><h3 style='color: orange;'>Order Details</h3>
                    </div>
                    <div class='col-md-10' style='float: none; margin: 0 auto;'>
                        <h4> <strong>Name: </strong>'.$username.'</h4>
                        <h4> <strong>Email: </strong>'.$email.'</h4>
                        <h4> <strong>Place: </strong>'.$place.'</h4>
                        <h4> <strong>Time:</strong> '.$time.'</h4>
                        <h4> <strong>Date:</strong> '.$date.'</h4>
                        <h4> <strong>Package:</strong> '.$package.'</h4>
                        <h4> <strong>Booking Date: </strong>'.date('Y-m-d').'</h4>
                    </div>
                </div>
            </div>'";
        
        $mail->Body = $email_template;

        if (!$mail->send()) {
            error_log("Mailer Error: " . $mail->ErrorInfo);
        }
    } catch (Exception $e) {
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
    }
}

if (isset($_POST['book'])) {
    $date = $_POST['date'];
    $place = $_POST['place'];
    $time = $_POST['time'];
    $package = $_POST['package'];

    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('Please log in to book.'); window.location.href = '/kvm/login.php';</script>";
        exit();
    }

    $user_id = $_SESSION['user_id'];

    $user_query = "SELECT username, email FROM users WHERE user_id = ?";
    $user_stmt = $conn->prepare($user_query);
    $user_stmt->bind_param("i", $user_id);
    $user_stmt->execute();
    $user_result = $user_stmt->get_result();
    $user_data = $user_result->fetch_assoc();

    $username = $user_data['username'];
    $email = $user_data['email'];

    $query = "SELECT * FROM bookings WHERE event_date = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $date);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Date already booked. Please try another date.');window.location.href = '/kvm/packages.php';</script>";
    } else {
        $query = "INSERT INTO bookings (user, booked, package, place, event_date, event_time, note, state)
                  VALUES (?, NOW(), ?, ?, ?, ?, '', 'pending')";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("issss", $user_id, $package, $place, $date, $time);

        if ($stmt->execute()) {
            $booking_id = $stmt->insert_id;
            sendemail_invoice($username, $email, $booking_id, $package, $date, $place, $time);
            echo "<script>alert('Booking successful! Confirmation email sent.'); window.location.href = '/kvm/packages.php';</script>";
        } else {
            echo "<script>alert('Booking failed. Please try again.');</script>";
        }
    }

    $stmt->close();
    $conn->close();
}
?>
