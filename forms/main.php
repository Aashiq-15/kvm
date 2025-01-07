<?php
// Database connection
include 'partials/db.php';

// Fetch advertisement images
$sql = "SELECT id FROM advertisements where status='active'";
$result = $conn->query($sql);

$imagePaths = [];
if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $imagePaths[] = "/kvm/assets/img/ads/ads-" . $row['id'] . ".jpg";
  }
}

// Convert image paths to a comma-separated string
$imagePathsStr = implode(', ', $imagePaths);
?>

<main class="main">

  <!-- Advertisement Section -->
  <section id="hero" class="hero section" data-images="<?php echo htmlspecialchars($imagePathsStr); ?>">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="zoom-out">
          <h1>Capture the Best Moments with Us</h1>
          <p>Save the Date.</p>
        </div>
      </div>
    </div>
  </section>


  <!-- About Section -->
  <section id="about" class="about section">
    <div class="container section-title" data-aos="fade-up">
      <h2>About KVM Creation</h2>
    </div>
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
          <p>
            At KVM Creation Studio, we are dedicated to capturing your most cherished moments with creativity and passion. Our team of experienced photographers specializes in providing high-quality photography services that reflect the essence of your events.
          </p>
          <ul>
            <li><i class="bi bi-check2-circle"></i> <span>Expertise in wedding and event photography.</span></li>
            <li><i class="bi bi-check2-circle"></i> <span>Personalized approach to every project.</span></li>
            <li><i class="bi bi-check2-circle"></i> <span>High-quality prints and digital images.</span></li>
          </ul>
        </div>
        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
          <p>
            We believe that every picture tells a story. Our goal is to make your memories last a lifetime through stunning visuals. Whether it's a wedding, a corporate event, or a personal photoshoot, KVM Creation Studio is here to turn your moments into timeless memories.
          </p>
          <a href="#" class="read-more"><span>More Details</span><i class="bi bi-arrow-right"></i></a>
        </div>
      </div>
    </div>
  </section>
  <!-- /About Section -->

  <!-- Why Us Section -->
  <section id="why-us" class="section why-us light-background" data-builder="section">
    <div class="container-fluid">
      <div class="row gy-4">
        <div class="col-lg-7 d-flex flex-column justify-content-center order-2 order-lg-1">
          <div class="content px-xl-5" data-aos="fade-up" data-aos-delay="100">
            <h3><span>Why You need </span><strong>KVM Creation</strong></h3>
            <p>
              At KVM Creation Studio, we pride ourselves on our creativity, attention to detail, and passion for photography. We strive to capture the essence of every moment, ensuring that your memories are preserved beautifully.
            </p>
          </div>
        </div>
        <div class="col-lg-5 order-1 order-lg-2 why-us-img">
          <img src="./assets/img/why-us.png" class="img-fluid" alt="KVM Creation Studio" data-aos="zoom-in" data-aos-delay="100">
        </div>
      </div>
    </div>
  </section>
  <!-- /Why Us Section -->

  <!-- Services Section -->
  <section id="services" class="services section ">
    <div class="container section-title" data-aos="fade-up">
      <h2>Services</h2>
      <p>Discover our range of photography services tailored for your special moments.</p>
    </div>
    <div class="container">
      <div class="row gy-4">
        <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
          <div class="service-item position-relative">
            <div class="icon"><i class="bi bi-camera icon"></i></div>
            <h4><a href="#" class="stretched-link">Wedding Photography</a></h4>
            <p>Capturing every moment of your special day with a blend of candid and traditional styles.</p>
          </div>
        </div>
        <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
          <div class="service-item position-relative">
            <div class="icon"><i class="bi bi-people icon"></i></div>
            <h4><a href="#" class="stretched-link">Event Photography</a></h4>
            <p>Professional coverage of your corporate events, birthdays, and celebrations.</p>
          </div>
        </div>
        <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
          <div class="service-item position-relative">
            <div class="icon"><i class="bi bi-person icon"></i></div>
            <h4><a href="#" class="stretched-link">Portrait Photography</a></h4>
            <p>Stunning family and individual portraits in our studio or beautiful outdoor settings.</p>
          </div>
        </div>
        <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
          <div class="service-item position-relative">
            <div class="icon"><i class="bi bi-graph-up icon"></i></div>
            <h4><a href="#" class="stretched-link">Commercial Photography</a></h4>
            <p>High-quality product and food photography to elevate your business branding.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /Services Section -->

  <!-- Call To Action Section -->
  <section id="call-to-action" class="call-to-action section dark-background">
    <img src="./assets/img/b1.jpg" alt="">
    <div class="container">
      <div class="row" data-aos="zoom-in" data-aos-delay="100">
        <div class="col-xl-9 text-center text-xl-start">
          <h3>Call To Action</h3>
          <p>Capture your memories with our professional photography services. 
            Whether it's a wedding, a family portrait, or an event, we ensure every moment is perfectly documented. 
            Our expert photographers are dedicated to providing high-quality images that you'll cherish forever. 
            </p>
        </div>
        <div class="col-xl-3 cta-btn-container text-center">
          <a class="cta-btn align-middle" href="#">Call To Action</a>
        </div>
      </div>
    </div>
  </section><!-- /Call To Action Section -->

  <!-- Portfolio Section -->
  <section id="portfolio" class="portfolio section light-background">
    <div class="container section-title" data-aos="fade-up">
      <h2>Portfolio</h2>
      <p>Collections of Our Photoshoots</p>
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
  <!-- /Portfolio Section -->



  <section class=" section light-background"></section>

</main>
