<?php
include 'partials/dbconnect.php';
?>

<div class="container mt-5">
    <!-- Add User Form -->
    <div class="card mb-4 w-50 mx-auto shadow">
        <div class="card-header">
            <h4>Create User Account</h4>
        </div>
        <div class="card-body">
            <form action="partials/addUser.php" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" class="form-control" name="cpassword" id="confirm_password" placeholder="Confirm password" required>
                </div>
                <div class="form-group">
                    <label for="contact">Contact</label>
                    <input type="text" class="form-control" name="contact" id="contact" placeholder="Enter contact number" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Create Account</button>
            </form>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>User Details</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch user details from database
                    $sql = "SELECT * FROM users";
                    $result = $conn->query($sql);
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $userId = $row['user_id'];
                            $username = $row['username'];
                            $email = $row['email'];
                            $contact = $row['phone'];
                            $address = $row['address'];
                            $role = $row['role'];

                            echo "<tr>
                                <td>{$userId}</td>
                                <td>{$username}</td>
                                <td>{$email}</td>
                                <td>{$contact}</td>
                                <td>{$address}</td>
                                <td>";
                            if ($role == 'admin') {
                                echo "<button class='btn btn-sm btn-warning' onclick='editUser({$userId}, \"{$username}\", \"{$email}\", \"{$contact}\", \"{$address}\")'>Edit</button>";
                            }
                            echo "<a href='#' class='btn btn-sm btn-danger' onclick='deleteUser({$userId})'>Delete</a>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center'>No users found</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="partials/addUser.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" id="edit_user_id">
                    <div class="form-group">
                        <label for="edit_username">Username</label>
                        <input type="text" class="form-control" name="username" id="edit_username" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_email">Email</label>
                        <input type="email" class="form-control" name="email" id="edit_email" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_password">Password</label>
                        <input type="password" class="form-control" name="password" id="edit_password">
                    </div>
                    <div class="form-group">
                        <label for="edit_confirm">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm" id="edit_confirm">
                    </div>
                    <div class="form-group">
                        <label for="edit_contact">Contact</label>
                        <input type="text" class="form-control" name="contact" id="edit_contact">
                    </div>
                    <div class="form-group">
                        <label for="edit_address">Address</label>
                        <textarea class="form-control" name="address" id="edit_address" rows="3"></textarea>
                    </div>
                    <button type="submit" name="update" class="btn btn-primary">Update User</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel">Alert!</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="deleteUserForm" action="partials/addUser.php" method="POST">
                    <div class="mb-3">
                        <input type="hidden" id="delete_user_id" name="user_id" value="">
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
    // Populate and show Edit User Modal
    function editUser(user_id, username, email, contact, address) {
        // Set values in the modal
        document.getElementById('edit_user_id').value = user_id;
        document.getElementById('edit_username').value = username;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_contact').value = contact;
        document.getElementById('edit_address').value = address;

        // Show the modal
        $('#editUserModal').modal('show');
    }

    function deleteUser(user_id) {
        var doc = document.getElementById('delete_user_id').value = user_id;
        document.getElementById('delete_msg').innerHTML = "Are you sure about deleting user ?";
        $('#deleteUserModal').modal('show');
    }
</script>