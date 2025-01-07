<?php
include 'dbconnect.php';

if (isset($_POST['submit'])) {
    // Signup process
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // Check if passwords match
    if ($password != $cpassword) {
        echo  '<script>alert("The passwords do not match!"); window.location=document.referrer;</script>';
        exit;
    }

    // Check if username already exists
    $sql = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo  '<script>alert("Username already exists!"); window.location=document.referrer;</script>';
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user into database with role 'admin' by default
        $sql = "INSERT INTO users (username, email, phone, password, role) VALUES (?, ?, ?, ?, 'admin')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $email, $phone, $hashed_password);

        if ($stmt->execute()) {
            echo  '<script>alert("Account created successfully!"); window.location=document.referrer;</script>';
        } else {
            echo  '<script>alert("Error occurred. Please try again later!"); window.location=document.referrer;</script>';
        }
    }
    $stmt->close();
} 

if (isset($_POST['update'])) {
    $id = $_POST['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    // Update user details without handling image
    $sql;
    $stmt = null;
    if ($password != '') {
        if ($password == $confirm) {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET username=?, password=?, email=?, phone=?, address=? WHERE user_id=?";
            $stmt = $conn->prepare($sql);;
            $stmt->bind_param("sssssi", $username, $password_hash, $email, $contact, $address, $id);
        } else {
            echo '<script>alert("Invalid credentials");window.location=document.referrer;</script>';
        }
    } else {
        $sql = "UPDATE users SET username=?, email=?, phone=?, address=? WHERE user_id=?";
        $stmt = $conn->prepare($sql);;
        $stmt->bind_param("ssssi", $username, $email, $contact, $address, $id);
    }

    if ($stmt != null && $stmt->execute()) {
        echo '<script>alert("User details updated successfully!"); window.location=document.referrer;</script>';
    }

    if ($stmt != null) {    
        $stmt->close();
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['user_id'];
    $stmt = $conn->prepare("DELETE FROM users WHERE user_id=?");

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo '<script>alert("User deleted successfully!"); window.location=document.referrer;</script>';
    } else {
        echo "Error deleting user: " . $stmt->error;
    }
    $stmt->close();
}
?>
