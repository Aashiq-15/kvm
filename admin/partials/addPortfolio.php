<?php
if (isset($_POST['submit'])) {
    // Retrieve and sanitize form data
    $customerName = mysqli_real_escape_string($conn, $_POST['customerName']);
    $photographyType = mysqli_real_escape_string($conn, $_POST['photographyType']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);

    // Insert portfolio details into the database
    $sql = "INSERT INTO portfolio (customer_name, photography_type, description, date) 
            VALUES ('$customerName', '$photographyType', '$description', '$date')";
    $result = mysqli_query($conn, $sql);
    $portfolioId = $conn->insert_id; // Get the ID of the newly created portfolio

    if ($result) {
        // Check if the uploaded cover photo is a valid image
        if ($_FILES['coverPhoto']['name']) {
            $coverPhotoCheck = getimagesize($_FILES['coverPhoto']['tmp_name']);
            if ($coverPhotoCheck !== false) {
                // Define the new filename for cover photo and upload path
                $coverNewFilename = "cover-" . $portfolioId . ".jpg";
                $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/kvm/assets/img/portfolio/';
                $coverUploadFile = $uploadDir . $coverNewFilename;

                // Attempt to move the uploaded cover photo file
                if (move_uploaded_file($_FILES['coverPhoto']['tmp_name'], $coverUploadFile)) {
                    // Update the portfolio record with the cover photo filename
                    $updateSql = "UPDATE portfolio SET cover_photo = '$coverNewFilename' WHERE id = $portfolioId";
                    mysqli_query($conn, $updateSql);
                } else {
                    echo "<script>alert('Failed to upload cover photo'); window.location=document.referrer;</script>";
                }
            } else {
                echo "<script>alert('Please select a valid cover photo image file'); window.location=document.referrer;</script>";
            }
        }

        // Handle other uploaded photos (photo1, photo2, etc.)
        for ($i = 1; $i <= 3; $i++) {
            if ($_FILES["photo$i"]['name']) {
                $photoCheck = getimagesize($_FILES["photo$i"]['tmp_name']);
                if ($photoCheck !== false) {
                    $newFilename = "portfolio-photo" . $i . "-" . $portfolioId . ".jpg";
                    $uploadFile = $uploadDir . $newFilename;
                    if (move_uploaded_file($_FILES["photo$i"]['tmp_name'], $uploadFile)) {
                        // Insert into a photos table or update portfolio record with photo filenames
                        $updateSql = "UPDATE portfolio SET photo$i = '$newFilename' WHERE id = $portfolioId";
                        mysqli_query($conn, $updateSql);
                    } else {
                        echo "<script>alert('Failed to upload photo $i'); window.location=document.referrer;</script>";
                    }
                } else {
                    echo "<script>alert('Please select a valid image file for photo $i'); window.location=document.referrer;</script>";
                }
            }
        }

        // Success message
        echo "<script>alert('Portfolio added successfully!'); window.location=document.referrer;</script>";
    } else {
        echo "<script>alert('Failed to add portfolio'); window.location=document.referrer;</script>";
    }
}
?>
