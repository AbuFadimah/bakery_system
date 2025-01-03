<?php
// Start the session
session_start();

// Check if the password is entered and verified
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // The password to access the manager creation page
    $correct_password = '36394696AA';

    // Check if the entered password matches
    if ($_POST['password'] === $correct_password) {
        // Set a session variable to grant access
        $_SESSION['verified'] = true;
        header('Location: create_manager.php'); // Redirect to the Create Manager page
        exit;
    } else {
        $error_message = "Incorrect password, please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Password</title>
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
        input[type="password"] {
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
        .message {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Enter Password To Create Manager</h2>

    <?php
    // Display error message if password is incorrect
    if (isset($error_message)) {
        echo "<p class='message'>$error_message</p>";
    }
    ?>

    <!-- Form to enter the password -->
    <form method="POST" action="verify_password.php">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Submit</button>
    </form>

</div>

</body>
</html>
