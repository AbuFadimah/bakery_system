<?php
// Start the session
session_start();

// Include database connection
include('db.php');

// Check if the user is logged in as a manager
if ($_SESSION['role'] != 'manager') {
    header('Location: login.php');  // Redirect to login page if not logged in as manager
    exit;
}

// Handle form submission to add a worker
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get values from the form
    $name = $_POST['name'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];
    $hired_date = $_POST['hired_date'];

    // Insert the new worker into the database
    $query = "INSERT INTO workers (name, position, salary, hired_date) VALUES ('$name', '$position', '$salary', '$hired_date')";
    if (mysqli_query($conn, $query)) {
        echo "New worker added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!-- HTML form to add a new worker -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Worker</title>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-image: url(bread2.jpg);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
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

        input[type="text"], input[type="date"] {
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

        a {
            display: block;
            margin-top: 20px;
            color: #007BFF;
            text-decoration: none;
            font-size: 16px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Add New Worker To Fadhilah Company</h2>

    <!-- Form to add a new worker -->
    <form action="add_worker.php" method="POST">
        <label for="name">Worker Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="position">Position:</label>
        <input type="text" name="position" id="position" required>

        <label for="salary">Salary:</label>
        <input type="text" name="salary" id="salary" required>

        <label for="hired_date">Hired Date:</label>
        <input type="date" name="hired_date" id="hired_date" required>

        <button type="submit">Add Worker</button>
    </form>

    <!-- Link back to Dashboard -->
    <a href="dashboard.php">Back to Dashboard</a>
</div>

</body>
</html>
