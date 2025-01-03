<?php
include('db.php');  // Include your database connection

// Insert sale record into the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $amount = $_POST['amount'];
    $amount_paid = $_POST['amount_paid'];
    $date = $_POST['date'];
    $buyer_name = $_POST['buyer_name'];
    $description = $_POST['description'];  // Capture the bread names and quantities in the description

    // Insert sale record into the sales table
    $query = "INSERT INTO sales (amount, amount_paid, remaining, date, description, buyer_name) 
              VALUES ('$amount', '$amount_paid', '$amount' - '$amount_paid', '$date', '$description', '$buyer_name')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Sale recorded successfully!');</script>";
    } else {
        echo "<script>alert('Error: Could not record sale.');</script>";
    }
}

// Fetch bread names and prices from the database
$query_breads = "SELECT id, bread_name, price FROM breads";  // Fetch from 'bread_name' field
$result_breads = mysqli_query($conn, $query_breads);

// Fetch and display sales records from the database
$query_sales = "SELECT * FROM sales ORDER BY date DESC";  // Get all sales, ordered by date
$result_sales = mysqli_query($conn, $query_sales);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Sales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(bread3.jpg);
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        form input, form select, form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #FF69B4;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #FF00FF;
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
        .remaining {
            color: red;
        }
    </style>

    <script>
        var selectedBreads = [];

        function updateSelectedBreads(breadId, breadName, breadPrice) {
            var breadList = document.getElementById('selectedBreads');
            var totalField = document.getElementById('amount');
            var descriptionField = document.getElementById('description');
            var total = parseFloat(totalField.value) || 0;

            // Prompt the manager for the quantity of bread
            var quantity = prompt("Enter the quantity for " + breadName + ":", "1");
            quantity = parseInt(quantity);

            if (isNaN(quantity) || quantity <= 0) {
                alert("Please enter a valid quantity.");
                return;
            }

            // Add the bread and quantity to the selectedBreads array
            selectedBreads.push({ id: breadId, name: breadName, price: breadPrice, quantity: quantity });
            var listItem = document.createElement('li');
            listItem.textContent = breadName + " - " + quantity + " x ₦" + breadPrice.toFixed(2) + " = ₦" + (breadPrice * quantity).toFixed(2);
            breadList.appendChild(listItem);

            // Update the description field
            var breadDescription = breadName + " - " + quantity + " x ₦" + breadPrice.toFixed(2);
            if (descriptionField.value) {
                descriptionField.value += ", " + breadDescription;
            } else {
                descriptionField.value = breadDescription;
            }

            // Update the total amount
            total += breadPrice * quantity;
            totalField.value = total.toFixed(2);
        }
    </script>
</head>
<body>

<div class="container">
    <h2>Record New Sale In Fadhilah Bakery</h2>
    <!-- Form to record new sale -->
    <form method="POST" action="view_sales.php">
        Amount: <input type="number" name="amount" id="amount" required readonly> ₦<br>
        Amount Paid: <input type="number" name="amount_paid" id="amount_paid" required> ₦<br>
        Date: <input type="date" name="date" required><br>

        <!-- Bootstrap Dropdown for Breads -->
        <label for="bread">Select Breads:</label>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                Choose Breads
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <?php
                // Populate the dropdown with only bread names, passing id and price to JavaScript function
                while ($row = mysqli_fetch_assoc($result_breads)) {
                    echo "<li><a class='dropdown-item' href='#' onclick='updateSelectedBreads({$row['id']}, \"{$row['bread_name']}\", {$row['price']})'>{$row['bread_name']}</a></li>";
                }
                ?>
            </ul>
        </div>

        <!-- List of selected breads -->
        <ul id="selectedBreads">
            <!-- Selected breads will appear here -->
        </ul>

        <!-- Hidden description field -->
        <textarea name="description" id="description" hidden></textarea>

        Buyer Name: <input type="text" name="buyer_name" required><br>
        <button type="submit">Submit Sale</button>
    </form>

    <h3>Sales History</h3>

    <?php
    // Display sales records from the database
    if (mysqli_num_rows($result_sales) > 0) {
        echo "<table>";
        echo "<tr><th>Amount (₦)</th><th>Amount Paid (₦)</th><th>Remaining (₦)</th><th>Date</th><th>Description</th><th>Buyer Name</th><th>Actions</th></tr>";
        
        while ($row = mysqli_fetch_assoc($result_sales)) {
            $remaining_style = $row['remaining'] > 0 ? 'class="remaining"' : '';
            echo "<tr>
                    <td>₦{$row['amount']}</td>
                    <td>₦{$row['amount_paid']}</td>
                    <td $remaining_style>₦{$row['remaining']}</td>
                    <td>{$row['date']}</td>
                    <td>{$row['description']}</td> <!-- Display description here -->
                    <td>{$row['buyer_name']}</td>
                    <td><a href='edit_sale.php?id={$row['id']}'>Edit</a> | 
                        <a href='view_sales.php?delete={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this sale?\");'>Delete</a></td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No sales records found.";
    }
    ?> 

    <br><br><br><p style="text-align: center;"><a href="dashboard.php">Back to Dashboard</a></p>
</div>

<!-- Bootstrap JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

</body>
</html>
