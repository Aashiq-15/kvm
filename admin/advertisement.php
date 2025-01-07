<?php
// Database connection
include 'partials/dbconnect.php';

// Fetch advertisements
$sql = "SELECT * FROM advertisements";
$result = $conn->query($sql);
?>

<div class="container mt-5">
    <!-- Add Advertisement Form -->
    <div class="card mb-4 w-50 mx-auto shadow">
        <div class="card-header">
            <h4>Add Advertisement</h4>
        </div>
        <div class="card-body">
            <form action="./partials/add.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Advertisement Title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Enter advertisement title" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Upload Image</label>
                    <input type="file" name="image" accept=".jpg" class="form-control-file" id="image">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Add Advertisement</button>
            </form>
        </div>
    </div>

    <!-- Advertisements List Table -->
    <div class="card mx-2">
    <div class="card-header">
        <h4>Total Advertisements</h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $adId = $row['id'];
                        $title = $row['title'];
                        $desc = $row['description'];
                        $status = $row['status'];
                        $adDate = $row['add_date'];
                        $disDate = $row['dis_date'];
                        $imagePath = "/kvm/assets/img/ads/ads-" . $adId . ".jpg";

                        echo "<tr>
                            <td>{$adId}</td>
                            <td>{$title}</td>
                            <td>{$desc}</td>
                            <td>{$adDate}</td>
                            <td>{$disDate}</td>
                            <td>{$status}</td>
                            <td><img src='{$imagePath}' alt='Advertisement Image' style='width: 50px; height: auto;'></td>
                            <td>
                                <button class='btn btn-sm btn-warning' onclick='openEditModal({$adId}, \"{$title}\", \"{$desc}\", \"{$status}\")'>Edit</button>
                                <a href='partials/add.php?id={$adId}' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure you want to delete this advertisement?\");'>Delete</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>No advertisements found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</div>
</div>

<!-- Edit Advertisement Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Advertisement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="partials/add.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="editAdId">
                    <div class="form-group">
                        <label for="editTitle">Advertisement Title</label>
                        <input type="text" class="form-control" name="title" id="editTitle" required>
                    </div>
                    <div class="form-group">
                        <label for="editDescription">Description</label>
                        <textarea class="form-control" name="description" id="editDescription" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editStatus">Status</label>
                        <select class="form-control" name="status" id="editStatus" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editImage">Upload New Image</label>
                        <input type="file" name="image" class="form-control-file" id="editImage">
                    </div>
                    <button type="submit" name="update" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
function openEditModal(id, title, description, status) {
    // Set values in the modal
    document.getElementById('editAdId').value = id;
    document.getElementById('editTitle').value = title;
    document.getElementById('editDescription').value = description;
    document.getElementById('editStatus').value = status;

    // Show the modal
    $('#editModal').modal('show');
}
</script>
