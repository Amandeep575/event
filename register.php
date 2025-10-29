<?php
include 'db_connect.php';
$event_id=$_GET;
$user_id = 1; // assume user is logged in

$sql = "INSERT INTO registrations (user_id, event_id) VALUES ('$user_id', '$event_id')";
if ($conn->query($sql) === TRUE) {
    echo "<p style='color:green;'>Registered successfully!</p>";
} else {
    echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
}
?>
<a href='view_events.php'>Back to Events</a>
