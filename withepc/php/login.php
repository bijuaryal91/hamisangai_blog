<?php


session_start();
include_once("../../includes/conn.php");

// Collect and sanitize input
$email    = trim($_POST['username'] ?? '');
$pass     = trim($_POST['password'] ?? '');
$checkbox = trim($_POST['checkbox'] ?? '');

// Basic validation
if ($email === '' || $pass === '') {
    echo "Error: All fields are required.";
    exit;
}

// ✅ Email format validation
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Error: Invalid email format.";
    exit;
}

try {
    // Prepare and execute query
    $stmt = $conn->prepare("SELECT id, email, password_hash FROM admins WHERE email = :email LIMIT 1");
    $stmt->execute(['email' => $email]);

    // Fetch user
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify the original password against the stored hash
    if ($user && password_verify($pass, $user['password_hash'])) {
        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];


        echo "success";
    } else {
        echo "Invalid email or password.";
    }
} catch (PDOException $e) {
    // Log in production, avoid displaying raw DB errors
    echo "Database error: " . $e->getMessage();
}
