<?php
include 'config.php';

$sql = "SELECT * FROM rooms";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms</title>
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
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }

        .card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 15px;
            padding: 20px;
            width: 250px; /* Fixed width for uniformity */
            text-align: left;
            display: flex;
            flex-direction: column; /* Stack content vertically */
            justify-content: space-between; /* Space out content */
            height: 350px; /* Fixed height for uniformity */
        }

        .card img {
            width: 100%;
            height: 150px; /* Fixed height for images */
            object-fit: cover; /* Maintain aspect ratio and cover the area */
            border-radius: 10px;
        }

        .card h3 {
            margin: 10px 0;
        }

        .card p {
            margin: 5px 0;
            flex-grow: 1; /* Allow paragraphs to grow and fill space */
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
        }

        .button:hover {
            background-color: #555;
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
    <h2>Room List</h2>
    <div class="container">
        <?php while ($room = $result->fetch_assoc()): ?>
            <div class="card">
                <img src="<?= $room['image'] ?>" alt="Room Image">
                <h3>Room Number: <?= $room['room_number'] ?></h3>
                <p>Type: <?= $room['room_type'] ?></p>
                <p>Price: $<?= $room['price'] ?></p>
                <p>Status: <?= $room['status'] ?></p>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="booking.php?room_id=<?= $room['id'] ?>" class="button">Book Now</a>
                <?php else: ?>
                    <a href="login.php" class="button">Book Now</a>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>
</body>

</html>