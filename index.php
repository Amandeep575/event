<?php
// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event_management";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Add Event Form
if (isset($_POST['add_event'])) {
    $name = $_POST['event_name'];
    $date = $_POST['event_date'];
    $time = $_POST['event_time'];
    $desc = $_POST['description'];

    $sql = "INSERT INTO events (event_name, event_date, event_time, description)
            VALUES ('$name', '$date', '$time', '$desc')";
    if ($conn->query($sql)) {
        echo "<script>alert('Event Added Successfully!');</script>";
    }
}

// Handle Registration Form
if (isset($_POST['register'])) {
    $event_id = $_POST['event_id'];
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];

    $sql = "INSERT INTO registrations (event_id, user_name, user_email)
            VALUES ('$event_id', '$user_name', '$user_email')";
    if ($conn->query($sql)) {
        echo "<script>alert('Registration Successful!');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Event Management System</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f7fb;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 85%;
            margin: 30px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            margin-bottom: 30px;
        }
        input, textarea, select {
            width: 100%;
            padding: 8px;
            margin-top: 8px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background: #007bff;
            color: white;
        }
        .section-title {
            background: #007bff;
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Event Management System</h1>

    <!-- Add Event Form -->
    <div class="section-title">Add New Event</div>
    <form method="POST">
        <label>Event Name:</label>
        <input type="text" name="event_name" required>

        <label>Event Date:</label>
        <input type="date" name="event_date" required>

        <label>Event Time:</label>
        <input type="time" name="event_time">

        <label>Description:</label>
        <textarea name="description" rows="3"></textarea>

        <input type="submit" name="add_event" value="Add Event">
    </form>

    <!-- Display Events -->
    <div class="section-title">Available Events</div>
    <table>
        <tr>
            <th>ID</th>
            <th>Event Name</th>
            <th>Date</th>
            <th>Time</th>
            <th>Description</th>
            <th>Register</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM events ORDER BY event_date ASC");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['event_name']}</td>
                        <td>{$row['event_date']}</td>
                        <td>{$row['event_time']}</td>
                        <td>{$row['description']}</td>
                        <td>
                            <form method='POST'>
                                <input type='hidden' name='event_id' value='{$row['id']}'>
                                <input type='text' name='user_name' placeholder='Your Name' required>
                                <input type='email' name='user_email' placeholder='Your Email' required>
                                <input type='submit' name='register' value='Register'>
                            </form>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No Events Found</td></tr>";
        }
        ?>
    </table>

    <!-- Display Registrations -->
    <div class="section-title">Registrations</div>
    <table>
        <tr>
            <th>ID</th>
            <th>Event ID</th>
            <th>User Name</th>
            <th>User Email</th>
            <th>Registered At</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM registrations ORDER BY registered_at DESC");
        if ($result->num_rows > 0) {
            while ($reg = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$reg['id']}</td>
                        <td>{$reg['event_id']}</td>
                        <td>{$reg['user_name']}</td>
                        <td>{$reg['user_email']}</td>
                        <td>{$reg['registered_at']}</td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No Registrations Yet</td></tr>";
        }
        ?>
    </table>
</div>
</body>
</html>
