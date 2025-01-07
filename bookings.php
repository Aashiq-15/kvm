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
    include 'forms/navbar.php';
    ?>

    <section id="about" class="about section mt-5">
        <div class="container section-title" data-aos="fade-up">
            <h2>My Bookings</h2>
        </div>
        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Booked Date</th>
                        <th>Package</th>
                        <th>Place</th>
                        <th>Event Date</th>
                        <th>Event Time</th>
                        <th>Note</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'forms/conn.php';

                    $userId = $_SESSION['user_id'];
                    $sql = "SELECT  b.booking_id, 
                                    u.username, 
                                    b.booked, 
                                    p.package_name, 
                                    b.place, 
                                    b.event_date, 
                                    b.event_time, 
                                    b.note, 
                                    b.state 
                                FROM bookings b
                                LEFT JOIN users u ON b.user = u.user_id -- Modify based on your actual 'users' table structure
                                LEFT JOIN packages p ON b.package = p.package_id WHERE u.user_id = $userId";

                    $result = $conn->query($sql);

                    // Check if there are any records
                    if ($result && $result->num_rows > 0) {
                        $bookings = [];
                        while ($row = $result->fetch_assoc()) {
                            $bookings[] = $row;
                        }
                    } else {
                        $bookings = [];
                    }

                    $conn->close();
                    ?>

                    <?php if (!empty($bookings)): ?>
                        <?php 
                            $i = 1;
                            foreach ($bookings as $booking): ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $booking['booked']; ?></td>
                                <td><?php echo $booking['package_name']; ?></td>
                                <td><?php echo $booking['place']; ?></td>
                                <td><?php echo $booking['event_date']; ?></td>
                                <td><?php echo $booking['event_time']; ?></td>
                                <td><?php echo $booking['note']; ?></td>
                                <td><?php echo ucfirst($booking['state']); ?></td>
                            </tr>
                        <?php $i++; endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="10" class="text-center">No bookings available.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

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