<?php
require_once('./includes/conn.php');
$stmt = $conn->prepare("SELECT * FROM site_settings WHERE id = ?");
$stmt->execute(["1"]);
$setting = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found | 404</title>
    <base href="http://localhost/hamisangai/">

    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .rotating-line {
            transform-origin: 256px 256px;
            animation: rotate360 8s linear infinite;
        }


        @keyframes rotate360 {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>

</head>

<body>
    <?php
    require_once('./includes/navbar.php');
    ?>
    <main class="not-found">
        <div class="not-found-content">
            <!-- SVG illustration of a broken link or lost page -->
            <div class="not-found-illustration">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="256" cy="256" r="200" fill="none" stroke="#e74c3c" stroke-width="20" opacity="0.2" />
                    <line class="rotating-line" x1="150" y1="150" x2="362" y2="362" stroke="#e74c3c" stroke-width="30" />
                    <path class="rotating-line" d="M256,100c-30,0-58,7-84,20" fill="none" stroke="#3498db" stroke-width="12" />
                    <path class="rotating-line" d="M256,412c30,0,58-7,84-20" fill="none" stroke="#3498db" stroke-width="12" />
                    <path class="rotating-line" d="M100,256c0-30,7-58,20-84" fill="none" stroke="#3498db" stroke-width="12" />
                    <path class="rotating-line" d="M412,256c0,30-7,58-20,84" fill="none" stroke="#3498db" stroke-width="12" />

                    <circle cx="256" cy="256" r="80" fill="none" stroke="#3498db" stroke-width="12" />


                </svg>
            </div>

            <h1 class="not-found-title">404</h1>
            <h2 class="not-found-subtitle">Page Not Found</h2>
            <p class="not-found-text">
                Oops! The page you're looking for doesn't exist or has been moved.
                Please check the URL or navigate back to our homepage.
            </p>

            <div class="not-found-actions">
                <a href="./index.php" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="margin-right: 8px;">
                        <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z" />
                    </svg>
                    Return Home
                </a>
            </div>
        </div>
    </main>
    <?php
    require_once('./includes/footer.php');
    ?>
</body>
<script src="./js/script.js"></script>

</html>