<?php
session_start();
include_once("./includes/conn.php");

// Redirect if already logged in
if (isset($_SESSION['user_id']) && isset($_SESSION['user_email'])) {
    header("location: ./withepc/index.php");
    exit;
}

// Check if token is provided
$token = $_GET['token'] ?? '';

// Initialize error/success messages
$error = $_GET['error'] ?? '';
$success = '';

if (empty($token)) {
    header("Location: ./withepc/forgot-password.php?error=Invalid or missing token");
    exit;
}

// Validate token format (64 hex characters)
if (!preg_match('/^[a-f0-9]{64}$/i', $token)) {
    header("Location: ./withepc/forgot-password.php?error=Invalid token format");
    exit;
}

// Check token against database
date_default_timezone_set('Asia/Kathmandu');
$current_time = date('Y-m-d H:i:s');

$query = $conn->prepare("SELECT id, email, password_reset_expires FROM admins WHERE password_reset_token = ?");
$query->execute([$token]);
$admin = $query->fetch(PDO::FETCH_ASSOC);

if (!$admin) {
    header("Location: ./withepc/forgot-password.php?error=Invalid or expired token");
    exit;
}

// Check if token has expired
if ($current_time > $admin['password_reset_expires']) {
    header("Location: ./withepc/forgot-password.php?error=Expired token");
    exit;
}

// Handle form submission (for AJAX compatibility)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = trim($_POST['new_password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');

    if (empty($new_password) || empty($confirm_password)) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'All fields are required']);
        exit;
    } elseif ($new_password !== $confirm_password) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Passwords do not match']);
        exit;
    } elseif (strlen($new_password) < 8) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Password must be at least 8 characters']);
        exit;
    } elseif (!preg_match('/[A-Z]/', $new_password) || !preg_match('/[0-9]/', $new_password) || !preg_match('/[^A-Za-z0-9]/', $new_password)) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Password must contain at least one uppercase letter, one number, and one special character']);
        exit;
    } else {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update password and clear reset token
        $update = $conn->prepare("UPDATE admins SET password = ?, password_reset_token = NULL, password_reset_expires = NULL WHERE id = ?");
        if ($update->execute([$hashed_password, $admin['id']])) {
            header('Content-Type: application/json');
            echo json_encode(['success' => 'Password has been reset successfully! You can now login with your new password.']);
        } else {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Failed to reset password. Please try again.']);
        }
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - HamiSangai Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./withepc/css/login.css">
    <style>
        /* Enhanced professional styling */
        .login-container {
            max-width: 450px;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        .login-logo img {
            max-height: 60px;
            transition: transform 0.3s ease;
        }

        .login-logo img:hover {
            transform: scale(1.05);
        }

        .login-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .password-reset-instructions {
            font-size: 0.95rem;
            color: #555;
            margin-bottom: 2rem;
            line-height: 1.5;
        }

        .message-container {
            margin-bottom: 1.5rem;
        }

        .error-message,
        .success-message {
            padding: 0.75rem;
            border-radius: 6px;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .error-message {
            background-color: #ffe6e6;
            color: var(--danger-color);
            border-left: 4px solid var(--danger-color);
        }

        .success-message {
            background-color: #e6f4ea;
            color: var(--success-color);
            border-left: 4px solid var(--success-color);
        }

        .password-strength-container {
            margin: 0.75rem 0;
            height: 8px;
            background-color: #f0f0f0;
            border-radius: 4px;
            overflow: hidden;
        }

        .password-strength-bar {
            height: 100%;
            width: 0%;
            transition: width 0.3s ease, background-color 0.3s ease;
        }

        .password-strength-text {
            font-size: 0.85rem;
            font-weight: 500;
            text-align: right;
            margin-bottom: 0.75rem;
        }

        .password-criteria {
            font-size: 0.85rem;
            color: #555;
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            border-left: 4px solid #e0e0e0;
            margin-bottom: 1.5rem;
        }

        .criteria-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .criteria-item i {
            font-size: 0.9rem;
            width: 20px;
            text-align: center;
        }

        .criteria-met {
            color: var(--success-color);
        }

        .criteria-not-met {
            color: #6c757d;
        }

        .criteria-text {
            transition: color 0.3s ease;
        }

        .reset-btn {
            background-color: var(--primary-color);
            padding: 0.85rem;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 6px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .reset-btn:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }

        .back-to-login {
            margin-top: 1.5rem;
            font-size: 0.95rem;
        }

        .back-to-login a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .back-to-login a:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }

        .login-footer {
            margin-top: 2rem;
            font-size: 0.85rem;
            color: #777;
        }

        .input-with-icon {
            position: relative;
        }

        .input-with-icon input {
            padding-left: 40px;
            padding-right: 40px;
            /* Added to prevent text overlap with eye icon */
        }

        .input-with-icon i.fa-lock {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #777;
            font-size: 1rem;
        }

        .password-toggle {
            position: absolute;
            right: 45px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #777;
            font-size: 0.9rem;
            padding: 0;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: var(--primary-color);
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 1.75rem;
            }

            .login-title {
                font-size: 1.5rem;
            }

            .password-reset-instructions {
                font-size: 0.9rem;
            }

            .reset-btn {
                padding: 0.75rem;
            }

            .input-with-icon input {
                padding-left: 35px;
                padding-right: 35px;
            }

            .input-with-icon i.fa-lock {
                left: 10px;
            }

            .password-toggle {
                right: 50px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-logo">
            <img src="https://picsum.photos/150/50?random=1" alt="HamiSangai Admin">
        </div>
        <h1 class="login-title">Reset Your Password</h1>
        <p class="password-reset-instructions">Enter a new password for your account. Ensure it meets the security requirements below.</p>


        <div class="error-message <?php echo empty($error) ? 'hidden' : ''; ?>" id="errorMessage">
            <?php if ($error): ?>
                <i class="fas fa-exclamation-circle"></i>
                <span><?php echo htmlspecialchars($error); ?></span>
            <?php endif; ?>
        </div>

        <div class="success-message <?php echo empty($success) ? 'hidden' : ''; ?>" id="successMessage">
            <?php if ($success): ?>
                <i class="fas fa-check-circle"></i>
                <span><?php echo htmlspecialchars($success); ?></span>
            <?php endif; ?>
        </div>


        <?php if (!$success): ?>
            <form class="login-form" id="resetPasswordForm">
                <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

                <div class="form-group input-with-icon">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="new_password" name="new_password" placeholder="New Password" required>
                    <button type="button" class="password-toggle" id="toggleNewPassword">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>

                <div class="password-strength-container">
                    <div class="password-strength-bar" id="passwordStrengthBar"></div>
                </div>
                <div class="password-strength-text" id="passwordStrengthText"></div>

                <div class="password-criteria">
                    <div id="lengthCriteria" class="criteria-item criteria-not-met">
                        <i class="far fa-circle"></i>
                        <span class="criteria-text">At least 8 characters</span>
                    </div>
                    <div id="uppercaseCriteria" class="criteria-item criteria-not-met">
                        <i class="far fa-circle"></i>
                        <span class="criteria-text">One uppercase letter (A-Z)</span>
                    </div>
                    <div id="numberCriteria" class="criteria-item criteria-not-met">
                        <i class="far fa-circle"></i>
                        <span class="criteria-text">One number (0-9)</span>
                    </div>
                    <div id="specialCriteria" class="criteria-item criteria-not-met">
                        <i class="far fa-circle"></i>
                        <span class="criteria-text">One special character (!@#$%^&*)</span>
                    </div>
                </div>

                <div class="form-group input-with-icon">
                    <i class="fas fa-lock"></i>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                    <button type="button" class="password-toggle" id="toggleConfirmPassword">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>

                <button class="login-btn reset-btn">Reset Password</button>

                <div class="back-to-login">
                    <a href="./login.php"><i class="fas fa-arrow-left"></i> Back to Login</a>
                </div>
            </form>
        <?php else: ?>
            <div class="back-to-login">
                <a href="./login.php"><i class="fas fa-arrow-left"></i> Back to Login</a>
            </div>
        <?php endif; ?>

        <div class="login-footer">
            <p>© <?php echo date('Y') ?> HamiSangai Admin Panel. All rights reserved.</p>
        </div>
    </div>

    <script>
        // Password toggle functionality
        document.querySelectorAll('.password-toggle').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.previousElementSibling;
                const icon = this.querySelector('i');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.className = 'fas fa-eye-slash';
                } else {
                    input.type = 'password';
                    icon.className = 'fas fa-eye';
                }
            });
        });

        // Enhanced Password Strength Indicator
        document.getElementById('new_password').addEventListener('input', function() {
            const password = this.value;
            const strengthBar = document.getElementById('passwordStrengthBar');
            const strengthText = document.getElementById('passwordStrengthText');
            const criteriaItems = {
                length: document.getElementById('lengthCriteria'),
                uppercase: document.getElementById('uppercaseCriteria'),
                number: document.getElementById('numberCriteria'),
                special: document.getElementById('specialCriteria')
            };

            // Reset criteria visuals
            Object.values(criteriaItems).forEach(item => {
                item.className = 'criteria-item criteria-not-met';
                item.querySelector('i').className = 'far fa-circle';
            });

            if (password.length === 0) {
                strengthBar.style.width = '0%';
                strengthBar.style.backgroundColor = '';
                strengthText.textContent = '';
                strengthText.style.color = '';
                return;
            }

            // Check password criteria
            const hasLength = password.length >= 8;
            const hasUppercase = /[A-Z]/.test(password);
            const hasNumber = /[0-9]/.test(password);
            const hasSpecial = /[^A-Za-z0-9]/.test(password);

            // Update criteria indicators
            if (hasLength) {
                criteriaItems.length.className = 'criteria-item criteria-met';
                criteriaItems.length.querySelector('i').className = 'fas fa-check-circle';
            }
            if (hasUppercase) {
                criteriaItems.uppercase.className = 'criteria-item criteria-met';
                criteriaItems.uppercase.querySelector('i').className = 'fas fa-check-circle';
            }
            if (hasNumber) {
                criteriaItems.number.className = 'criteria-item criteria-met';
                criteriaItems.number.querySelector('i').className = 'fas fa-check-circle';
            }
            if (hasSpecial) {
                criteriaItems.special.className = 'criteria-item criteria-met';
                criteriaItems.special.querySelector('i').className = 'fas fa-check-circle';
            }

            // Calculate strength score
            let strength = 0;
            if (hasLength) strength += 25;
            if (hasUppercase) strength += 25;
            if (hasNumber) strength += 25;
            if (hasSpecial) strength += 25;

            // Update strength bar and text
            strengthBar.style.width = `${strength}%`;
            if (strength < 50) {
                strengthBar.style.backgroundColor = '#dc3545';
                strengthText.textContent = 'Weak';
                strengthText.style.color = '#dc3545';
            } else if (strength < 75) {
                strengthBar.style.backgroundColor = '#fd7e14';
                strengthText.textContent = 'Moderate';
                strengthText.style.color = '#fd7e14';
            } else if (strength < 100) {
                strengthBar.style.backgroundColor = '#ffc107';
                strengthText.textContent = 'Strong';
                strengthText.style.color = '#ffc107';
            } else {
                strengthBar.style.backgroundColor = '#28a745';
                strengthText.textContent = 'Very Strong';
                strengthText.style.color = '#28a745';
            }
        });

        // AJAX form submission
        document.querySelector('.reset-btn').addEventListener('click', function(e) {
            e.preventDefault(); // Prevent default form submission

            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            const token = document.querySelector('input[name="token"]').value;
            const errorMessage = document.getElementById('errorMessage');
            const successMessage = document.getElementById('successMessage');
            const form = this;

            // Clear previous messages
            errorMessage.classList.add('hidden');
            errorMessage.innerHTML = '';
            successMessage.classList.add('hidden');
            successMessage.innerHTML = '';

            // Create FormData object
            const formData = new FormData();
            formData.append('new_password', newPassword);
            formData.append('confirm_password', confirmPassword);
            formData.append('token', token);

            // Create and configure XMLHttpRequest
            const xhr = new XMLHttpRequest();
            xhr.open('POST', "./withepc/php/process-reset-password.php");
            xhr.onload = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        try {
                            const response = xhr.response;
                            if (response == "success") {
                                window.location.href = "./withepc/login.php?success=Password has been reset successfully";
                            } else {
                                errorMessage.innerHTML = `<i class="fas fa-exclamation-circle"></i><span>${response}</span>`;
                                errorMessage.classList.remove('hidden');
                            }
                        } catch (e) {
                            errorMessage.innerHTML = `<i class="fas fa-exclamation-circle"></i><span>Invalid server response</span>`;
                            errorMessage.classList.remove('hidden');
                        }
                    } else {
                        errorMessage.innerHTML = `<i class="fas fa-exclamation-circle"></i><span>Server error. Please try again.</span>`;
                        errorMessage.classList.remove('hidden');
                    }
                }
            };

            // Send the request
            xhr.send(formData);
        });
    </script>
</body>

</html>