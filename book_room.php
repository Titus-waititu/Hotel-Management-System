<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['room_id'])) {
    $_SESSION['room_id'] = $_GET['room_id']; // Save the room ID in the session
    header("Location: booking.php"); // Redirect to the booking page
    exit();
} else {
    // Handle the case where room_id is not set
    header("Location: dashboard.php"); // Redirect back to the dashboard
    exit();
}
?>