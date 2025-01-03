<?php
    // managers.php
    include('header.php'); // Reuse the header structure
?>
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

.manager-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 10px;
}

.manager-info .phone-number {
    font-size: 1.1rem;
}

.manager-info .whatsapp-button {
    background-color: #25D366; /* WhatsApp green */
    color: white;
    padding: 12px 25px;
    border-radius: 5px;
    text-decoration: none;
    font-size: 1.1rem;
    display: inline-block;
    transition: background-color 0.3s ease;
}

.manager-info .whatsapp-button:hover {
    background-color: #128C7E; /* WhatsApp darker green on hover */
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
        <h1>About the Managers</h1>
    </header>

    <section>
        <h2>Our Dedicated Managers</h2>
        <p>Our team of experienced managers is committed to ensuring that Fadilah Spacial Bakery runs smoothly and provides excellent service to all customers. Meet the people who bring our vision to life:</p>

        <ul>
            <li>
                <strong>Managers Name</strong> – His Fill
                <div class="manager-info">
                    <span class="phone-number">Phone: (+234) 123-4567</span>
                    <a href="https://wa.me/2341234567" class="whatsapp-button" target="_blank">WhatsApp</a>
                </div>
            </li>
            <li>
                <strong>Managers Name</strong> – His Fill
                <div class="manager-info">
                    <span class="phone-number">Phone: (+234) 234-5678</span>
                    <a href="https://wa.me/2342345678" class="whatsapp-button" target="_blank">WhatsApp</a>
                </div>
            </li>
            <li>
                <strong>Managers Name</strong> – His Fill
                <div class="manager-info">
                    <span class="phone-number">Phone: (+234) 345-6789</span>
                    <a href="https://wa.me/2343456789" class="whatsapp-button" target="_blank">WhatsApp</a>
                </div>
            </li>
        </ul>
        <p>Each of our managers plays an essential role in maintaining the quality of our bakery's operations, from product development to customer satisfaction.</p>
    </section>

    <footer class="footer">
        <p>Come and meet the amazing people behind Fadilah Spacial Bakery!</p>
        <div class="footer-links">
            <a href="index.php">Back to Home</a>
            <a href="owner.php">About the Owner</a>
            <a href="developer.php">About the Developer</a>
        </div>
    </footer>
</div>

<?php
    include('footer.php'); // Reuse the footer structure
?>
