<?php
session_start();

// Check if the user is logged in and is a manager
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'manager') {
    header('Location: login.php');
    exit;
}

include('db.php');  // Include your database connection

// Fetch all bread records from the database
$query = "SELECT * FROM breads ORDER BY bread_name"; // Corrected to 'bread_name'
$result = mysqli_query($conn, $query);

// Delete record if the 'delete' parameter is set
if (isset($_GET['delete'])) {
    $id_to_delete = $_GET['delete'];

    // Ensure the ID is a number before proceeding
    if (is_numeric($id_to_delete)) {
        // Perform delete operation
        $query = "DELETE FROM breads WHERE id = $id_to_delete"; // Corrected to 'breads'

        if (mysqli_query($conn, $query)) {
            // Redirect after successful deletion
            header('Location: view_breads.php');
            exit;
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid ID!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bread List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        .actions {
            text-align: center;
        }
        .actions a {
            color: #FF69B4;
            text-decoration: none;
        }
        .actions a:hover {
            color: #FF00FF;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>List of Breads</h2>
    <table>
        <tr>
            <th>Bread Name</th>
            <th>Price (₦)</th> <!-- Updated column header to display Naira -->
            <th>Actions</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['bread_name']; ?></td> <!-- Corrected to 'bread_name' -->
                <td>₦<?php echo number_format($row['price'], 2); ?></td> <!-- Display price in Naira with two decimal places -->
                <td class="actions">
                    <a href="edit_bread.php?id=<?php echo $row['id']; ?>">Edit</a> | 
                    <a href="view_breads.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this bread?');">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
    <p style="text-align: center;"><a href="add_bread.php">Add New Bread</a></p><p style="text-align: center;">Or</p> <p style="text-align: center;"><a href="dashboard.php">Back to Dashboard</a></p>
</div>

</body>
</html>
