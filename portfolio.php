<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>KVM</title>
  <meta name="description" content="">
  <meta name="keywords" content="">


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
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body class="portfolio-details-page">

  <?php
  include 'forms/navbar.php';
  ?>

  <main class="main mt-5">


    <!-- Portfolio Details Section -->
    <section id="portfolio" class="portfolio section light-background">
    <div class="container section-title" data-aos="fade-up">
      <h2>Portfolio</h2>
      <p>Collections of  Our Photoshoots</p>
    </div>
    <div class="container">
      <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
        <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
          <li data-filter="*" class="filter-active">All</li>
          <li data-filter=".filter-birthday">Birthday</li>
          <li data-filter=".filter-wedding">Wedding</li>
          <li data-filter=".filter-event">Event</li>
        </ul>
        <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
          <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-birthday">
            <img src="./assets/img/b1.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Birthday</h4>
              <p>abana</p>
              <a href="#" title="More Details" class="details-link"><i
                  class="bi bi-link-45deg"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-wedding">
            <img src="./assets/img/b2.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Wedding</h4>
              <p></p>
              <a href="#" title="More Details" class="details-link"><i
                  class="bi bi-link-45deg"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-event">
            <img src="./assets/img/b3.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Event</h4>
              <p></p>
              <a href="#" title="More Details" class="details-link"><i
                  class="bi bi-link-45deg"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  </main>


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

</body>

</html>