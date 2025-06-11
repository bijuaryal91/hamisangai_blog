<?php
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
    header("location: index.php");
    exit;
}

// Check for error messages from URL
$error = $_GET['error'] ?? '';
$success = $_GET['success'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - HamiSangai Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./css/login.css">
    <style>
        .password-reset-instructions {
            text-align: center;
            color: #666;
            margin-bottom: 20px;
            font-size: 14px;
            line-height: 1.5;
        }

        .back-to-login {
            text-align: center;
            margin-top: 20px;
        }

        .back-to-login a {
            color: #4361ee;
            text-decoration: none;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            transition: color 0.3s;
        }

        .back-to-login a:hover {
            color: #3a56d4;
            text-decoration: underline;
        }

        .back-to-login i {
            margin-right: 5px;
            font-size: 12px;
        }

        .message-container {
            margin-bottom: 20px;
        }

        .error-message {
            color: #dc3545;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 15px;
            display: <?php echo $error ? 'flex' : 'none' ?>;
            align-items: center;
            gap: 10px;
            animation: fadeIn 0.3s ease-in-out;
        }

        .error-message i {
            font-size: 18px;
        }

        .success-message {
            color: #28a745;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 15px;
            display: <?php echo $success ? 'flex' : 'none' ?>;
            align-items: center;
            gap: 10px;
            animation: fadeIn 0.3s ease-in-out;
        }

        .success-message i {
            font-size: 18px;
        }

        .reset-btn {
            margin-top: 10px;
            background-color: #4361ee;
            transition: background-color 0.3s;
        }

        .reset-btn:hover {
            background-color: #3a56d4;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-logo">
            <img src="https://picsum.photos/150/50?random=1" alt="HamiSangai Admin">
        </div>
        <h1 class="login-title">Reset Password</h1>
        <p class="password-reset-instructions">Enter your email address and we'll send you a link to reset your password.</p>

        <div class="message-container">
            <div class="error-message">
                <?php if ($error): ?>
                    <i class="fas fa-exclamation-circle"></i>
                    <span><?php echo htmlspecialchars(urldecode($error)); ?></span>
                <?php endif; ?>
            </div>

            <div class="success-message">
                <?php if ($success): ?>
                    <i class="fas fa-check-circle"></i>
                    <span><?php echo htmlspecialchars(urldecode($success)); ?></span>
                <?php endif; ?>
            </div>
        </div>

        <form class="login-form" id="forgotPasswordForm">
            <div class="form-group input-with-icon">
                <i class="fas fa-envelope"></i>
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>


            <button class="login-btn reset-btn">Send Reset Link</button>

            <div class="back-to-login">
                <a href="./login.php"><i class="fas fa-arrow-left"></i> Back to Login</a>
            </div>
        </form>

        <div class="login-footer">
            <p>© <?php echo date('Y') ?> HamiSangai Admin Panel. All rights reserved.</p>
        </div>
    </div>

    <script>
        // Display any URL errors
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const error = urlParams.get('error');
            const success = urlParams.get('success');

            // Remove error/success from URL without reload
            if (error || success) {
                const cleanUrl = window.location.origin + window.location.pathname;
                window.history.replaceState({}, document.title, cleanUrl);
            }
        });
    </script>
    <script src="./js/forgot-password.js"></script>
</body>

</html>