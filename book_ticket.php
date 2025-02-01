<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");  // Redirect to login page if not logged in
    exit();
}


// Capture form data
$user_id = $_SESSION['user_id'];  // Get the user ID from the session
$departure = $_POST['starting_station']; // Starting station
$destination = $_POST['destination_station']; // Destination station
$date = $_POST['travel_date']; // Travel date
$price = $_POST['total_price'];  // Get the total price from JavaScript

// Database connection
$conn = new mysqli('localhost', 'root', '', 'mysql');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert ticket details into the database
$stmt = $conn->prepare("INSERT INTO tickets (user_id, departure, destination, date, price) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("isssd", $user_id, $departure, $destination, $date, $price);

// Execute the statement
if ($stmt->execute()) {
    // Set session success message
    $_SESSION['success_message'] = "Ticket booked successfully! Price: SAR " . $price;
    header("Location: book.html");  // Redirect back to book.html to show the success message
    exit();
} else {
    echo "Error booking ticket: " . $stmt->error;
}

// Close the connection
$stmt->close();
$conn->close();
?>
