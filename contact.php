<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>KVM | contact Page</title>
  <meta name="description" content="">
  <meta name="keywords" content="">


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
  include 'forms/conn.php';
  include 'forms/navbar.php';
  ?>


  <main class="main mt-5">
    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Contact us for Further Details</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        ?>
          <div class="d-flex justify-content-end mb-3">
            <button type="button" class="btn shadow rounded-3 p-2 text-danger" data-bs-toggle="modal" data-bs-target="#response">
              <i class="bi bi-envelope"></i>&nbsp;Response
            </button>
          </div>
        <?php } ?>
        <div class="row gy-4">

          <div class="col-lg-5">

            <div class="info-wrap">
              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                  <h3>Address</h3>
                  <p>123 Main Street 
                    Kilinotchi, Sri Lanka</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                <i class="bi bi-telephone flex-shrink-0"></i>
                <div>
                  <h3>Call Us</h3>
                  <p>+94 77 123 4567</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                  <h3>Email Us</h3>
                  <p>contact@kvmcreations.lk</p>
                </div>
              </div><!-- End Info Item -->

              <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15745.805955829359!2d80.4082594!3d9.3817111!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3afe95365635b647%3A0x59e5c9f9476636d0!2skvm%20creations%20studio!5e0!3m2!1sen!2slk!4v1730526418778!5m2!1sen!2slk"
                frameborder="0" style="border:0; width: 100%; height: 270px;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
          </div>

          <div class="col-lg-7">

            <form action="partials/contact.php" method="post" class="php-email-form" data-aos="fade-up"
              data-aos-delay="200">
              <div class="row gy-4">

                <div class="col-md-6">
                  <label for="name-field" class="pb-2">Your Name</label>
                  <input type="text" name="name" id="name-field" class="form-control" required value="<?php if (isset($_SESSION['username'])) echo $_SESSION['username']; ?>">
                </div>

                <div class="col-md-6">
                  <label for="email-field" class="pb-2">Your Email</label>
                  <input type="email" class="form-control" name="email" id="email-field" required value="<?php if (isset($_SESSION['email'])) echo $_SESSION['email']; ?>">
                </div>

                <div class="col-md-12">
                  <label for="subject-field" class="pb-2">Subject</label>
                  <input type="text" class="form-control" name="subject" id="subject-field" required>
                </div>

                <div class="col-md-12">
                  <label for="message-field" class="pb-2">Message</label>
                  <textarea class="form-control" name="message" rows="10" id="message-field" required></textarea>
                </div>
                <?php
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                ?>
                  <div class="col-md-12 text-center">
                    <button type="submit">Send Message</button>
                  </div>
                <?php } ?>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->
    <div class="modal fade" id="response" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="text-light fs-5" id="exampleModalLabel">My Conversation</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div>
              <?php
                $userId = $_SESSION['user_id'];
                $retrieve = "SELECT * FROM messages WHERE user_id = '$userId'";
                $stmt = $conn->prepare($retrieve);
                if ($result = $stmt->execute()) {
                  $result = $stmt->get_result();
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      $msgId = $row['id'];
                      echo '
                        <div class="text-end">
                          <h7 class="text-light">(:Me</h7>
                          <p class="text-end">'.$row['message'].'</p>
                        <div>
                      ';
                      $res_stmt = $conn->prepare("SELECT * FROM reply WHERE message_id = '$msgId';");
                      if ($res_stmt->execute()) {
                        $res_result = $res_stmt->get_result();
                        if ($res_result->num_rows > 0) {
                          while($row = $res_result->fetch_assoc()) {
                            echo '
                              <div class="text-start">
                                <h7 class="text-light">Admin:)</h7>
                                <p class="text-start">'.$row['message'].'</p>
                              <div>
                            ';
                          }
                        }
                      }
                    }
                  } else {
                    echo '<p class="text-center">There is no conversation!</p>';
                  }
                }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <div class="section light-background">
    <?php
    include 'forms/footer.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/isotope-layout@3.0.6/dist/isotope.pkgd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/glightbox@3.0.9/dist/glightbox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"></script>

    <script src="assets/js/new.js"></script>
    <script src="assets/js/main.js"></script>
  </div>
</body>

</html>