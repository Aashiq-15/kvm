
<div class="container mt-5">
    <!-- Add Portfolio Form -->
    <div class="card mb-4 w-50 shadow mx-2">
        <div class="card-header">
            <h4>Add Portfolio</h4>
        </div>
        <div class="card-body">
            <form action="partials/addPortfolio.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="customerName">Customer Name</label>
                    <input type="text" class="form-control" name="customerName" id="customerName" placeholder="Enter customer name" required>
                </div>
                <div class="form-group">
                    <label for="photographyType">Photography Type</label>
                    <input type="text" class="form-control" name="photographyType" id="photographyType" placeholder="Enter photography type" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" name="date" id="date" required>
                </div>
                <div class="row mt-2">
                <div class="col-md-6">
                    <label for="coverPhoto">Cover Photo</label>
                    <input type="file" class="form-control-file" name="coverPhoto" id="coverPhoto" required>
                </div>
                <div class="col-md-6">
                    <label for="photo1">Photo 1</label>
                    <input type="file" class="form-control-file" name="photo1" id="photo1">
                </div>
                </div>
                <div class="row mt-2">
                <div class="col-md-6">
                    <label for="coverPhoto">Cover Photo</label>
                    <input type="file" class="form-control-file" name="photo2" id="photo2" required>
                </div>
                <div class="col-md-6">
                    <label for="photo1">Photo 1</label>
                    <input type="file" class="form-control-file" name="photo3" id="photo3">
                </div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary mt-2">Add Portfolio</button>
            </form>
        </div>
    </div>

    <!-- Portfolio Details Table -->
    <div class="card mx-2">
        <div class="card-header">
            <h4>Portfolio Details</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cover Photo</th>
                        <th>Customer Name</th>
                        <th>Photography Type</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample Row -->
                    <tr>
                        <td>1</td>
                        <td><img src="https://via.placeholder.com/50" alt="Cover Photo" class="img-thumbnail"></td>
                        <td>John Doe</td>
                        <td>Wedding Photography</td>
                        <td>A beautiful wedding captured at sunset.</td>
                        <td>2024-11-10</td>
                        <td>
                            <button class="btn btn-info btn-sm">Edit</button>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                    <!-- Add more rows here -->
                </tbody>
            </table>
        </div>
    </div>
</div>
