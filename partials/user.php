<?php
session_start();
include 'db.php'; // Replace with your actual database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['signup'])) {
        // Signup process
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        // Check if passwords match
        if ($password != $cpassword) {
            echo "<script>
                    alert('Passwords do not match.');
                    window.location.href = '/kvm/index.php';
                  </script>";
            exit;
        }

        // Check if username already exists
        $sql = "SELECT * FROM users WHERE username=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            echo "<script>
                    alert('Username already exists.');
                    window.location.href = '/kvm/index.php';
                  </script>";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert user into database
            $sql = "INSERT INTO users (username, email, phone, password, role) VALUES (?, ?, ?, ?, 'user')";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $username, $email, $phone, $hashed_password);

            if ($stmt->execute()) {
                echo "<script>
                        alert('Signup successful!');
                        window.location.href = '/kvm/index.php';
                      </script>";
            } else {
                echo "<script>
                        alert('Error occurred. Please try again.');
                        window.location.href = '/kvm/index.php';
                      </script>";
            }
        }
        $stmt->close();
    } 
    elseif (isset($_POST['login'])) {
        // Login process
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Check if username or password is empty
        if (empty($username) || empty($password)) {
            echo "<script>
                    alert('Username and password are required.');
                    window.location.href = '/kvm/index.php';
                  </script>";
            exit;
        }

        // Prepare statement to check if the user exists
        $sql = "SELECT * FROM users WHERE username=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Validate username and password
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            
            // Verify password
            if (password_verify($password, $user['password'])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $user['email'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['role'] = $user['role'];
                     
                // Redirect based on user role
                if ($user['role'] == 'admin') {
                    header("Location: /kvm/admin/index.php");
                } else {
                    header("Location: /kvm/index.php");
                }
                exit;
            } else {
                // Invalid password
                echo "<script>
                        alert('Invalid password.');
                        window.location.href = '/kvm/index.php';
                      </script>";
            }
        } else {
            // Invalid username
            echo "<script>
                    alert('Username does not exist.');
                    window.location.href = '/kvm/index.php';
                  </script>";
        }
        $stmt->close();
    }
}
?>
