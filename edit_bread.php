<?php
session_start();

// Check if the user is logged in and is a manager
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'manager') {
    header('Location: login.php');
    exit;
}

include('db.php');  // Include your database connection

// Fetch bread details for editing
if (isset($_GET['id'])) {
    $bread_id = $_GET['id'];

    // Fetch the bread from the database
    $query = "SELECT * FROM breads WHERE id = $bread_id";
    $result = mysqli_query($conn, $query);
    $bread = mysqli_fetch_assoc($result);
}

// Handle form submission for updating bread details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bread_name = $_POST['bread_name'];
    $bread_price = $_POST['bread_price'];

    // Update the bread details in the database
    $query = "UPDATE breads SET bread = '$bread_name', price = '$bread_price' WHERE id = $bread_id";
    if (mysqli_query($conn, $query)) {
        echo "Bread updated successfully!";
    } else {
        echo "Error updating bread: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Bread</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 500px;
            margin: auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #FF69B4;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #FF00FF;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Bread</h2>
    <form method="POST" action="edit_bread.php?id=<?php echo $bread['id']; ?>">
        <label for="bread_name">Bread Name:</label>
        <input type="text" name="bread_name" id="bread_name" value="<?php echo $bread['bread']; ?>" required><br>

        <label for="bread_price">Price:</label>
        <input type="number" name="bread_price" id="bread_price" value="<?php echo $bread['price']; ?>" required><br>

        <button type="submit">Update Bread</button>
    </form>
    <p style="text-align: center;"><a href="view_breads.php">Back to Bread List</a></p>
</div>

</body>
</html>
