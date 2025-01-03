<?php
session_start();

// Check if the user is logged in and is a manager
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'manager') {
    header('Location: login.php');  // Redirect to login if not logged in or not a manager
    exit;
}

include('db.php');  // Include your database connection

// Handle form submission for adding products to inventory
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_products'])) {
        $week = $_POST['week'];
        $day = $_POST['day'];
        foreach ($_POST['product_name'] as $index => $product_name) {
            $quantity = $_POST['quantity'][$index];
            $price = $_POST['price'][$index];
            $total = $quantity * $price;

            // Insert product into the database
            $query = "INSERT INTO inventory (product_name, quantity, price, total, week, day) 
                      VALUES ('$product_name', '$quantity', '$price', '$total', '$week', '$day')";

            if (!mysqli_query($conn, $query)) {
                echo "Error adding product: " . mysqli_error($conn);
            }
        }
    }
}

// Fetch weeks from the weeks table
$weeks_query = "SELECT * FROM weeks ORDER BY week_number DESC";
$weeks_result = mysqli_query($conn, $weeks_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Inventory</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(bread1.jpg);
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2, h3 {
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
        .form-row {
            margin-bottom: 15px;
        }
        .form-row input {
            padding: 8px;
            width: 20%;
            margin-right: 5px;
        }
        .btn-add, .btn-submit {
            background-color: #FF69B4;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-add:hover, .btn-submit:hover {
            background-color: #FF00FF;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Manage Weekly Inventory in Fadhilah Bread</h2>

    <!-- Form to add products to inventory for a specific week and day -->
    <form method="POST" action="manage_inventory.php">
        <label for="week">Select Week:</label>
        <select name="week" id="week" required onchange="populateDays()">
            <option value="">Select Week</option>
            <?php
            while ($week = mysqli_fetch_assoc($weeks_result)) {
                echo "<option value='{$week['week_number']}'>Week {$week['week_number']}</option>";
            }
            ?>
        </select>

        <label for="day">Select Day:</label>
        <select name="day" id="day" required>
            <option value="">Select Day</option>
        </select>

        <div class="form-container" id="product-rows">
            <div class="form-row">
                <input type="text" name="product_name[]" placeholder="Product Name" required>
                <input type="number" name="quantity[]" placeholder="Quantity" required>
                <input type="number" name="price[]" step="0.01" placeholder="Price" required>
            </div>
        </div>

        <button type="button" class="btn-add" onclick="addRow()">Add Another Product</button>
        <br><br>
        <button type="submit" name="add_products" class="btn-submit">Submit Products</button>
    </form>

    <h3>Inventory by Week and Day</h3>
    <?php
    $inventory_query = "SELECT * FROM inventory ORDER BY week DESC, day ASC, product_name ASC";
    $inventory_result = mysqli_query($conn, $inventory_query);

    $current_week = 0;
    $current_day = 0;
    $weekly_total = 0;

    echo "<table border='1'>
            <thead>
                <tr>
                    <th>Week</th>
                    <th>Day</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>";

    while ($row = mysqli_fetch_assoc($inventory_result)) {
        if ($row['week'] != $current_week) {
            if ($current_week != 0) {
                echo "<tr><td colspan='5'>Weekly Total: $weekly_total</td></tr>";
            }
            $current_week = $row['week'];
            $current_day = 0;
            $weekly_total = 0;
            echo "<tr><td colspan='6'>Week {$current_week}</td></tr>";
        }

        if ($row['day'] != $current_day) {
            $current_day = $row['day'];
            echo "<tr><td colspan='6'>Day {$current_day}</td></tr>";
        }

        $weekly_total += $row['total'];
        echo "<tr>
                <td>{$row['week']}</td>
                <td>{$row['day']}</td>
                <td>{$row['product_name']}</td>
                <td>{$row['quantity']}</td>
                <td>{$row['price']}</td>
                <td>{$row['total']}</td>
              </tr>";
    }

    echo "<tr><td colspan='5'>Weekly Total: $weekly_total</td></tr>";
    echo "</tbody></table>";
    ?>
    <p style="text-align: center;"><br><br><a href="dashboard.php">Back to Dashboard</a></p>
</div>

<script>
    function populateDays() {
        let daySelect = document.getElementById('day');
        daySelect.innerHTML = '<option value="">Select Day</option>';
        for (let i = 1; i <= 7; i++) {
            let option = document.createElement('option');
            option.value = i;
            option.textContent = 'Day ' + i;
            daySelect.appendChild(option);
        }
    }

    function addRow() {
        let container = document.getElementById('product-rows');
        let newRow = document.createElement('div');
        newRow.classList.add('form-row');
        newRow.innerHTML = `
            <input type="text" name="product_name[]" placeholder="Product Name" required>
            <input type="number" name="quantity[]" placeholder="Quantity" required>
            <input type="number" name="price[]" step="0.01" placeholder="Price" required>
        `;
        container.appendChild(newRow);
    }
</script>
</body>
</html>
