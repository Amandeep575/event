<?php include 'db_connect.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Event List</title>
</head>
<body>
<h2>Upcoming Events</h2>

<table border="1" cellpadding="10">
<tr>
    <th>Title</th>
    <th>Date</th>
    <th>Time</th>
    <th>Location</th>
    <th>Action</th>
</tr>

<?php
$sql = "SELECT * FROM events ORDER BY event_date ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['title']}</td>
                <td>{$row['event_date']}</td>
                <td>{$row['event_time']}</td>
                <td>{$row['location']}</td>
                <td><a href='register.php?event_id={$row['event_id']}'>Register</a></td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No events found</td></tr>";
}
?>
</table>

</body>
</html>
