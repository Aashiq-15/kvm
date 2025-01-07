<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>KVM | Home Page</title>


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/isotope-layout@3.0.6/dist/isotope.min.css">
    <link href="https://cdn.jsdelivr.net/npm/glightbox@3.0.9/dist/css/glightbox.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">



    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet">



</head>

<body class="index-page">

    <?php
    include 'forms/navbar.php'; ?>

    <section id="pricing" class="pricing mt-5 section light-background">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Packages</h2>
            <p>Best Packages for Our Studio's</p>
        </div><!-- End Section Title -->

        <div class="container">
            <div class="row gy-4">
                <?php
                include 'partials/db.php'; // Database connection file

                // Query to fetch packages from the database
                $sql = "SELECT * FROM packages"; // Assuming your table is named 'packages'
                $result = $conn->query($sql);

                // Check if there are any packages
                if ($result && $result->num_rows > 0) {
                    // Loop through each package
                    while ($row = $result->fetch_assoc()) {
                        $packageId = $row['package_id'];
                        $packageName = $row['package_name'];
                        $price = $row['price'];
                        $duration = $row['hours'];
                        $description = $row['description'];
                        $point1 = $row['point1'];
                        $point2 = $row['point2'];
                        $point3 = $row['point3'];
                        $point4 = $row['point4'];
                        $point5 = $row['point5'];
                ?>
                        <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="200">
                            <div class="pricing-item">
                                <h3><?php echo $packageName; ?></h3>
                                <h4><sup>Rs</sup><?php echo $price; ?><span> / <?php echo $duration; ?> hrs</span></h4>
                                <ul>
                                    <li><i class="bi bi-check"></i> <span><?php echo $point1; ?></span></li>
                                    <li><i class="bi bi-check"></i> <span><?php echo $point2; ?></span></li>
                                    <li><i class="bi bi-check"></i> <span><?php echo $point3; ?></span></li>
                                    <li><i class="bi bi-check"></i> <span><?php echo $point4; ?></span></li>
                                    <li><i class="bi bi-check"></i> <span><?php echo $point5; ?></span></li>
                                </ul>
                                <?php 
                                  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                                ?>
                                <a href="#" class="buy-btn" data-bs-toggle="modal" data-bs-target="#avlModal"
                                    data-package-id="<?php echo $packageId; ?>"
                                    data-package-name="<?php echo $packageName; ?>"
                                    data-package-price="<?php echo $price; ?>"
                                    data-package-duration="<?php echo $duration; ?>"
                                    data-package-description="<?php echo $description; ?>"
                                    data-package-point1="<?php echo $point1; ?>"
                                    data-package-point2="<?php echo $point2; ?>"
                                    data-package-point3="<?php echo $point3; ?>"
                                    data-package-point4="<?php echo $point4; ?>"
                                    data-package-point5="<?php echo $point5; ?>">Book Now</a>
                                <?php } else { ?>
                                  <a href="#" class="buy-btn"
                                    class="btn btn-getstarted" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#loginModal">Login to fearther move</a>
                                <?php } ?>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo "<div class='col-12 text-center'><p>No packages available at the moment.</p></div>";
                }

                // Close the database connection
                $conn->close();
                ?>

            </div>
        </div>

    </section>

<!-- Modal Popup for "Book Now" -->
<div class="modal fade" id="avlModal" tabindex="-1" role="dialog" aria-labelledby="avlModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header d-flex">
        <h5 class="modal-title" id="avlModal">Check Availability</h5>
        <button style="margin-left:190px; border:none;" type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="partials/booking.php" method="post">
        <div class="text-left my-2">
            <label for="email">Email</label>
            <input class="form-control" id="email" name="email" placeholder="your email" value="" type="email" required>
          </div>
          <div class="text-left my-2">
            <label for="date">Date</label>
            <input class="form-control" id="date" name="date" placeholder="Select Date" type="date" required>
          </div>
          <div class="text-left my-2">
            <label for="place">Place</label>
            <input class="form-control" id="place" name="place" placeholder="Enter Your Place" type="text" required>
          </div>
          <div class="text-left my-2">
            <label for="time">Time</label>
            <input class="form-control" id="time" name="time" placeholder="Select Your Time" type="time" required>
          </div>
          <div class="text-left my-2">
            <label for="package">Package</label>
            <select class="form-select" id="package" name="package" required>
                <!-- Options will be dynamically added here -->
                <option value="">Select a package</option>
                <!-- JavaScript will fill this with the selected package name and other details -->
            </select>
          </div>
          <button type="submit" name="book" class="btn btn-success">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
// JavaScript to populate the modal form with package details
document.addEventListener('DOMContentLoaded', function () {
    var avlModal = document.getElementById('avlModal');
    avlModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var packageName = button.getAttribute('data-package-name');
        var packageId = button.getAttribute('data-package-id');
        document.getElementById('package').innerHTML = `<option value="${packageId}">${packageName}</option>`;
    });
});

</script>

    <?php
    include 'forms/footer.php';
    ?>


    <!-- Scripts for Isotope, AOS, GLightbox -->
    <script src="https://cdn.jsdelivr.net/npm/isotope-layout@3.0.6/dist/isotope.pkgd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/glightbox@3.0.9/dist/glightbox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>


    <script src="assets/js/new.js"></script>
    <script src="assets/js/main.js"></script>




</body>

</html>