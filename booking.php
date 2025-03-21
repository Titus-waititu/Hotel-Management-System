<?php
include 'config.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if room_id is set in the session
if (!isset($_SESSION['room_id'])) {
    header("Location: dashboard.php"); // Redirect to dashboard if no room is selected
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $room_id = $_SESSION['room_id']; // Get room_id from session
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];

    // Insert booking into the database
    $sql = "INSERT INTO bookings (user_id, room_id, check_in, check_out) VALUES ('$user_id', '$room_id', '$check_in', '$check_out')";

    if ($conn->query($sql) === TRUE) {
        echo "Booking successful.";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link rel="stylesheet" href="./assets/css/style.css">
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

        .form_actions {
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px; /* Fixed width for the form */
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="date"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            background-color: #333;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #555; /* Change background on hover */
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
    
    <form method="post" class="form_actions">
        <h2>Booking Details</h2>
        <label>Room:</label>
        <input type="text" value="<?= $_SESSION['room_id'] ?>" readonly> <!-- Display the room ID -->
        <label>Check-in Date:</label>
        <input type="date" name="check_in" required>
        <label>Check-out Date:</label>
        <input type="date" name="check_out" required>
        <button type="submit">Book Now</button>
    </form>
</body>
</html>