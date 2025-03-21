<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Include database configuration
include 'config.php';

// Fetch available rooms from the database
$sql = "SELECT * FROM rooms WHERE status = 'available'";
$result = $conn->query($sql);

// Fetch user bookings from the database
$user_id = $_SESSION['user_id'];
$bookings_sql = "SELECT b.*, r.room_number, r.room_type FROM bookings b JOIN rooms r ON b.room_id = r.id WHERE b.user_id = '$user_id'";
$bookings_result = $conn->query($bookings_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            text-align: center;
        }

        header {
            background: #333;
            color: white;
            padding: 15px 0;
        }

        nav {
            margin-top: 10px;
        }

        nav a {
            margin: 0 15px;
            text-decoration: none;
            color: white;
            font-weight: bold;
            padding: 10px;
            border-radius: 5px;
        }

        .container {
            padding: 20px;
            display: flex;
            flex-wrap: wrap; /* Allow wrapping of cards */
            justify-content: center; /* Center the cards */
        }

        .room-card, .booking-card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin: 15px;
            padding: 20px;
            display: flex;
            flex-direction: column; /* Stack content vertically */
            align-items: center; /* Center content */
            width: 220px; /* Adjusted width for better fit */
            text-align: left;
            transition: transform 0.3s; /* Smooth hover effect */
        }

        .room-card:hover, .booking-card:hover {
            transform: scale(1.05); /* Scale up on hover */
        }

        .room-card img, .booking-card img {
            width: 100%;
            height: 150px; /* Fixed height for images */
            object-fit: cover; /* Maintain aspect ratio */
            border-radius: 10px;
            margin-bottom: 10px; /* Space between image and text */
        }

        .room-card h3, .booking-card h3 {
            margin: 10px 0;
            font-size: 1.2em; /* Slightly larger font size */
        }

        .room-card p, .booking-card p {
            margin: 5px 0;
            color: #555; /* Slightly darker text for better readability */
        }

        .button {
            background-color: #333;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            display: inline-block;
            text-decoration: none;
            transition: background 0.3s; /* Smooth hover effect */
        }

        .button:hover {
            background-color: #555; /* Change background on hover */
        }

        h2 {
            margin-bottom: 20px; /* Space below the heading */
            color: #333; /* Darker color for the heading */
        }
    </style>
</head>
<body>
<header>
    <h1>Welcome to our Luxury Suites</h1>
    <nav>
        <a href="index.php">Home</a>
        <a href="rooms.php">Rooms</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<h2>Available Rooms</h2>
<div class="container">
    <?php if ($result->num_rows > 0): ?>
        <?php while ($room = $result->fetch_assoc()): ?>
            <div class="room-card">
                <img src="<?= $room['image'] ?>" alt="Room Image">
                <h3>Room Number: <?= $room['room_number'] ?></h3>
                <p>Type: <?= $room['room_type'] ?></p>
                <p>Price: $<?= $room['price'] ?></p>
                <p>Status: <?= $room['status'] ?></p>
                <a href="book_room.php?room_id=<?= $room['id'] ?>" class="button">Book Now</a>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No available rooms at the moment.</p>
    <?php endif; ?>
</div>

<h2>Your Bookings</h2>
<div class="container">
    <?php if ($bookings_result->num_rows > 0): ?>
        <?php while ($booking = $bookings_result->fetch_assoc()): ?>
            <div class="booking-card">
                <h3>Room Number: <?= $booking['room_number'] ?></h3>
                <p>Type: <?= $booking['room_type'] ?></p>
                <p>Check-in: <?= $booking['check_in'] ?></p>
                <p>Check-out: <?= $booking['check_out'] ?></p>
                <a href="checkout.php?booking_id=<?= $booking['id'] ?>" class="button">Checkout</a>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No bookings found.</p>
    <?php endif; ?>
</div>

</body