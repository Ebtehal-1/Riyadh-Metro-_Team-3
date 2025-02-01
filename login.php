<?php
session_start(); // Start the session

// Clear any existing session data to prevent auto login issues
if (isset($_SESSION['user_id'])) {
    unset($_SESSION['user_id']);  // Remove user_id from the session
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'mysql'); // Use the correct database name
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate form data
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $_SESSION['error'] = "Please fill in all fields.";
        header("Location: login.html?error=" . urlencode($_SESSION['error']) . "&email=" . urlencode($_POST['email']));
        exit();
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query to check if the user exists
    $stmt = $conn->prepare("SELECT user_id, password FROM users WHERE email = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User exists, now check password
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Successful login: Store user_id in session
            $_SESSION['user_id'] = $user['user_id'];

            // Redirect to homepage (or any page for logged-in users)
            header("Location: homepage.php");
            exit();
        } else {
            // Incorrect password: Set error and redirect
            $_SESSION['error'] = "Incorrect password. Please try again.";
            header("Location: login.html?error=" . urlencode($_SESSION['error']) . "&email=" . urlencode($email));
            exit();
        }
    } else {
        // No account found: Set error and redirect
        $_SESSION['error'] = "No account found with this email.";
        header("Location: login.html?error=" . urlencode($_SESSION['error']) . "&email=" . urlencode($email));
        exit();
    }
} else {
    // Invalid access to the page: Redirect if not a POST request
    $_SESSION['error'] = "Please log in to continue.";
    header("Location: login.html?error=" . urlencode($_SESSION['error']));
    exit();
}
?>
