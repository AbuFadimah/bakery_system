<?php
// Start the session
session_start();

// Check if the user has verified the password before accessing this page
if (!isset($_SESSION['verified']) || $_SESSION['verified'] !== true) {
    header('Location: verify_password.php'); // Redirect to password verification page
    exit;
}

// Include the database connection file (db.php)
include('db.php'); // Make sure the file path is correct

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get values from the form
    $username = $_POST['username'];
    $password = $_POST['password']; 

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_BCRYPT); // Securely hash the password

    $role = 'manager'; // The role you will be assigned (manager)

    // Insert the user into the users table
    $query = "INSERT INTO users (username, password, role) 
              VALUES ('$username', '$hashed_password', '$role')";

    // Execute the query
    if (mysqli_query($conn, $query)) {
        echo "Manager created successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Manager</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(bread1.jpg);
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input[type="text"], input[type="password"] {
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Create Manager For Fadhilah Bread</h2>

    <!-- Form to create a new manager -->
    <form method="POST" action="create_manager.php">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Create Manager</button>
    </form>

    <br>
    <!-- Link back to the dashboard or home page -->
    <p style="text-align: center;"><a href="index.php">Back to Home Page</a></p>
</div>

</body>
</html>
