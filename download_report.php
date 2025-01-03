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

// Query to fetch all sales data
$query = "SELECT * FROM sales";
$result = mysqli_query($conn, $query);

// Set headers for CSV download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="sales_report.csv"');

// Open output stream to write data to CSV
$output = fopen('php://output', 'w');

// Write column headers to CSV file
fputcsv($output, array('Customer Name', 'Total Amount', 'Amount Paid', 'Remaining', 'Sale Date'));

// Write rows of sales data to the CSV file
while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, $row);
}

// Close the output stream
fclose($output);
?>
