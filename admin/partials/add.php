<?php
include 'dbconnect.php';

// Handle form submission
if (isset($_POST['submit'])) {
    $title = $_POST["title"];
    $description = $_POST["description"];

    // Insert advertisement details without image path
    $sql = "INSERT INTO advertisements (title, description, add_date ) VALUES ('$title', '$description', current_timestamp())";
    $result = mysqli_query($conn, $sql);
    $adId = $conn->insert_id; // Get the ID of the newly created advertisement

    if ($result) {
        // Check if the uploaded file is a valid image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            // Define the new filename and upload path
            $newfilename = "ads-" . $adId . ".jpg";
            $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/kvm/assets/img/ads/';
            $uploadfile = $uploaddir . $newfilename;

            // Attempt to move the uploaded file to the designated directory
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
                // Update the advertisement record with the image filename
                $updateSql = "UPDATE advertisements SET image = '$newfilename' WHERE id = $adId";
                mysqli_query($conn, $updateSql);

                echo "<script>alert('Advertisement created successfully');
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
        echo "<script>alert('Failed to create advertisement');
                window.location=document.referrer;
            </script>";
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    // Check if a new image is uploaded, if so, handle the upload
    if (!empty($_FILES['image']['tmp_name'])) {
        $imagePath = "/kvm/assets/img/ads/ads-$id.jpg";
        move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $imagePath);
    }

    // Update advertisement details in the database
    $sql = "UPDATE advertisements SET title='$title', description='$description', status='$status', dis_date=current_timestamp() WHERE id='$id'";
    $conn->query($sql);

    echo "<script>alert('Advertisement updated successfully');
    window.location=document.referrer;
        </script>";
}

// delete_ad.php

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the image
    $imagePath = $_SERVER['DOCUMENT_ROOT'] . "/kvm/assets/img/ads/ads-$id.jpg";
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }

    // Delete the advertisement from the database
    $sql = "DELETE FROM advertisements WHERE id='$id'";
    $conn->query($sql);

    echo "<script>alert('Advertisement deleted successfully');
    window.location=document.referrer;
</script>";
}



$conn->close();
