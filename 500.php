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
    <title>Internal Server Error | 500</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.0.2/TweenMax.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        #server {
            width: 200px;
            display: block;
            overflow: visible;
            position: relative;
        }

        .not-found-content {
            padding-top: 50px;
        }

        @media only screen and (max-width : 720px) {
            #server {
                max-height: 50%;
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
            <!-- SVG illustration of a server with error -->
            <div class="not-found-illustration">
                <svg id="server" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="#d1d1d1" d="M480 160H32c-17.7 0-32-14.3-32-32V64c0-17.7 14.3-32 32-32h448c17.7 0 32 14.3 32 32v64c0 17.7-14.3 32-32 32zM32 160h448v256H32V160z" />
                    <path fill="#b1b1b1" d="M480 32H32C14.3 32 0 46.3 0 64v64c0 17.7 14.3 32 32 32h448c17.7 0 32-14.3 32-32V64c0-17.7-14.3-32-32-32zm0 128H32v256h448V160z" />
                    <circle cx="80" cy="96" r="16" fill="#ff5555" />
                    <circle cx="128" cy="96" r="16" fill="#ffff00" />
                    <circle cx="176" cy="96" r="16" fill="#55ff55" />

                    <rect x="64" y="192" width="384" height="32" rx="4" ry="4" fill="#e0e0e0" />
                    <rect x="64" y="256" width="384" height="32" rx="4" ry="4" fill="#e0e0e0" />
                    <rect x="64" y="320" width="384" height="32" rx="4" ry="4" fill="#e0e0e0" />

                    <circle cx="80" cy="208" r="8" fill="#ff5555" class="error-light" />
                    <circle cx="80" cy="272" r="8" fill="#ff5555" class="error-light" />
                    <circle cx="80" cy="336" r="8" fill="#ff5555" class="error-light" />

                    <path fill="#3498db" d="M400 384H112c-8.8 0-16 7.2-16 16v16c0 8.8 7.2 16 16 16h288c8.8 0 16-7.2 16-16v-16c0-8.8-7.2-16-16-16z" />
                </svg>
                <div id="error-bubbles"></div>
            </div>

            <h1 class="not-found-title">500</h1>
            <h2 class="not-found-subtitle">Internal Server Error</h2>
            <p class="not-found-text">
                Something went wrong on our servers while processing your request.
                Our team has been notified and we're working to fix it.
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
<script>
    // Position the server graphic
    TweenMax.set('#server', {
        xPercent: -50,
        yPercent: 0,
        left: "50%",
        bottom: "0%"
    });

    // Blinking error lights animation
    TweenMax.to('.error-light', 0.5, {
        opacity: 0,
        repeat: -1,
        yoyo: true,
        ease: Power1.easeInOut
    });
</script>
<script src="./js/script.js"></script>

</html>