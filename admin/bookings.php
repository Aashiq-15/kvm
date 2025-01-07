<?php
include 'partials/dbconnect.php'; 


$sql = "SELECT 
            b.booking_id, 
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
        LEFT JOIN packages p ON b.package = p.package_id"; // Modify based on your actual 'packages' table structure

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

<!-- Bootstrap Table to Display Booking Details -->
<section id="booking-details" class="booking-details mt-5 section light-background">
    <div class="container section-title" data-aos="fade-up">
        <h2>Booking Details</h2>
        <p>View and manage all customer bookings.</p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Table to Display Bookings -->
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Booked Date</th>
                            <th>Package</th>
                            <th>Place</th>
                            <th>Event Date</th>
                            <th>Event Time</th>
                            <th>Note</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($bookings)): ?>
                            <?php foreach ($bookings as $booking): ?>
                                <tr>
                                    <td><?php echo $booking['booking_id']; ?></td>
                                    <td><?php echo $booking['username']; ?></td>
                                    <td><?php echo $booking['booked']; ?></td>
                                    <td><?php echo $booking['package_name']; ?></td>
                                    <td><?php echo $booking['place']; ?></td>
                                    <td><?php echo $booking['event_date']; ?></td>
                                    <td><?php echo $booking['event_time']; ?></td>
                                    <td><?php echo $booking['note']; ?></td>
                                    <td><?php echo ucfirst($booking['state']); ?></td>
                                    <td>
                                        <!-- Action buttons like Edit, Delete, etc. -->
                                        <a href="#" 
                                            class="btn btn-warning btn-sm" 
                                            name="edit"
                                            onclick="editStatus(<?php echo $booking['booking_id']; ?>)">Edit</a>

                                        <a href="#"
                                            class="btn btn-danger btn-sm"
                                            name="delete"
                                            onclick="deleteBooking(<?php echo $booking['booking_id']; ?>)">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="10" class="text-center">No bookings available.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Edit Booking Modal -->
<!-- Modal HTML -->
<div class="modal fade" id="editBookingModal" tabindex="-1" aria-labelledby="editBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBookingModalLabel">Edit Booking</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editBookingForm" action="partials/update_booking.php" method="POST">
                    <div class="mb-3">
                        <input type="hidden" id="booking_id" name="booking_id">
                        <label for="state" class="form-label">Status</label>
                        <select class="form-control" id="state" name="state" required>
                            <option value="pending">Pending</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="complete">Complete</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="edit">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteBookingModal" tabindex="-1" aria-labelledby="deleteBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteBookingModalLabel">Alert!</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="deleteBookingForm" action="partials/update_booking.php" method="POST">
                    <div class="mb-3">
                        <input type="hidden" id="delete_booking_id" name="booking_id" value="">
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

<!-- Trigger Modal Script -->
<script>
    // This script populates the modal fields dynamically
    function editStatus(booking_id) {
        document.getElementById('booking_id').value = booking_id;
        $('#editBookingModal').modal('show');
    }

    function deleteBooking(booking_id) {
        var doc = document.getElementById('delete_booking_id').value = booking_id;
        document.getElementById('delete_msg').innerHTML = "Are you sure about deleting record ?";
        console.log(document.getElementById('delete_booking_id').value);
        $('#deleteBookingModal').modal('show');
    }
</script>


