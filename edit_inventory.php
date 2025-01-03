<?php
session_start();

// Check if the user is logged in and is a manager
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'manager') {
    header('Location: login.php');  // Redirect to login if not logged in or not a manager
    exit;
}

include('db.php');

// Fetch the record to edit
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM inventory WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Check if the record exists
    if (!$row) {
        echo "Record not found!";
        exit;
    }
} else {
    echo "No ID specified!";
    exit;
}

// Handle the form submission to update the record
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    // Calculate the total
    $total = $quantity * $price;

    // Update the record
    $update_query = "UPDATE inventory SET product_name = '$product_name', quantity = '$quantity', price = '$price', total = '$total' WHERE id = $id";

    if (mysqli_query($conn, $update_query)) {
        header('Location: manage_inventory.php');  // Redirect to the inventory page after updating
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
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
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Product in Inventory</h2>

        <!-- Form to edit the product -->
        <form method="POST" action="edit_inventory.php?id=<?php echo $row['id']; ?>">
            <div class="form-group">
                <label for="product_name">Product Name:</label>
                <input type="text" name="product_name" value="<?php echo $row['product_name']; ?>" required>
            </div>

            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" required>
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" name="price" value="<?php echo $row['price']; ?>" step="0.01" required>
            </div>

            <button type="submit">Update Product</button>
        </form>
    </div>
</body>
</html>
