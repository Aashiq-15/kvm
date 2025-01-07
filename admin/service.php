<?php
// Database connection
include 'partials/dbconnect.php';

// Fetch services
$sql = "SELECT * FROM services";
$result = $conn->query($sql);
?>

<div class="container mt-5">
    <!-- Add Service Form -->
    <div class="card mb-4 w-50 mx-auto shadow">
        <div class="card-header">
            <h4>Add Service</h4>
        </div>
        <div class="card-body">
            <form action="./partials/addService.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Service Title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Enter service title" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Image (JPG only)</label>
                    <input type="file" name="image" accept=".jpg" class="form-control-file" id="image">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Add Service</button>
            </form>
        </div>
    </div>

    <!-- Services List Table -->
    <div class="card mx-2">
        <div class="card-header">
            <h4>Services List</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $adId = htmlspecialchars($row['id']);
                            $title = htmlspecialchars($row['title']);
                            $desc = htmlspecialchars($row['description']);
                            $imagePath = "/kvm/assets/img/services/service-" . $adId . ".jpg";
                            if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $imagePath)) {
                                $imagePath = "/kvm/assets/img/services/default.jpg"; // Default image if none exists
                            }

                            echo "<tr>
                                <td>{$adId}</td>
                                <td><img src='{$imagePath}' alt='Service Image' style='width: 50px; height: auto;'></td>
                                <td>{$title}</td>
                                <td>{$desc}</td>
                                <td>
                                    <button class='btn btn-sm btn-warning' onclick='openEditModal({$adId}, \"{$title}\", \"{$desc}\")'>Edit</button>
                                    <a href='#' class='btn btn-sm btn-danger' onclick='deleteService({$adId})'>Delete</a>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center'>No services found</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Edit Service Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="partials/addService.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="editServId">
                    <div class="form-group">
                        <label for="editTitle">Service Title</label>
                        <input type="text" class="form-control" name="title" id="editTitle" required>
                    </div>
                    <div class="form-group">
                        <label for="editDescription">Description</label>
                        <textarea class="form-control" name="description" id="editDescription" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editImage">Upload New Image (Optional)</label>
                        <input type="file" name="image" class="form-control-file" id="editImage" accept=".jpg">
                    </div>
                    <button type="submit" name="update" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteServiceModal" tabindex="-1" aria-labelledby="deleteServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteServiceModalLabel">Alert!</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="deleteServiceForm" action="partials/addService.php" method="POST">
                    <div class="mb-3">
                        <input type="hidden" id="delete_service_id" name="service_id" value="">
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
    // Populate and show Edit Service Modal
    function openEditModal(id, title, description) {
        // Set values in the modal
        document.getElementById('editServId').value = id;
        document.getElementById('editTitle').value = title;
        document.getElementById('editDescription').value = description;

        // Show the modal
        $('#editModal').modal('show');
    }

    function deleteService(service_id) {
        var doc = document.getElementById('delete_service_id').value = service_id;
        document.getElementById('delete_msg').innerHTML = "Are you sure about deleting service ?";
        $('#deleteServiceModal').modal('show');
    }
</script>