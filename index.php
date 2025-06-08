<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - HamiSangai</title>
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
            <h1>Hami Sangai</h1>
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
                    <img src="https://picsum.photos/600/400" alt="Our team working together" loading="lazy">
                </div>
                <div class="about-text">
                    <p>We are a team of passionate writers and content creators dedicated to bringing you high-quality articles on a variety of topics. Our mission is to educate, inspire, and entertain our readers.</p>
                    <p>Founded in 2020, we've grown from a small blog to a platform with thousands of monthly readers. Our content covers technology, lifestyle, business, and more.</p>
                    <a href="#" class="btn btn-outline">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="section services" aria-labelledby="services-heading">
        <div class="container">
            <h2 id="services-heading" class="section-title">Our Services</h2>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-pen-fancy"></i>
                    </div>
                    <h3 class="service-title">Content Writing</h3>
                    <p class="service-description">High-quality, SEO-optimized content for your website or blog.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="service-title">SEO Optimization</h3>
                    <p class="service-description">Improve your search rankings with our expert SEO services.</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <h3 class="service-title">Social Media</h3>
                    <p class="service-description">Engage your audience with our social media management.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Blogs Section -->
    <section class="section featured-blogs" aria-labelledby="featured-blogs-heading">
        <div class="container">
            <h2 id="featured-blogs-heading" class="section-title">Featured Blogs</h2>
            <div class="blogs-grid">
                <article class="blog-card">
                    <div class="blog-image">
                        <img src="https://picsum.photos/400/300?random=1" alt="Blog post thumbnail" loading="lazy">
                    </div>
                    <div class="blog-content">
                        <h3 class="blog-title"><a href="single-blog.php">10 Tips for Better Content Writing</a></h3>
                        <p class="blog-excerpt">Learn how to improve your writing skills and create engaging content that resonates with your audience.</p>
                        <div class="blog-meta">
                            <span class="blog-date">June 15, 2023</span>
                            <a href="single-blog.php" class="read-more">Read More</a>
                        </div>
                    </div>
                </article>
                <article class="blog-card">
                    <div class="blog-image">
                        <img src="https://picsum.photos/400/300?random=2" alt="Blog post thumbnail" loading="lazy">
                    </div>
                    <div class="blog-content">
                        <h3 class="blog-title"><a href="single-blog.php">The Future of SEO in 2023</a></h3>
                        <p class="blog-excerpt">Discover the latest SEO trends and how to adapt your strategy for better search rankings.</p>
                        <div class="blog-meta">
                            <span class="blog-date">June 10, 2023</span>
                            <a href="single-blog.php" class="read-more">Read More</a>
                        </div>
                    </div>
                </article>
                <article class="blog-card">
                    <div class="blog-image">
                        <img src="https://picsum.photos/400/300?random=3" alt="Blog post thumbnail" loading="lazy">
                    </div>
                    <div class="blog-content">
                        <h3 class="blog-title"><a href="single-blog.php">Social Media Strategies That Work</a></h3>
                        <p class="blog-excerpt">Effective techniques to grow your audience and engagement on social media platforms.</p>
                        <div class="blog-meta">
                            <span class="blog-date">June 5, 2023</span>
                            <a href="single-blog.php" class="read-more">Read More</a>
                        </div>
                    </div>
                </article>
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
                        <li><i class="fas fa-envelope"></i> info@withepc.com</li>
                        <li><i class="fas fa-phone"></i> +1 (555) 123-4567</li>
                        <li><i class="fas fa-map-marker-alt"></i> 123 Blog Street, Content City</li>
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