<?php
session_start();
include_once("../../includes/conn.php");

// Collect and sanitize input
$token = trim($_POST['token'] ?? '');
$new_password = trim($_POST['new_password'] ?? '');
$confirm_password = trim($_POST['confirm_password'] ?? '');

// Basic validation
if (empty($token) || empty($new_password) || empty($confirm_password)) {
    echo "All fields are required!";
    exit;
}

// Check password match
if ($new_password !== $confirm_password) {
    echo "Passwords do not match";
    exit;
}

// Password strength validation (optional)
if (strlen($new_password) < 8) {
    echo "Password must be at least 8 characters";
    exit;
}

// Check token against database
date_default_timezone_set('Asia/Kathmandu');
$current_time = date('Y-m-d H:i:s');

$query = $conn->prepare("SELECT id, email, password_reset_expires FROM admins WHERE password_reset_token = ?");
$query->execute([$token]);
$admin = $query->fetch(PDO::FETCH_ASSOC);

if (!$admin) {
    echo "Invalid or expired token";
    exit;
}

// Check if token has expired
if ($current_time > $admin['password_reset_expires']) {
    echo "Token has expired";
    exit;
}

// Hash the new password
$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

// Update password and clear reset token
$update = $conn->prepare("UPDATE admins SET password_hash = ?, password_reset_token = NULL, password_reset_expires = NULL WHERE id = ?");
if ($update->execute([$hashed_password, $admin['id']])) {
    echo "success";
} else {
    echo "Failed to reset password";
}
exit;
