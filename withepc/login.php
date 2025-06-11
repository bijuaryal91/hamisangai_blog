<?php
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
    header("location: index.php");
}

$success = $_GET['success'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - HamiSangai Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./css/login.css">
    <style>
        .error-messages {
            color: #dc3545;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 15px;
            display: none;
            align-items: center;
            gap: 10px;
            animation: fadeIn 0.3s ease-in-out;
        }

        .error-messages i {
            font-size: 18px;
        }

        .success-messages {
            color: #28a745;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: fadeIn 0.3s ease-in-out;
        }

        .success-messages i {
            font-size: 18px;
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
        <h1 class="login-title">Admin Login</h1>

        <form class="login-form" id="loginForm">
            <div class="form-group input-with-icon">
                <i class="fas fa-user"></i>
                <input type="email" id="username" placeholder="Email" required>
            </div>

            <div class="form-group input-with-icon">
                <i class="fas fa-lock"></i>
                <input type="password" id="password" placeholder="Password" required>
            </div>

            <div class="remember-forgot">
                <div class="remember-me">
                    <input type="checkbox" id="remember">
                    <label for="remember">Remember me</label>
                </div>
                <div class="forgot-password">
                    <a href="./forgot-password.php">Forgot password?</a>
                </div>
            </div>
            
            <?php if ($success) { ?>
                <div class="success-messages">
                    <i class="fas fa-check-circle"></i>
                    <span class="success-text"><?php echo htmlspecialchars($success) ?></span>
                </div>
            <?php } ?>
            
            <div class="error-messages">
                <i class="fas fa-exclamation-circle"></i>
                <span class="error-text"></span>
            </div>
            
            <button type="submit" class="login-btn">Login</button>

            <div class="login-footer">
                <p>© <?php echo date('Y') ?> HamiSangai Admin Panel. All rights reserved.</p>
            </div>
        </form>
    </div>

    <script src="./js/login.js"></script>

</body>

</html>