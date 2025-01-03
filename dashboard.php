<?php
// Database connection settings
$servername = "localhost"; // XAMPP default localhost
$username = "root";        // XAMPP default username
$password = "";            // XAMPP default password (empty by default)
$dbname = "bakery_db";        // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);  // This will show an error message if the connection fails
}
?>

<?php
session_start();

// Check if the user is logged in and is a manager
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'manager') {
    header('Location: login.php');  // Redirect to login if not logged in or not a manager
    exit;
}

// Display the manager dashboard
echo "<h1>Welcome, Manager " . $_SESSION['username'] . "!</h1>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>
    
    <!-- Inline Style for Dashboard -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(bread1.jpg);
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        nav {
            background-color: #444;
            padding: 15px;
            text-align: center;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            padding: 8px 20px;
            background-color: #555;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        nav a:hover {
            background-color: #888;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        footer {
            text-align: center;
            padding: 10px;
            background-color: #333;
            color: white;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        .btn-logout {
            background-color: #d9534f;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-logout:hover {
            background-color: #c9302c;
        }

        /* Style for tables */
        table {
            width: 100%;
            border-collapse: scroll;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

    <header>
        <h1>Welcome to the Manager Dashboard Fadhilah Bakery</h1>
    </header>

    <nav>
        <a href="add_worker.php">Add New Worker</a>
        <a href="view_sales.php">View Sales</a>
        <a href="view_reports.php">View Reports</a>
        <a href="manage_inventory.php">Manage Inventory</a>
        <a href="logout.php" class="btn-logout">Logout</a>
    </nav>

    <div class="container">
        <h2>Dashboard Overview</h2>
        <p>Here you can manage your workers, view sales and expenses, and generate reports.</p>

        <h3>Workers</h3>
        <?php
        // Query to fetch all workers from the database
        $workerQuery = "SELECT * FROM workers";  // Get all workers
        $workerResult = mysqli_query($conn, $workerQuery);  // Execute the query

        if (mysqli_num_rows($workerResult) > 0) {
            echo "<table>";
            echo "<tr><th>Name</th><th>Position</th><th>Hired Date</th></tr>";  // Adjusted column header to "Hired Date"
            
            // Loop through the worker records and display them
            while ($worker = mysqli_fetch_assoc($workerResult)) {
                echo "<tr>
                        <td>{$worker['name']}</td>
                        <td>{$worker['position']}</td>
                        <td>{$worker['hired_date']}</td>  <!-- Use correct column name -->
                      </tr>";
            }
            echo "</table>";  // End the table
        } else {
            echo "No workers found.";  // If no workers exist in the database
        }
        ?>
    </div>

    <?php
    // Assuming you're already connected to the database with $conn
    $salesQuery = "SELECT * FROM sales ORDER BY date DESC"; // Fetch all records from the sales table ordered by date
    $salesResult = mysqli_query($conn, $salesQuery);  // Execute the query

    if (mysqli_num_rows($salesResult) > 0) {
        // If records exist, display them in a table
        echo "<table border='1'>";
        echo "<tr><th>Amount</th><th>Date</th><th>Description</th><th>Buyer Name</th></tr>";  // Table headers
        
        // Loop through the records and display them
        while ($row = mysqli_fetch_assoc($salesResult)) {
            echo "<tr>
                    <td>{$row['amount']}</td>
                    <td>{$row['date']}</td>
                    <td>{$row['description']}</td>
                    <td>{$row['buyer_name']}</td>
                  </tr>";
        }
        echo "</table>";  // End the table
    } else {
        echo "No sales records found.";  // If no records, show this message
    }
    ?>

    <form method="POST">
      
    </form>
    <?php
    if (isset($_POST['export'])) {
        $filename = "sales_report.csv";
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        fputcsv($output, array('Amount', 'Date', 'Description', 'Buyer Name'));
        
        $salesQuery = "SELECT * FROM sales ORDER BY date DESC";  // Fetch sales data
        $salesResult = mysqli_query($conn, $salesQuery);

        while ($row = mysqli_fetch_assoc($salesResult)) {
            fputcsv($output, $row);  // Output each row in CSV format
        }
        fclose($output);
        exit();
    }
    ?>
<h1>end</h1>
    <footer>
        <p>&copy; 2024 Fadilah Spacial Bakery. All rights reserved.</p>
    </footer>

</body>
</html>
