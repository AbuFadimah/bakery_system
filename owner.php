<?php
    // owner.php
    include('header.php'); // Reuse the header structure
?>
<!-- Include Bootstrap CSS (you can also place it in the <head> of your HTML) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<style type="text/css">
/* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body Styling */
body {
    font-family: 'Arial', sans-serif;
    background-color: #fff8e1; /* Light bakery-themed background */
    color: #333;
}

/* Main Container */
.container {
    width: 80%;
    margin: 0 auto;
}

/* Header Styling for Each Page */
header.header {
    padding: 30px 20px;
    background-color: #f2a400; /* Bakery yellow-orange */
    color: white;
    border-radius: 10px;
    text-align: center;
    margin-bottom: 20px;
}

/* Page Titles */
header.header h1 {
    font-size: 2.8rem;
    margin-bottom: 10px;
}

/* Main Content Sections */
section {
    background-color: #fff;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 30px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

section h2 {
    font-size: 2rem;
    color: #f2a400;
    margin-bottom: 15px;
    text-align: center;
}

section p, section ul {
    font-size: 1.2rem;
    line-height: 1.8;
    color: #555;
    text-align: justify;
}

section ul {
    margin-top: 20px;
}

section li {
    font-size: 1.1rem;
    margin-bottom: 10px;
}

/* Footer Styling for About Pages */
footer.footer {
    padding: 20px;
    background-color: #f2a400; /* Bakery yellow-orange */
    color: white;
    border-radius: 10px;
    text-align: center;
    margin-top: 30px;
}

footer.footer .footer-links {
    margin-top: 10px;
}

footer.footer .footer-links a {
    color: white;
    text-decoration: none;
    font-size: 1.2rem;
    margin: 0 15px;
    padding: 8px 15px;
    border-radius: 5px;
    background-color: #333;
    transition: background-color 0.3s ease;
}

footer.footer .footer-links a:hover {
    background-color: #555;
}
</style>

<div class="container">
    <header class="header">
        <h1>About the Owner</h1>
    </header>

    <section>
        <h2>Meet the Owner: Alhaji Saidu</h2>
        <p>Alhaji Saidu, the founder of Fadilah Spacial Bakery, has always had a passion for baking. Starting as a small business since 20 years ago, his dedication to quality ingredients and innovative recipes has turned his bakery into a beloved local establishment.</p>
        <p>His vision for the bakery is to offer freshly baked goods made with love and the finest ingredients, ensuring that every bite tells a story of craftsmanship and care.</p>
    </section>

    <!-- Carousel Section -->
   <section>
    <h2>Owner's Pictures, Alhaji Saidu Abubakar Ba'i</h2>
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000"> <!-- 2000ms = 2 seconds -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="photo5.jpg" class="d-block w-100" alt="Bakery Image 1">
            </div>
            <div class="carousel-item">
                <img src="photo6.jpg" class="d-block w-100" alt="Bakery Image 2">
            </div>
            <div class="carousel-item">
                <img src="photo2.jpg" class="d-block w-100" alt="Bakery Image 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

</div>

<footer class="footer">
    <p>Come and meet the amazing people behind Fadilah Spacial Bakery!</p>
    <div class="footer-links">
        <a href="index.php">Back to Home</a>
        <a href="managers.php">About the Managers</a>
        <a href="developer.php">About the Developer</a>
    </div>
</footer><br><br><?php
    include('footer.php'); // Reuse the footer structure
?>

<!-- Include Bootstrap JS (before closing </body> tag) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
