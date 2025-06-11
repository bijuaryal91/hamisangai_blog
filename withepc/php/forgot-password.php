<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';



session_start();
include_once("../../includes/conn.php");

// Collect and sanitize input
$email = trim($_POST['email'] ?? '');

// Basic validation
if ($email === '') {
    echo "Error: Email is required.";
    exit;
}

// Email format validation
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Error: Invalid email format.";
    exit;
}

// Check if admin with this email exists
$query = $conn->prepare("SELECT id, name FROM admins WHERE email = ?");
$query->execute([$email]);
$admin = $query->fetch(PDO::FETCH_ASSOC);

if (!$admin) {
    echo "Error: Email not found.";
    exit;
}

// Generate a secure token
$token = bin2hex(random_bytes(32));
date_default_timezone_set('Asia/Kathmandu'); 
$token_expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

// Store the token in the database
$update = $conn->prepare("UPDATE admins SET password_reset_token = ?, password_reset_expires = ? WHERE email = ?");
if (!$update->execute([$token, $token_expiry, $email])) {
    echo "Error: Could not save reset token.";
    exit;
}

// Send password reset email

$reset_link = "https://withepc.com/reset-password.php?token=" . urlencode($token);
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'sathisangat11@gmail.com';
    $mail->Password   = 'pghesvflkmsbvhsb';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Recipients
    $mail->setFrom('sathisangat11@gmail.com', 'WithEpc');
    $mail->addAddress($email, $admin['name']);
    $mail->addReplyTo('info@withepc.com', 'Information');

    $mail->isHTML(true);
    $mail->Subject = "Password Reset Request";

    $mail->Body = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Password Reset</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                color: #1b263b;
                margin: 0;
                padding: 0;
                background-color: #f8f9fa;
            }
            .container {
                max-width: 600px;
                margin: 20px auto;
                padding: 20px;
                background-color: #ffffff;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }
            .header {
                text-align: center;
                padding-bottom: 20px;
                border-bottom: 1px solid #eee;
            }
            .logo {
                max-width: 150px;
                margin-bottom: 20px;
            }
            .content {
                padding: 20px 0;
            }
            .button {
                display: inline-block;
                padding: 12px 24px;
                background-color: #4561ee;
                color: white !important;
                text-decoration: none;
                border-radius: 4px;
                font-weight: bold;
                margin: 20px 0;
                transition: background-color 0.3s;
            }
            .button:hover {
                background-color: #3f37c9;
            }
            .footer {
                text-align: center;
                padding-top: 20px;
                border-top: 1px solid #eee;
                font-size: 12px;
                color: #777;
            }
            .expiry-notice {
                background-color: #fff8e1;
                padding: 10px;
                border-left: 4px solid #e63946;
                margin: 15px 0;
            }
            .greeting {
                color: #1b263b;
                font-size: 18px;
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <img src="http://picsum.photos/350/150" alt="Company Logo" class="logo">
                <h1 style="color: #4361ee">Password Reset Request</h1>
            </div>
            
            <div class="content">
                <p class="greeting">Hello ' . htmlspecialchars($admin['name']) . ',</p>
                <p>We received a request to reset your password. Click the button below to proceed:</p>
                
                <div style="text-align: center;">
                    <a href="' . $reset_link . '" class="button">Reset Password</a>
                </div>
                
                <div class="expiry-notice">
                    <p><strong>Important:</strong> This link will expire in 1 hour for security reasons.</p>
                </div>
                
                <p>If you didn\'t request this password reset, please ignore this email or contact our support team if you have any concerns.</p>
                
                <p>Thanks,<br>The WithEpc Team</p>
            </div>
            
            <div class="footer">
                <p>&copy; ' . date('Y') . ' WithEpc. All rights reserved.</p>
                <p>If you\'re having trouble with the button above, copy and paste this link into your browser:</p>
                <p>' . $reset_link . '</p>
            </div>
        </div>
    </body>
    </html>
    ';

    // Plain text version for non-HTML clients
    $mail->AltBody = "Password Reset Request\n\n" .
        "Hello " . $admin['name'] . ",\n\n" .
        "We received a request to reset your password. Please use the following link to reset your password:\n\n" .
        $reset_link . "\n\n" .
        "This link will expire in 1 hour for security reasons.\n\n" .
        "If you didn't request this password reset, please ignore this email or contact our support team.\n\n" .
        "Thanks,\n" .
        "The WithEpc Team";

    $mail->send();
    echo "success";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
