<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if the user is not logged in
    header("Location: login.php");
    exit(); // Stop the script from executing further
}

// If logged in, fetch user ID (optional)
$user_id = $_SESSION['user_id'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Riyadh Metro</title>
   <link rel="stylesheet" href="css\sharedcss.css">
   <link rel="stylesheet" href="css\homecss_(0).css">
</head>
<body>
   <header class="header">
      <div class="logo">
         <img src="images\Train.jpg" alt="Riyadh Metro Logo" width="40">
         <span>Riyadh Metro</span>
      </div>
      <nav>
         <a href="ShortestPath.html">Shortest Path</a>
         <a href="RechargeBalancc.html">Balance</a>
         <a href="http://localhost/RiyadhMetro/account.php
">My Account</a> <!-- Note: account.php for dynamic page -->
         <a href="book.html">Book Ticket</a>
      </nav>
   </header>

   <section class="hero">
    <div class="hero-image">
      <img src="images\HomTrain.png" alt="Train Image">
    </div>
    <div class="hero-text">
      <h1>Experience Fast and Reliable Travel with Riyadh Metro!</h1>
     <a href="book.html">
      <button>Book Your Trip Now</button>
    </a>
    </div>
      
  </section>

  <!-- About Section -->
  <section class="about">
    <h2>About Riyadh Metro</h2>
    <p>Riyadh Metro is your ultimate solution for fast, efficient, and safe travel across the city. It features multiple lines, connecting all major areas with state-of-the-art facilities.</p>
  </section>

  <!-- Schedule Section -->
  <section class="schedule">
    <div class="card">
      <h3>Line 1: Blue Line</h3>
      <p>Times: 6:00 AM - 11:00 PM</p>
      <p>Stations: King Khalid Airport - Al Aziziyah</p>
    </div>
    <div class="card">
      <h3>Line 2: Red Line</h3>
      <p>Times: 5:30 AM - 12:00 AM</p>
      <p>Stations: King Abdullah Financial District - Diplomatic Quarter</p>
    </div>
    <div class="card">
      <h3>Line 3: Green Line</h3>
      <p>Times: 6:00 AM - 10:30 PM</p>
      <p>Stations: Al Malaz - Al Batha</p>
    </div>
  </section>

  <div class="map-container">
    <h2>Riyadh Metro Map</h2>
    <div class="map-box">
        <img src="images\MapMetro.jpg" alt="Riyadh Metro Map">
        <p class="map-caption">Explore the Riyadh Metro Network for easy and efficient travel.</p>
    </div>
</div>

  
  <!-- Features Section -->
  <section class="features">
    <div class="feature">
      <img src="images\Icon wifi.png" alt="Feature 1">
      <h4>Free Wi-Fi</h4>
    </div>
    <div class="feature">
      <img src="images\Icon shield.png" alt="Feature 2">
      <h4>High Security Standards</h4>
    </div>
    <div class="feature">
      <img src="images\Icon credit card.png" alt="Feature 3">
      <h4>Easy Digital Payments</h4>
    </div>
    
    </div>
  </section> 

   <footer class="footer">
      <p>© 2023 Riyadh Metro. All Rights Reserved.</p>
   </footer>
   <script>
    // JavaScript for horizontal scroll control (swiping effect)
    const scheduleContainer = document.querySelector('.schedule-container');
    scheduleContainer.addEventListener('scroll', () => {
      if (scheduleContainer.scrollLeft + scheduleContainer.offsetWidth >= scheduleContainer.scrollWidth) {
        scheduleContainer.scrollLeft = 0; // Scroll to the start if the end is reached
      }
    });
  </script>
</body>
</html>