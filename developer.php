<?php
    // developer.php
    include('header.php'); // Reuse the header structure
?>
<style type="text/css">/* General Reset */
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
        <h1>About the Developer</h1>
    </header>

    <section>
        <h2>Meet the Developer: Alamin Saidu Abuakar</h2>
        <p>Alamin is the web developer responsible for bringing Fadilah Spacial Bakery's online presence to life. With a background in web development and a passion for creative design, Alamin has worked hard to ensure that the website is both functional and visually appealing.</p>
        <p>Alamin has collaborated with the bakery team to create a user-friendly platform that provides customers with an enjoyable online experience. From developing the layout to ensuring seamless navigation, his work supports the business's mission to serve the best bakery products with ease.</p>
        <p>For any Issue the Visitor can call the Developer through his contact : 09124452565, or chat on  <a href="https://wa.me/2349124452565" class="whatsapp-button" target="_blank">WhatsApp</a></p>
    </section>

    <footer class="footer">
        <p>Come and meet the amazing people behind Fadilah Spacial Bakery!</p>
        <div class="footer-links">
            <a href="index.php">Back to Home</a>
            <a href="owner.php">About the Owner</a>
            <a href="developer.php">About the Developer</a>
        </div>
    </footer><br><?php
    include('footer.php'); // Reuse the footer structure
?>
</div>

