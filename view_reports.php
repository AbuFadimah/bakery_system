<?php
session_start();
// Check if the user is logged in and is a manager
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'manager') {
    header('Location: login.php');  // Redirect to login if not logged in or not a manager
    exit;
}

include('db.php');  // Include your database connection

// Check if the user has requested to export data
if (isset($_POST['export'])) {
    // Set the filename and query based on the selected buyer
    if ($_POST['export'] == 'single' && isset($_GET['buyer_name'])) {
        $selected_buyer = $_GET['buyer_name'];
        $filename = "{$selected_buyer}_sales_report.csv";  // Export only selected buyer's records
        $query = "SELECT * FROM sales WHERE buyer_name = '$selected_buyer' ORDER BY date DESC";
    } else {
        $filename = "all_sales_report.csv";  // Export all sales records
        $query = "SELECT * FROM sales ORDER BY date DESC";
    }

    // Output CSV headers
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    $output = fopen('php://output', 'w');
    
    // Add CSV column headers (ensure this matches the order in the database)
    fputcsv($output, array('Amount', 'Date', 'Description', 'Buyer Name', 'Remaining'));  // Added 'Remaining' header

    // Execute the query and output to CSV
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        // Ensure that each row's data corresponds to the headers
        $csv_row = array(
            $row['amount'],        // Column 1: Amount
            $row['date'],          // Column 2: Date
            $row['description'],   // Column 3: Description
            $row['buyer_name'],    // Column 4: Buyer Name
            $row['remaining']      // Column 5: Remaining
        );
        fputcsv($output, $csv_row);  // Write each record to CSV
    }
    fclose($output);  // Close the file after writing
    exit();  // Make sure no further output is sent
}

// Fetch list of buyers (or any other person, e.g., workers)
$buyers_query = "SELECT DISTINCT buyer_name FROM sales";
$buyers_result = mysqli_query($conn, $buyers_query);

// Check if a buyer is selected
$selected_buyer = isset($_GET['buyer_name']) ? $_GET['buyer_name'] : '';

// Fetch sales data for the selected buyer (if any) or for all records
if ($selected_buyer) {
    $query = "SELECT * FROM sales WHERE buyer_name = '$selected_buyer' ORDER BY date DESC";
} else {
    $query = "SELECT * FROM sales ORDER BY date DESC";
}
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Reports</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('bread3.jpg');
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
        select, button {
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Financial Report In Fadhilah Bakery</h2>

    <!-- Filter form to select a buyer -->
    <form method="GET" action="">
        <label for="buyer_name">Select Buyer:</label>
        <select name="buyer_name" id="buyer_name">
            <option value="">All Buyers</option>
            <?php while ($buyer = mysqli_fetch_assoc($buyers_result)): ?>
                <option value="<?php echo $buyer['buyer_name']; ?>" <?php echo ($buyer['buyer_name'] == $selected_buyer) ? 'selected' : ''; ?>>
                    <?php echo $buyer['buyer_name']; ?>
                </option>
            <?php endwhile; ?>
        </select>
        <button type="submit">Filter</button>
    </form>

    <!-- Display filtered data -->
    <table>
        <thead>
            <tr>
                <th>Amount (₦)</th> <!-- Updated column to display in Naira -->
                <th>Date</th>
                <th>Description</th>
                <th>Buyer Name</th>
                <th>Remaining (₦)</th> <!-- Updated column to display in Naira -->
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td>₦<?php echo number_format($row['amount'], 2); ?></td> <!-- Display amount in Naira -->
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['buyer_name']; ?></td>
                    <td>₦<?php echo number_format($row['remaining'], 2); ?></td> <!-- Display remaining in Naira -->
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Download Button for Exporting Data -->
    <form method="POST">
        <?php if ($selected_buyer): ?>
            <button type="submit" name="export" value="single">Download <?php echo $selected_buyer; ?>'s Records</button>
        <?php else: ?>
            <button type="submit" name="export" value="all">Download All Records</button>
        <?php endif; ?>
    </form><br><br> <p style="text-align: center;"><a href="dashboard.php">Back to Dashboard</a></p>
</div>

</body>
</html>
