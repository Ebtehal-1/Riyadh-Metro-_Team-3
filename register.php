<?php
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'mysql');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
$username = $_POST['username'];

// Check if email already exists
$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $_SESSION['error'] = "Email already exists. Please try another.";
    header("Location: signup.html");
    exit();
}

// Insert new user
$sql = "INSERT INTO users (email, password, username) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $email, $password, $username);

if ($stmt->execute()) {
    $_SESSION['success'] = "Registration successful. Please log in.";
    header("Location: login.html");
    exit();
} else {
    $_SESSION['error'] = "Error: Could not register. Please try again.";
    header("Location: signup.html");
    exit();
}

$conn->close();
?>

