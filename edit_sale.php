<?php
// Connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bakery_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php
if (isset($_GET['id'])) {
    $sale_id = $_GET['id'];
    $query = "SELECT * FROM sales WHERE id = $sale_id";
    $result = mysqli_query($conn, $query);
    $sale = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $amount = $_POST['amount'];
        $amount_paid = $_POST['amount_paid'];
        $remaining = $amount - $amount_paid;
        $date = $_POST['date'];
        $description = $_POST['description'];
        $buyer_name = $_POST['buyer_name'];

        // Update the sale record
        $update_query = "UPDATE sales SET amount = '$amount', amount_paid = '$amount_paid', remaining = '$remaining', date = '$date', description = '$description', buyer_name = '$buyer_name' WHERE id = $sale_id";

        if (mysqli_query($conn, $update_query)) {
            echo "<div class='success'>Sale updated successfully!</div>";
        } else {
            echo "<div class='error'>Error updating sale: " . mysqli_error($conn) . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Sale</title>
    <style>
        /* Reset margin and padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Basic styling */
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background: white;
            width: 100%;
            max-width: 600px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        form input, form textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            color: #333;
        }

        form textarea {
            resize: vertical;
            min-height: 100px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        .success {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            margin-bottom: 20px;
            text-align: center;
            border-radius: 5px;
        }

        .error {
            background-color: #f44336;
            color: white;
            padding: 10px;
            margin-bottom: 20px;
            text-align: center;
            border-radius: 5px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        /* Responsive design */
        @media screen and (max-width: 768px) {
            .container {
                width: 90%;
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Sale</h2>
    
    <!-- Form to edit sale -->
    <form method="POST" action="edit_sale.php?id=<?php echo $sale_id; ?>">
        
        <div class="form-group">
            <label for="amount">Amount:</label>
            <input type="number" name="amount" value="<?php echo $sale['amount']; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="amount_paid">Amount Paid:</label>
            <input type="number" name="amount_paid" value="<?php echo $sale['amount_paid']; ?>" required>
        </div>

        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" name="date" value="<?php echo $sale['date']; ?>" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" required><?php echo $sale['description']; ?></textarea>
        </div>

        <div class="form-group">
            <label for="buyer_name">Buyer Name:</label>
            <input type="text" name="buyer_name" value="<?php echo $sale['buyer_name']; ?>" required>
        </div>

        <button type="submit">Update Sale</button>
         <p style="text-align: center;"><a href="dashboard.php">Back to Dashboard</a></p>
    </form>
</div>

</body>
</html>
