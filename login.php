<?php
session_start();
include('db.php');  // Include your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username exists in the database
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    // If the user exists and the password matches the hashed one
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];  // Store the role in the session

        // Redirect to manager dashboard if the user is a manager
        if ($user['role'] == 'manager') {
            header('Location: dashboard.php');  // Redirect to the manager dashboard
            exit;
        } else {
            echo "Access Denied!";  // Other users (like workers) will not be able to log in here
        }
    } else {
        echo "Invalid username or password!";
    }
}
?>

<!-- HTML Form for Login -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-image: url(bread1.jpg);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            background-color: #FF69B4;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #FF00FF;
        }

        .error-message {
            color: red;
            margin-bottom: 20px;
        }

        .login-form {
            display: flex;
            flex-direction: column;
            align-items: stretch;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login As Fadhilah's Manager</h2>

        <!-- Display error message if login fails -->
        <?php if (isset($error_message)) { ?>
            <div class="error-message">
                <?php echo $error_message; ?>
            </div>
        <?php } ?>

        <!-- Login Form -->
        <form method="POST" action="login.php" class="login-form">
            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>
        </form> <br><br><p style="text-align: center;"><a href="index.php">Back to Home Page</a></p>
    </div>
</body>
</html>
