<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - HamiSangai</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
   
    <!-- Header Section -->
    <?php
        require_once('./includes/navbar.php');
    ?>

    <!-- Blog Hero Section -->
    <section class="blog-hero" aria-labelledby="blog-hero-heading">
        <div class="container">
            <h1 id="blog-hero-heading">Our Blog</h1>
            <p class="blog-hero-text">Discover the latest articles and insights from our team.</p>
        </div>
    </section>

    <!-- Main Content -->
    <main id="main-content" class="main-content">
        <div class="container">
            <!-- Breadcrumb Navigation -->
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <ol>
                    <li><a href="index.php">Home</a></li>
                    <li aria-current="page">Blog</li>
                </ol>
            </nav>

            <!-- Search and Filter Section -->
            <div class="blog-controls">
                <div class="search-container">
                    <form class="search-form" id="blog-search">
                        <input type="search" placeholder="Search articles..." class="search-input" id="search-input">
                        <button type="submit" class="search-button">
                            <i class="fas fa-search"></i>
                            <span class="visually-hidden">Search</span>
                        </button>
                    </form>
                </div>
                
                <div class="filter-container">
                    <div class="filter-group">
                        <label for="category-filter" class="filter-label">Category:</label>
                        <select id="category-filter" class="filter-select">
                            <option value="all">All Categories</option>
                            <option value="technology">Technology</option>
                            <option value="business">Business</option>
                            <option value="lifestyle">Lifestyle</option>
                            <option value="marketing">Marketing</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="sort-by" class="filter-label">Sort by:</label>
                        <select id="sort-by" class="filter-select">
                            <option value="newest">Newest First</option>
                            <option value="oldest">Oldest First</option>
                            <option value="title-asc">Title (A-Z)</option>
                            <option value="title-desc">Title (Z-A)</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Blog Posts Grid -->
            <div class="blog-posts-grid">
                <article class="blog-post-card" data-category="technology" data-date="2023-06-20">
                    <div class="post-image">
                        <img src="https://picsum.photos/600/400?random=4" alt="Blog post thumbnail" loading="lazy">
                    </div>
                    <div class="post-content">
                        <div class="post-meta">
                            <span class="post-category">Technology</span>
                            <span class="post-date">June 20, 2023</span>
                        </div>
                        <h2 class="post-title"><a href="single-blog.php">The Rise of AI in Content Creation</a></h2>
                        <p class="post-excerpt">How artificial intelligence is transforming the way we create and consume content online.</p>
                        <a href="single-blog.php" class="read-more">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </article>

                <article class="blog-post-card" data-category="marketing" data-date="2023-06-18">
                    <div class="post-image">
                        <img src="https://picsum.photos/600/400?random=5" alt="Blog post thumbnail" loading="lazy">
                    </div>
                    <div class="post-content">
                        <div class="post-meta">
                            <span class="post-category">Marketing</span>
                            <span class="post-date">June 18, 2023</span>
                        </div>
                        <h2 class="post-title"><a href="single-blog.php">Email Marketing Strategies That Convert</a></h2>
                        <p class="post-excerpt">Proven techniques to improve your email open rates and conversions in 2023.</p>
                        <a href="single-blog.php" class="read-more">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </article>

                <article class="blog-post-card" data-category="business" data-date="2023-06-15">
                    <div class="post-image">
                        <img src="https://picsum.photos/600/400?random=6" alt="Blog post thumbnail" loading="lazy">
                    </div>
                    <div class="post-content">
                        <div class="post-meta">
                            <span class="post-category">Business</span>
                            <span class="post-date">June 15, 2023</span>
                        </div>
                        <h2 class="post-title"><a href="single-blog.php">Remote Work: Productivity Tips</a></h2>
                        <p class="post-excerpt">How to maintain productivity and work-life balance when working from home.</p>
                        <a href="single-blog.php" class="read-more">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </article>

                <article class="blog-post-card" data-category="lifestyle" data-date="2023-06-12">
                    <div class="post-image">
                        <img src="https://picsum.photos/600/400?random=7" alt="Blog post thumbnail" loading="lazy">
                    </div>
                    <div class="post-content">
                        <div class="post-meta">
                            <span class="post-category">Lifestyle</span>
                            <span class="post-date">June 12, 2023</span>
                        </div>
                        <h2 class="post-title"><a href="single-blog.php">Minimalism: Living With Less</a></h2>
                        <p class="post-excerpt">The benefits of adopting a minimalist lifestyle in our consumer-driven world.</p>
                        <a href="single-blog.php" class="read-more">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </article>

                <article class="blog-post-card" data-category="technology" data-date="2023-06-10">
                    <div class="post-image">
                        <img src="https://picsum.photos/600/400?random=8" alt="Blog post thumbnail" loading="lazy">
                    </div>
                    <div class="post-content">
                        <div class="post-meta">
                            <span class="post-category">Technology</span>
                            <span class="post-date">June 10, 2023</span>
                        </div>
                        <h2 class="post-title"><a href="single-blog.php">The Future of Web Development</a></h2>
                        <p class="post-excerpt">Emerging trends and technologies that will shape web development in the coming years.</p>
                        <a href="single-blog.php" class="read-more">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </article>

                <article class="blog-post-card" data-category="marketing" data-date="2023-06-08">
                    <div class="post-image">
                        <img src="https://picsum.photos/600/400?random=9" alt="Blog post thumbnail" loading="lazy">
                    </div>
                    <div class="post-content">
                        <div class="post-meta">
                            <span class="post-category">Marketing</span>
                            <span class="post-date">June 8, 2023</span>
                        </div>
                        <h2 class="post-title"><a href="single-blog.php">Building a Personal Brand Online</a></h2>
                        <p class="post-excerpt">Step-by-step guide to establishing and growing your personal brand on digital platforms.</p>
                        <a href="single-blog.php" class="read-more">Read More <i class="fas fa-arrow-right"></i></a>
                    </div>
                </article>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <a href="#" class="page-link prev disabled" aria-label="Previous page">
                    <i class="fas fa-chevron-left"></i> Previous
                </a>
                <div class="page-numbers">
                    <a href="#" class="page-link active" aria-label="Page 1">1</a>
                    <a href="#" class="page-link" aria-label="Page 2">2</a>
                    <a href="#" class="page-link" aria-label="Page 3">3</a>
                    <span class="page-dots">...</span>
                    <a href="#" class="page-link" aria-label="Page 8">8</a>
                </div>
                <a href="#" class="page-link next" aria-label="Next page">
                    Next <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>
    </main>

    <!-- Footer -->
   <?php
    require_once('./includes/footer.php');
   ?>

    <script src="js/script.js"></script>
</body>
</html>