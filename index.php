<?php
require_once('./includes/conn.php');
$stmt = $conn->prepare("SELECT * FROM site_settings WHERE id= ?");
$stmt->execute(["1"]);
$setting = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - <?php echo $setting['sitename']; ?></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                document.documentElement.classList.add('dark-mode');
            }
        })();
    </script>
</head>

<body>

    <!-- Header Section -->
    <?php
    require_once('./includes/navbar.php');
    ?>

    <!-- Hero Section -->
    <section class="hero">
        <!-- Background image -->
        <img src="https://picsum.photos/1600/900" alt="Hero background" class="hero-background">

        <!-- Content overlay -->
        <div class="hero-content">
            <h1><?php echo $setting['sitename']; ?></h1>
            <p class="hero-text">Download our app today and experience the best service on your mobile device.</p>

            <div class="app-badges">
                <a href="#" class="app-badge-link">
                    <img src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg"
                        alt="Download on the App Store"
                        class="app-badge">
                </a>
                <a href="#" class="app-badge-link">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/7/78/Google_Play_Store_badge_EN.svg"
                        alt="Get it on Google Play"
                        class="app-badge">
                </a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section about" aria-labelledby="about-heading">
        <div class="container">
            <h2 id="about-heading" class="section-title">About Us</h2>
            <div class="about-content">
                <div class="about-image">
                    <img src="<?php echo $setting['about_us_image']; ?>" alt="Our team working together" loading="lazy">
                </div>
                <div class="about-text">
                    <p>We are a team of passionate writers and content creators dedicated to bringing you high-quality articles on a variety of topics. Our mission is to educate, inspire, and entertain our readers.</p>
                    <p>Founded in 2020, we've grown from a small blog to a platform with thousands of monthly readers. Our content covers technology, lifestyle, business, and more.</p>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolorum repellendus excepturi aspernatur temporibus est accusamus dolore numquam neque sit? Eos?</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="section services" aria-labelledby="services-heading">
        <div class="container">
            <h2 id="services-heading" class="section-title">Our Services</h2>
            <div class="services-grid">
                <?php
                $stmt = $conn->prepare("SELECT * FROM services");
                $stmt->execute();
                $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($services) {
                    foreach ($services as $service) {
                ?>
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="<?php echo $service['featured_image_url']; ?>"></i>
                            </div>
                            <h3 class="service-title"><?php echo $service['title']; ?></h3>
                            <p class="service-description"><?php echo $service['description']; ?></p>
                        </div>
                <?php
                    }
                }
                ?>

            </div>
        </div>
    </section>

    <!-- Featured Blogs Section -->
    <section class="section featured-blogs" aria-labelledby="featured-blogs-heading">
        <div class="container">
            <h2 id="featured-blogs-heading" class="section-title">Featured Blogs</h2>
            <div class="blogs-grid">
                <?php
                $stmt = $conn->prepare("SELECT * FROM posts WHERE status = ? ORDER BY RAND() LIMIT 3");
                $stmt->execute(["PUBLISHED"]);
                $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($blogs) {
                    foreach ($blogs as $blog) {
                        $dateonly = (new DateTime($blog['created_at']))->format('M, d, Y');
                    
                ?>

                        <article class="blog-card">
                            <div class="blog-image">
                                <img src="<?php echo $blog['featured_image_url'] ?>" alt="Blog post thumbnail" loading="lazy">
                            </div>
                            <div class="blog-content">
                                <h3 class="blog-title"><a href="single-blog.php"><?php echo $blog['title'] ?></a></h3>
                                <p class="blog-excerpt"><?php echo $blog['excert'] ?></p>
                                <div class="blog-meta">
                                    <span class="blog-date"><?php echo $dateonly ?></span>
                                    <a href="single-blog.php" class="read-more">Read More</a>
                                </div>
                            </div>
                        </article>
                <?php
                    }
                }
                ?>
             
            </div>
            <div class="section-footer">
                <a href="blog.php" class="btn btn-primary">View All Blogs</a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section contact" aria-labelledby="contact-heading">
        <div class="container">
            <h2 id="contact-heading" class="section-title">Contact Us</h2>
            <div class="contact-content">
                <div class="contact-info">
                    <h3>Get in Touch</h3>
                    <p>Have questions or want to discuss a project? Reach out to us!</p>
                    <ul class="contact-list">
                        <li><i class="fas fa-envelope"></i><?php echo $setting['contact_email']; ?></li>
                        <li><i class="fas fa-phone"></i> +977 <?php echo $setting['contact']; ?></li>
                        <li><i class="fas fa-map-marker-alt"></i><?php echo $setting['address']; ?></li>
                    </ul>
                </div>
                <form class="contact-form">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php
    require_once('./includes/footer.php');
    ?>


    <script src="js/script.js"></script>
</body>

</html>