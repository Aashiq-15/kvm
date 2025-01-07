<?php
include 'dbconnect.php';

// Handle form submission
if (isset($_POST['submit'])) {
    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);

    // Insert advertisement details without image path
    $sql = "INSERT INTO services (title, description, date) VALUES ('$title', '$description', current_timestamp())";
    $result = mysqli_query($conn, $sql);
    $servId = $conn->insert_id; // Get the ID of the newly created advertisement

    if ($result) {
        // Check if the uploaded file is a valid image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            // Define the new filename and upload path
            $newfilename = "service-" . $servId . ".jpg";
            $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/kvm/assets/img/services/';
            $uploadfile = $uploaddir . $newfilename;

            // Attempt to move the uploaded file to the designated directory
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
                // Update the advertisement record with the image filename
                $updateSql = "UPDATE services SET image = '$newfilename' WHERE id = $servId";
                mysqli_query($conn, $updateSql);

                echo "<script>alert('Service created successfully');
                        window.location=document.referrer;
                    </script>";
            } else {
                echo "<script>alert('Failed to upload image');
                        window.location=document.referrer;
                    </script>";
            }
        } else {
            echo "<script>alert('Please select a valid image file to upload');
                    window.location=document.referrer;
                </script>";
        }
    } else {
        echo "<script>alert('Failed to create service');
                window.location=document.referrer;
            </script>";
    }
}

// ... (rest of the code remains the same)
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Check if a new image is uploaded, if so, handle the upload
    if (!empty($_FILES['image']['tmp_name'])) {
        $imagePath = "/kvm/assets/img/services/service-$id.jpg";
        move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $imagePath);
    }

    // Update advertisement details in the database
    $description = str_replace("'", "''", $description);
    $sql = "UPDATE services SET title='$title', description='$description',  date=current_timestamp() WHERE id='$id'";
    $conn->query($sql);

    echo "<script>alert('Services updated successfully');
    window.location=document.referrer;
        </script>";
}

// delete_ad.php

if (isset($_POST['delete'])) {
    $id = $_POST['service_id'];

    // Delete the image
    $imagePath = $_SERVER['DOCUMENT_ROOT'] . "/kvm/assets/img/services/service-$id.jpg";
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }

    // Delete the advertisement from the database
    $sql = "DELETE FROM services WHERE id='$id'";
    $conn->query($sql);

    echo "<script>alert('Services deleted successfully');
    window.location=document.referrer;
</script>";
}
?>
