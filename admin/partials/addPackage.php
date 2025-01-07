<?php
include 'dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        // Retrieve form data
        $packageName = $_POST['name'];
        $price = $_POST['price'];
        $hours = $_POST['duration'];
        $description = $_POST['description'];
        $point1 = $_POST['point1'];
        $point2 = $_POST['point2'];
        $point3 = $_POST['point3'];
        $point4 = $_POST['point4'];
        $point5 = $_POST['point5'];
        $service1Id = $_POST['service1'];
        $service2Id = $_POST['service2'];

        // Prepare SQL query with all parameters matching
        $sql = "INSERT INTO packages (package_name, price, hours, description, point1, point2, point3, point4, point5, service1, service2)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        // Updated bind_param statement with the correct types and matching variables
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdissssssii", $packageName, $price, $hours, $description, $point1, $point2, $point3, $point4, $point5, $service1Id, $service2Id);

        // Execute query and check for success
        if ($stmt->execute()) {
            echo "<script>alert('Package added successfully!');
                window.location=document.referrer;
                </script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else if (isset($_POST['edit'])) {

    } else if (isset($_POST['delete'])) {
        $packageId = $_POST['package_id'];
        $sql = "DELETE FROM packages WHERE package_id = '$packageId'";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute()) {
            echo "<script>
                window.location=document.referrer;
                </script>";
        }
    }
}
?>
