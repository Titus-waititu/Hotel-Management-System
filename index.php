<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Management System</title>
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

        .container {
            max-width: 800px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .btn {
            display: inline-block;
            background: #007BFF;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px;
        }

        .btn:hover {
            background: #0056b3;
        }
    </style>
</head>

<body>
    <header>
        <h1>Welcome to our Luxury Suites</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="rooms.php">Rooms</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="booking.php" class="button">Book Now</a>
            <?php else: ?>
                <a href="login.php" class="button">Book Now</a>
            <?php endif; ?>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="dashboard.php">Dashboard</a>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            <?php endif; ?>
        </nav>
    </header>
    <div class="container">
        <h2>Enjoy Luxury and Comfort</h2>
        <p>Welcome to our hotel, where we offer the best services for your stay.</p>
        <a href="rooms.php" class="btn">View Rooms</a>
        <a href="booking.php" class="btn">Book a Room</a>
    </div>
</body>

</html>