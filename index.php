<?php
    // File to store the like count
    $likeFile = 'likes.txt';

    // Check if the file exists and read the current like count
    if (file_exists($likeFile)) {
        $likeCount = (int)file_get_contents($likeFile);
    } else {
        $likeCount = 0;  // Default to 0 if the file doesn't exist
    }

    // Increment like count when the button is clicked
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['like'])) {
        $likeCount++;
        file_put_contents($likeFile, $likeCount);  // Save the updated like count to the file
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fadilah</title>
    <link rel="stylesheet" href="styles.css">
    <style type="text/css">
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #fff8e1; /* Light bakery-themed background */
            color: #333;
            text-align: center;
        }

        /* Container for the whole page */
        .container {
            width: 80%;
            margin: 0 auto;
        }

        /* Like Button Section Styling */
        .like-section {
            padding: 5px 10px;
            background-color: #FF00FF; /* Bakery yellow-orange */
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 5px; /* Reduced gap between button and counter */
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: fixed; /* Fixed positioning */
            top: 10px; /* Positioned at the top */
            left: 10px; /* Positioned at the left */
            z-index: 1000; /* Ensure it stays on top */
        }

        .like-btn {
            padding: 6px 12px; /* Reduced padding */
            background-color: blue;
            color: white;
            font-size: 12px; /* Smaller font size */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .like-btn:hover {
            background-color: green;
        }

        .like-section p {
            font-size: 12px; /* Smaller font size for the counter */
        }

        /* Header styling */
        .header {
            padding: 20px;
            background-color: #f2a400; /* Bakery yellow-orange */
            color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 1.2rem;
        }

        /* Login link at the top */
        .login-link {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 1.2rem;
            text-decoration: none;
            color: white;
            font-weight: bold;
            background-color: #333;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .login-link:hover {
            background-color: #555;
        }

        /* Image gallery section */
        .image-gallery {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 30px;
        }

        .image-item {
            flex: 1;
            max-width: 100%; /* Adjusts to full screen for mobile */
            border: 5px solid #f2a400;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 20px;
        }

        .image-item img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Table for buyers */
        table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2a400;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        /* Footer styling */
        .footer {
            margin-top: 40px;
            padding: 20px;
            background-color: #f2a400;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .footer p {
            font-size: 1.2rem;
            color: white;
        }

        /* Link styling for footer */
        .footer-links {
            margin-top: 15px;
        }

        .footer-links a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-weight: bold;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }

        /* Responsive design */
        @media screen and (max-width: 768px) {
            .container {
                width: 90%;
                padding: 20px;
            }

            .image-gallery {
                flex-direction: column; /* Stacks images in a column for mobile */
            }

            .image-item {
                max-width: 100%; /* Ensures each image takes full width on mobile */
            }

            .login-link {
                position: static;
                margin-top: 20px;
            }
        }

        /* For tablet and larger screens (laptops, desktops) */
        @media screen and (min-width: 769px) {
            .image-gallery {
                display: grid;
                grid-template-columns: repeat(2, 1fr); /* 2 images per row on larger screens */
                gap: 20px;
            }

            .image-item {
                max-width: 100%; /* Keeps the images responsive */
            }
        }

    </style>
</head>
<body>
    <div class="container">
        <!-- Like Button and Counter Section at Top-Left -->
        <div class="like-section">
            <form method="post">
                <button class="like-btn" type="submit" name="like" id="like-btn">Like Us</button>
            </form>
            <p>Total Likes: <?php echo $likeCount; ?></p> <!-- Display the current like count -->
        </div>

        <!-- Login Link moved to the top-right corner -->
        <a href="login.php" class="login-link">Login as Manager</a>

        <header class="header">
            <h1>Welcome to Our Site</h1><br>
            <h1>Fadilah Spacial Bakery</h1>
            <p>Your one-stop shop for freshly baked goods!</p>
        </header>

        <!-- Image Gallery Section -->
        <section class="image-gallery">
            <div class="image-item">
                <img src="bread1.jpg" alt="Bakery Product 1">
            </div>
            <div class="image-item">
                <img src="bread2.jpg" alt="Bakery Product 2">
            </div>
            <div class="image-item">
                <img src="bread3.jpg" alt="Bakery Product 3">
            </div>
        </section>

        <!-- Additional Image Gallery Section (More Pictures) -->
        <section class="image-gallery">
            <div class="image-item">
                <img src="bread4.jpg" alt="Bakery Product 4">
            </div>
            <div class="image-item">
                <img src="bread1.jpg" alt="Bakery Product 5">
            </div>
            <div class="image-item">
                <img src="bread4.jpg" alt="Bakery Product 6">
            </div>
        </section>

        <!-- Buyers Table -->
        <section class="buyers">
            <h2>Our Staff</h2>
            <h5>You can Call Them If You Need Bread</h5>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone Number</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Mai Karama</td>
                        <td>(+234) 123-4567</td>
                    </tr>
                    <tr>
                        <td>Malam Ahmad</td>
                        <td>(+234) 987-6543</td>
                    </tr>
                    <tr>
                        <td>Babi</td>
                        <td>(+234) 567-8901</td>
                    </tr>
                    <tr>
                        <td>Other Name</td>
                        <td>(+234) 234-5678</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- Footer Section -->
        <?php
            include('footer.php'); // Reuse the footer structure
        ?>

    </div>

</body>
</html>
