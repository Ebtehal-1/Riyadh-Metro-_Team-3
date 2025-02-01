<?php
session_start();  // Start the session

// Default placeholder values for guests
$username = "User Name";  
$email = "example@ex.com";  

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];  // Get the logged-in user's ID

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'mysql');  // Replace with actual database name

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to fetch user details (username and email)
    $stmt = $conn->prepare("SELECT username, email FROM users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch user details
        $user = $result->fetch_assoc();
        $username = $user['username'];
        $email = $user['email'];
    }

    // Query to fetch the latest 5 tickets booked by the user
    $stmt_history = $conn->prepare("SELECT departure, destination, date, price FROM tickets WHERE user_id = ? ORDER BY date DESC LIMIT 5");
    $stmt_history->bind_param("i", $user_id);
    $stmt_history->execute();
    $history_result = $stmt_history->get_result();

    $tickets = [];
    while ($ticket = $history_result->fetch_assoc()) {
        $tickets[] = $ticket;
    }

    // Close the connection
    $stmt->close();
    $stmt_history->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard</title>
  <link rel="stylesheet" href="css\sharedcss.css">
  <link rel="stylesheet" href="css\accountcss.css">
   
</head>
<body>
  <!-- Header -->
  <header class="header">
    <div class="logo">
      <img src="css/icon.png" alt=""> <!-- Replace with the actual path -->
      <span>Riyadh Metro</span>
    </div>
    <nav class="nav-links">
      <a href="homepage.php">Home</a>
      <a href="#">Contact Us</a>
    </nav>
  </header>

  <div class="container">
    <!-- Left Column -->
    <div class="left-column">
      <!-- Profile Card -->
      <div class="card profile-card">
        <div class="icon">👤</div>
        <div class="text"><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></div>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
        <button class="button">Edit Profile</button>
      </div>

      <!-- Account Settings -->
      <div class="card">
        <div class="text">Account Settings</div>
        <p>Change Password</p>
        <p>Two-Factor Authentication</p>
        <p>Language & Region Preferences</p>
        <p>Delete Account</p>
      </div>
    </div>

    <!-- Right Column -->
    <div class="right-column">
      <!-- Payment Methods -->
      <div class="card">
        <div class="text">Payment Methods</div>
        <p>Visa ending in 1234</p>
        <button class="button">Add New Payment Method</button>
      </div>

      <!-- Booking History -->
      <div class="card">
        <div class="text">Booking History</div>
        <?php if (!empty($tickets)): ?>
            <?php foreach ($tickets as $ticket): ?>
                <p><strong>Journey from:</strong> <?php echo htmlspecialchars($ticket['departure']); ?> <strong>to:</strong> <?php echo htmlspecialchars($ticket['destination']); ?></p>
                <p><strong>Date:</strong> <?php echo htmlspecialchars($ticket['date']); ?>, <strong>Cost:</strong> SAR <?php echo htmlspecialchars($ticket['price']); ?></p>
          
            <?php endforeach; ?>
        <?php else: ?>
            <p>No bookings found.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <div class="footer">
    <div class="footer-content">
      <div>
        <strong>Contact Us</strong><br>
        123213, City, Riyadh<br>
        Email: <a href="mailto:support@ticketplanner.com">support@ticketplanner.com</a><br>
        Phone: +966 456 7890
      </div>
      <div>
        <strong>Transportation Lines</strong><br>
        Line 1: City A - City B<br>
        Line 2: City C - City D<br>
        Line 3: City E - City F
      </div>
      <div>
        <strong>Languages</strong><br>
        English<br>
        Arabic
      </div>
    </div>
  </div>
</body>
</html>
