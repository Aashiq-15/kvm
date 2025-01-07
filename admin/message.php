<?php
include 'partials/dbconnect.php';

// Fetch messages from the database
$sql = "SELECT * FROM messages";
$result = $conn->query($sql);
?>

<div class="container mt-5">
<div class="card mx-2">
    <div class="card-header">
        <h4>Messages</h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $messageId = $row['id'];
                        $email = $row['email'];
                        $phone = $row['phone'];
                        $subject = $row['subject'];
                        $message = $row['message'];
                        
                        echo "<tr>
                            <td>{$messageId}</td>
                            <td>{$email}</td>
                            <td>{$phone}</td>
                            <td>{$subject}</td>
                            <td>{$message}</td>
                            <td>";
                        $check = "SELECT * FROM reply WHERE message_id = '$messageId'";
                        $stmt = $conn->prepare($check);
                        if ($stmt->execute()) {
                            $res = $stmt->get_result();
                            if (!($res->num_rows > 0)) {
                                echo "<button class='btn btn-sm btn-primary' data-toggle='modal' data-target='#replyModal-{$messageId}'>Reply</button>";
                            }
                        }
                        echo "    </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No messages found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</div>

<?php
$sql = "SELECT * FROM messages";
$result = $conn->query($sql);
// Assuming you've already fetched the messages
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $messageId = $row['id'];
        $email = $row['email'];
        $phone = $row['phone'];
        $subject = $row['subject'];
        $message = $row['message'];
        ?>
        <!-- Reply Modal -->
        <div class="modal fade" id="replyModal-<?php echo $messageId; ?>" tabindex="-1" role="dialog" aria-labelledby="replyModalLabel<?php echo $messageId; ?>" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="replyModalLabel<?php echo $messageId; ?>">Reply to Message</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="message.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="message_id" value="<?php echo $messageId; ?>">
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject">
                            </div>
                            <div class="form-group">
                                <label for="reply_message">Your Reply</label>
                                <textarea class="form-control" id="reply_message" name="message" rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" name="replyMessage">Send Reply</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php
    }
}
?>
<?php
include 'partials/dbconnect.php';

if (isset($_POST['replyMessage'])) {
    $messageId = $_POST['message_id'];
    $replyMessage = $_POST['message'];
    $subject = $_POST['subject'];

    // Send reply logic (for example, sending an email or storing the reply in the database)
    $sql = "INSERT INTO reply (message_id, subject, message, add_date) 
            VALUES ('$messageId','$subject', '$replyMessage', current_timestamp())";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Reply sent successfully'); 
                window.location=document.referrer;</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}
?>
