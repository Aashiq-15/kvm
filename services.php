<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>KVM | Services Page</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Fonts and Stylesheets -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body class="service-details-page">

<?php 
  include 'forms/navbar.php';
  include 'partials/db.php'; // Connect to the database

  // Fetch services from the database
  $services = [];
  $sql = "SELECT * FROM services";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $services[] = $row;
    }
  }
?>

<main class="main mt-5">

  <!-- Service Details Section -->
  <section id="service-details" class="service-details section">
    <div class="container">
      <div class="row">

        <!-- Left Sidebar with Service List -->
        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
          <div class="services-list">
            <?php foreach ($services as $service): ?>
              <a href="#" onclick="showServiceDetails(<?php echo $service['id']; ?>)"><?php echo htmlspecialchars($service['title']); ?></a>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Right Side: Service Details -->
        <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
          <div id="service-details-content" class="service-details-card" style="display: none;">
            <img id="service-image" src="" alt="Service Image" class="img-fluid mb-3">
            <h3 id="service-title"></h3>
            <p id="service-description"></p>
          </div>
        </div>

      </div>
    </div>
  </section>
</main>

<script>
  // Service details data from PHP to JavaScript
  const serviceDetails = <?php echo json_encode($services); ?>;

  // Show service details in the right pane
  function showServiceDetails(serviceId) {
    const service = serviceDetails.find(s => s.id == serviceId);

    if (service) {
      document.getElementById("service-title").innerText = service.title;
      document.getElementById("service-description").innerText = service.description;
      document.getElementById("service-image").src = `assets/img/services/service-${service.id}.jpg`; // Adjust image path as needed
      document.getElementById("service-details-content").style.display = "block";
    }
  }
</script>

<!-- Additional Styles -->
<style>
  .services-list a {
    display: block;
    padding: 10px;
    color: #333;
    text-decoration: none;
    border-bottom: 1px solid #ddd;
  }

  .services-list a:hover,
  .services-list a:focus {
    color: #0056b3;
    background-color: #f8f9fa;
  }

  .service-details-card img {
    border-radius: 8px;
    max-width: 100%;
  }

  .service-details-card h3 {
    margin-top: 20px;
    font-size: 1.75rem;
  }

  .service-details-card p {
    font-size: 1rem;
    color: #555;
  }
</style>

<div class="light-background">
  <?php include 'forms/footer.php'; ?>
</div>

<!-- Main JS Files -->
<script src="https://cdn.jsdelivr.net/npm/isotope-layout@3.0.6/dist/isotope.pkgd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/glightbox@3.0.9/dist/glightbox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="assets/js/main.js"></script>

</body>
</html>
