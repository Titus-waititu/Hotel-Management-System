<?php
session_start();
include 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if booking_id is set
if (!isset($_GET['booking_id'])) {
    header("Location: dashboard.php"); // Redirect if no booking ID is provided
    exit();
}

// Fetch booking details
$booking_id = $_GET['booking_id'];
$sql = "SELECT b.*, r.price FROM bookings b JOIN rooms r ON b.room_id = r.id WHERE b.id = '$booking_id' AND b.user_id = '{$_SESSION['user_id']}'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "No booking found.";
    exit();
}

$booking = $result->fetch_assoc();
$total_amount = $booking['price']; // Assuming price is per night, you may need to calculate based on duration

// Payment processing logic (this is a placeholder)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Here you would integrate with a payment gateway
    // For example, using Stripe or PayPal API to process the payment

    // Simulating payment success
    $payment_success = true; // Change this based on actual payment processing result

    if ($payment_success) {
        // Update booking status to paid
        $update_sql = "UPDATE bookings SET status = 'paid' WHERE id = '$booking_id'";
        if ($conn->query($update_sql) === TRUE) {
            echo "Payment successful. Your booking is confirmed.";
        } else {
            echo "Error updating booking status: " . $conn->error;
        }
    } else {
        echo "Payment failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
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

        .payment-form {
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

        input[type="text"], input[type="number"], input[type="date"] {
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
        <h1>Payment for Booking</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="rooms.php">Rooms</a>
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <div class="payment-form">
        <h2>Confirm Payment</h2>
        <p>Total Amount: $<?= number_format($total_amount, 2) ?></p>
        <form method="post">
            <label>Card Number:</label>
            <input type="text" name="card_number" required>
            <label>Expiration Date:</label>
            <input type="text" name="expiration_date" placeholder="MM/YY" required>
            <label>CVC:</label>
            <input type="text" name="cvc" required>
            <button type="submit">Pay Now</button>
        </form>
    </div>
</body>
</html>