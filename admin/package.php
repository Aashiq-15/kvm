<div class="container mt-5">
  <!-- Add Package Form -->
  <section id="add-package" class="add-package section light-background">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Add New Package</h2>
      <p>Fill out the details below to add a new photography package.</p>
    </div><!-- End Section Title -->

    <?php
    include 'partials/dbconnect.php'; // Database connection file

    // Fetch service titles and IDs from the services table
    $serviceQuery = "SELECT id, title FROM services";
    $serviceResult = $conn->query($serviceQuery);
    ?>

    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-8 mx-auto">
          <div class="card shadow">
            <div class="card-header">
              <h4>Create New Package</h4>
            </div>
            <div class="card-body">
              <form action="partials/addPackage.php" method="post">
                <!-- Package Name -->
                <div class="form-group">
                  <label for="package_name">Package Name</label>
                  <input type="text" class="form-control" name="name" id="package_name" placeholder="Enter package name" required>
                </div>

                <!-- Price -->
                <div class="form-group mt-3">
                  <label for="price">Price (Rs)</label>
                  <input type="number" class="form-control" name="price" id="price" placeholder="Enter price" required>
                </div>

                <!-- Duration in Hours -->
                <div class="form-group mt-3">
                  <label for="duration">Duration (in hours)</label>
                  <input type="number" class="form-control" name="duration" id="duration" placeholder="Enter duration in hours" required>
                </div>

                <!-- Description -->
                <div class="form-group mt-3">
                  <label for="description">Package Description</label>
                  <textarea class="form-control" name="description" id="description" rows="4" placeholder="Enter package description"></textarea>
                </div>

                <!-- Key Points -->
                <div class="form-group mt-3">
                  <label>Key Points</label>
                  <input type="text" class="form-control mt-2" name="point1" placeholder="Key Point 1">
                  <input type="text" class="form-control mt-2" name="point2" placeholder="Key Point 2">
                  <input type="text" class="form-control mt-2" name="point3" placeholder="Key Point 3">
                  <input type="text" class="form-control mt-2" name="point4" placeholder="Key Point 4">
                  <input type="text" class="form-control mt-2" name="point5" placeholder="Key Point 5">
                </div>

                <!-- Service Selection Dropdowns -->
                <div class="form-group mt-3">
                  <label for="service1">Select Service 1</label>
                  <select class="form-control" name="service1" id="service1">
                    <option value="">Choose a service...</option>
                    <?php
                    if ($serviceResult && $serviceResult->num_rows > 0) {
                      while ($service = $serviceResult->fetch_assoc()) {
                        echo "<option value='" . $service['id'] . "'>" . htmlspecialchars($service['title']) . "</option>";
                      }
                    }
                    ?>
                  </select>
                </div>

                <div class="form-group mt-3">
                  <label for="service2">Select Service 2</label>
                  <select class="form-control" name="service2" id="service2">
                    <option value="">Choose a service...</option>
                    <?php
                    if ($serviceResult && $serviceResult->num_rows > 0) {
                      // Reset result pointer to fetch services again
                      $serviceResult->data_seek(0);
                      while ($service = $serviceResult->fetch_assoc()) {
                        echo "<option value='" . $service['id'] . "'>" . htmlspecialchars($service['title']) . "</option>";
                      }
                    }
                    ?>
                  </select>
                </div>

                <!-- Submit Button -->
                <button type="submit" name="submit" class="btn btn-primary mt-4">Add Package</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php $conn->close(); ?>
  </section>


  <!-- Package Details Table -->
  <section id="package-details" class="package-details section light-background">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Available Packages</h2>
      <p>Discover our exclusive photography packages tailored to suit your needs.</p>
    </div><!-- End Section Title -->

    <div class="container">
      <div class="table-responsive">
        <table class="table table-bordered table-hover">
          <thead class="table-light">
            <tr>
              <th scope="col">Package Name</th>
              <th scope="col">Price (Rs)</th>
              <th scope="col">Duration (hrs)</th>
              <th scope="col">Description</th>
              <th scope="col">Key Points</th>
              <th scope="col">Service 1</th>
              <th scope="col">Service 2</th>
              <th scope="col">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include 'partials/dbconnect.php';

            // Fetch package details from the database
            $sql = "SELECT * FROM packages";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $packageName = $row['package_name'];
                $packageId = $row['package_id'];
                $price = $row['price'];
                $duration = $row['hours'];
                $description = $row['description'];
                $point1 = $row['point1'];
                $point2 = $row['point2'];
                $point3 = $row['point3'];
                $point4 = $row['point4'];
                $point5 = $row['point5'];
                $service1 = $row['service1'];
                $service2 = $row['service2'];
            ?>
                <tr>
                  <td><?php echo htmlspecialchars($packageName); ?></td>
                  <td><?php echo htmlspecialchars($price); ?></td>
                  <td><?php echo htmlspecialchars($duration); ?></td>
                  <td><?php echo htmlspecialchars($description); ?></td>
                  <td>
                    <ul class="list-unstyled">
                      <li><?php echo htmlspecialchars($point1); ?></li>
                      <li><?php echo htmlspecialchars($point2); ?></li>
                      <li><?php echo htmlspecialchars($point3); ?></li>
                      <li><?php echo htmlspecialchars($point4); ?></li>
                      <li><?php echo htmlspecialchars($point5); ?></li>
                    </ul>
                  </td>
                  <td><?php 
                    $sl = "SELECT title FROM services WHERE id = '$service1'";
                    $st = $conn->prepare($sl);
                    if ($st->execute()) {
                      $res = $st->get_result();
                      if ($res->num_rows > 0) {
                        while ($data = $res->fetch_assoc()) {
                          echo $data['title'];
                        }
                      }
                    }
                  ?></td>
                  <td><?php 
                    $sl = "SELECT title FROM services WHERE id = '$service2'";
                    $st = $conn->prepare($sl);
                    if ($st->execute()) {
                      $res = $st->get_result();
                      if ($res->num_rows > 0) {
                        while ($data = $res->fetch_assoc()) {
                          echo $data['title'];
                        }
                      }
                    }
                  ?></td>
                  <td>
                    <a href="editPackage.php?id=<?php echo $row['package_id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="#" class="btn btn-sm btn-danger" onclick="deletePackage(<?php echo $packageId; ?>)">Delete</a>
                  </td>
                </tr>
            <?php
              }
            } else {
              echo "<tr><td colspan='8' class='text-center'>No packages available at the moment.</td></tr>";
            }
            $conn->close();
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>

<div class="modal fade" id="deletePackageModal" tabindex="-1" aria-labelledby="deletePackageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePackageModalLabel">Alert!</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="deletePackageForm" action="partials/addPackage.php" method="POST">
                    <div class="mb-3">
                        <input type="hidden" id="delete_package_id" name="package_id" value="">
                        <p><span id="delete_msg"></span></p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" name="delete">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
  function deletePackage(package_id) {
    var doc = document.getElementById('delete_package_id').value = package_id;
    document.getElementById('delete_msg').innerHTML = "Are you sure about deleting service ?";
    $('#deletePackageModal').modal('show');
  }
</script>