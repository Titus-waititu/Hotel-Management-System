<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            header("Location: dashboard.php");
            exit(); // Always exit after a header redirect
        } else {
            $error_message = "Incorrect password.";
        }
    } else {
        $error_message = "User  not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form_actions {
            background-color: white;
            padding: 20px;
            margin: 0 10px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 400px; /* Fixed width for the form */
        }

        .form_actions input {
            width: 100%;
            padding: 12px; /* Increased padding for better spacing */
            margin: 10px 0; /* Margin between inputs */
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box; /* Ensures padding is included in width */
        }

        .form_actions button {
            width: 100%;
            padding: 12px; /* Increased padding for better spacing */
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form_actions button:hover {
            background-color: #555;
        }

        .form_actions a {
            display: block;
            text-align: center;
            margin-top: 10px;
            text-decoration: none;
            color: #333;
        }

        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
   <form method="post" class="form_actions">
       <h2>Login</h2>
       <?php if (isset($error_message)): ?>
           <div class="error"><?= $error_message ?></div>
       <?php endif; ?>
       <input type="email" name="email" required placeholder="Email">
       <input type="password" name="password" required placeholder="Password">
       <button type="submit">Login</button>
       <a href="./register.php">Don't have an account?</a>
   </form> 
</body>
</html>