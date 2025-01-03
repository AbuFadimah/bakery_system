<!-- footer.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Section</title>
    <style type="text/css">
        /* Footer Styling */
        footer.footer {
            padding: 20px;
            background-color: #f2a400; /* Bakery yellow-orange */
            color: white;
            border-radius: 10px;
            text-align: center;
            margin-top: 30px;
        }

        footer.footer p {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        footer.footer .footer-links {
            margin-top: 10px;
        }

        footer.footer .footer-links a {
            color: white;
            text-decoration: none;
            font-size: 1.1rem;
            margin: 0 5px;
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #333;
            transition: background-color 0.3s ease;
        }

        footer.footer .footer-links a:hover {
            background-color: #555;
        }

        /* Responsive Design for Footer */
        @media screen and (max-width: 1024px) {
            footer.footer {
                padding: 20px;
            }

            footer.footer .footer-links a {
                font-size: 1rem; /* Slightly smaller font size */
                padding: 10px 15px; /* Reduced padding for better spacing */
                margin: 0 15px; /* Adjusted margin between links */
            }
        }

        @media screen and (max-width: 768px) {
            footer.footer {
                padding: 20px;
            }

            footer.footer .footer-links a {
                font-size: 1rem; /* Slightly smaller font size */
                padding: 8px 12px; /* Reduced padding for better mobile view */
                margin: 5px 10px; /* Reduced space between links */
            }

            footer.footer .footer-links {
                display: flex;
                flex-wrap: wrap;
                justify-content: center; /* Ensures the links are centered */
                gap: 15px; /* Adds spacing between links */
            }

            footer.footer .footer-links a {
                width: auto;
                text-align: center;
            }
        }

        @media screen and (max-width: 480px) {
            footer.footer {
                padding: 15px;
            }

            footer.footer .footer-links a {
                font-size: 0.9rem; /* Smaller font size for very small screens */
                padding: 8px 10px;
                margin: 5px 0; /* Remove margin between links */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <footer class="footer">
            <p>&copy; 2024 Fadilah Spacial Bakery. All Rights Reserved.</p>
            <div class="footer-links">
                <a href="index.php">Back to Home</a>
                <a href="owner.php">About the Owner</a>
                <a href="managers.php">About the Managers</a>
                <a href="developer.php">About the Developer</a>
            </div>
        </footer>
    </div>
</body>
</html>
