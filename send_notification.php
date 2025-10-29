<?php
$to = "user@example.com";
$subject = "Event Reminder";
$message = "This is a reminder for your upcoming event tomorrow.";
$headers = "From: noreply@eventsystem.com";

if (mail($to, $subject, $message, $headers)) {
    echo "Notification sent successfully!";
} else {
    echo "Failed to send email.";
}
?>
