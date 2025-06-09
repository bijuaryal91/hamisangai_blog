<?php
require_once('./includes/conn.php');
$stmt = $conn->prepare("SELECT * FROM site_settings WHERE id = ?");
$stmt->execute(["1"]);
$setting = $stmt->fetch(PDO::FETCH_ASSOC);

// Pagination variables
$perPage = 6; // Number of items per page
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $perPage;

// Get total number of posts
$totalQuery = "SELECT COUNT(*) as total FROM posts 
               INNER JOIN categories ON posts.category_id = categories.id 
               WHERE posts.status = 'PUBLISHED'";
$stmt = $conn->prepare($totalQuery);
$stmt->execute();
$totalPosts = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
$totalPages = ceil($totalPosts / $perPage);

// Get posts with pagination only
$query = "
    SELECT posts.*, categories.name 
    FROM posts 
    INNER JOIN categories ON posts.category_id = categories.id 
    WHERE posts.status = 'PUBLISHED'
    LIMIT :offset, :perPage";
$stmt = $conn->prepare($query);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->bindParam(':perPage', $perPage, PDO::PARAM_INT);
$stmt->execute();
$blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if it's an AJAX request
$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
    strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

if ($isAjax) {
    header('Content-Type: application/json');
    echo json_encode([
        'blogs' => $blogs,
        'pagination' => [
            'page' => $page,
            'totalPages' => $totalPages,
            'totalPosts' => $totalPosts
        ]
    ]);
    exit;
}
?>
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
    <?php require_once('./includes/navbar.php'); ?>

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
                    <form class="search-form" id="blog-search" action="blog.php" method="get">
                        <input type="search" name="search" placeholder="Search articles..." class="search-input" id="search-input" value="">
                        <input type="hidden" name="page" value="1">
                        <button type="submit" class="search-button">
                            <i class="fas fa-search"></i>
                            <span class="visually-hidden">Search</span>
                        </button>
                    </form>
                </div>

                <div class="filter-container">
                    <div class="filter-group">
                        <label for="category-filter" class="filter-label">Category:</label>
                        <select id="category-filter" class="filter-select" name="category">
                            <option value="all">All Categories</option>
                            <?php
                            $stmt = $conn->prepare("SELECT * FROM categories");
                            $stmt->execute();
                            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($categories as $category) {
                                echo '<option value="' . $category['id'] . '">' . htmlspecialchars($category['name']) . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="sort-by" class="filter-label">Sort by:</label>
                        <select id="sort-by" class="filter-select" name="sort">
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
                <?php
                if ($blogs) {
                    foreach ($blogs as $blog) {
                        $dateonly = (new DateTime($blog['created_at']))->format('M, d, Y');
                ?>
                        <article class="blog-post-card" data-category="<?php echo $blog['category_id'] ?>" data-date="<?php echo $dateonly ?>">
                            <div class="post-image">
                                <img src="<?php echo $blog['featured_image_url'] ?>" alt="Blog post thumbnail" loading="lazy">
                            </div>
                            <div class="post-content">
                                <div class="post-meta">
                                    <span class="post-category"><?php echo $blog['name'] ?></span>
                                    <span class="post-date"><?php echo $dateonly; ?></span>
                                </div>
                                <h2 class="post-title"><a href="single-blog.php?id=<?php echo $blog['id'] ?>"><?php echo $blog['title'] ?></a></h2>
                                <p class="post-excerpt"><?php echo $blog['excert'] ?></p>
                                <a href="single-blog.php?id=<?php echo $blog['id'] ?>" class="read-more">Read More <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </article>
                <?php
                    }
                } else {
                    echo '<p class="no-results">No blog posts found.</p>';
                }
                ?>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=<?php echo $page - 1 ?>" class="page-link prev" aria-label="Previous page">
                        <i class="fas fa-chevron-left"></i> Previous
                    </a>
                <?php else: ?>
                    <span class="page-link prev disabled" aria-label="Previous page">
                        <i class="fas fa-chevron-left"></i> Previous
                    </span>
                <?php endif; ?>

                <div class="page-numbers">
                    <?php
                    if ($page > 3) {
                        echo '<a href="?page=1" class="page-link" aria-label="Page 1">1</a>';
                        if ($page > 4) {
                            echo '<span class="page-dots">...</span>';
                        }
                    }
                    for ($i = max(1, $page - 2); $i <= min($totalPages, $page + 2); $i++) {
                        if ($i == $page) {
                            echo '<span class="page-link active" aria-label="Page ' . $i . '">' . $i . '</span>';
                        } else {
                            echo '<a href="?page=' . $i . '" class="page-link" aria-label="Page ' . $i . '">' . $i . '</a>';
                        }
                    }
                    if ($page < $totalPages - 2) {
                        if ($page < $totalPages - 3) {
                            echo '<span class="page-dots">...</span>';
                        }
                        echo '<a href="?page=' . $totalPages . '" class="page-link" aria-label="Page ' . $totalPages . '">' . $totalPages . '</a>';
                    }
                    ?>
                </div>

                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?php echo $page + 1 ?>" class="page-link next" aria-label="Next page">
                        Next <i class="fas fa-chevron-right"></i>
                    </a>
                <?php else: ?>
                    <span class="page-link next disabled" aria-label="Next page">
                        Next <i class="fas fa-chevron-right"></i>
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php require_once('./includes/footer.php'); ?>

    <script src="js/script.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Cache DOM elements
            const paginationEl = document.querySelector('.pagination');
            const blogGrid = document.querySelector('.blog-posts-grid');
            const searchForm = document.getElementById('blog-search');
            const searchInput = document.getElementById('search-input');
            const categoryFilter = document.getElementById('category-filter');
            const sortBy = document.getElementById('sort-by');
            let allBlogs = []; // Store all fetched blogs for client-side filtering/sorting
            let totalPages = <?php echo $totalPages; ?>; // Initial total pages from PHP
            let currentPage = <?php echo $page; ?>; // Track current page

            // Event delegation for pagination
            document.body.addEventListener('click', function(e) {
                if (e.target.closest('.page-link:not(.disabled)')) {
                    e.preventDefault();
                    const link = e.target.closest('.page-link');
                    const params = new URLSearchParams(new URL(link.href).search);
                    const nextPage = parseInt(params.get('page'), 10); // Ensure page is an integer
                    if (!isNaN(nextPage)) {
                        loadContent(nextPage);
                    }
                }
            });

            // Handle filter and sort changes
            [categoryFilter, sortBy, searchForm].forEach(element => {
                element.addEventListener('change', applyFiltersAndSort);
                if (element === searchForm) {
                    element.addEventListener('submit', function(e) {
                        e.preventDefault();
                        applyFiltersAndSort();
                    });
                }
            });

            // AJAX function to load content from server (pagination only)
            function loadContent(page) {
                blogGrid.innerHTML = '<div class="loading-spinner">Loading...</div>';
                console.log('Loading page:', page); // Debug: Check page value

                fetch(`blog.php?page=${page}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.json();
                    })
                    .then(data => {
                        console.log('Fetched blogs:', data.blogs); // Debug: Check fetched data
                        allBlogs = data.blogs || []; // Ensure allBlogs is an array
                        totalPages = data.pagination.totalPages; // Update total pages
                        currentPage = parseInt(data.pagination.page, 10); // Update current page
                        applyFiltersAndSort(); // Apply client-side filtering and sorting
                        updatePagination(currentPage, totalPages);
                        updateURL(currentPage);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        blogGrid.innerHTML = '<p class="error-message">Failed to load content. Please try again.</p>';
                    });
            }

            // Client-side filtering and sorting
            function applyFiltersAndSort() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                const category = categoryFilter.value; // String from dropdown
                const sort = sortBy.value;

                console.log('Category filter:', category); // Debug: Check category value
                console.log('All blogs before filter:', allBlogs); // Debug: Check blogs

                // Filter by search term
                let filteredBlogs = allBlogs.filter(blog => {
                    if (searchTerm) {
                        return blog.title.toLowerCase().includes(searchTerm) ||
                            blog.content.toLowerCase().includes(searchTerm) ||
                            blog.excert.toLowerCase().includes(searchTerm);
                    }
                    return true;
                });

                // Filter by category
                if (category !== 'all') {
                    filteredBlogs = filteredBlogs.filter(blog => {
                        // Convert both to strings for comparison
                        const blogCategory = String(blog.category_id);
                        const selectedCategory = String(category);
                        const match = blogCategory === selectedCategory;
                        console.log(`Blog ID: ${blog.id}, Blog Category: ${blogCategory}, Selected: ${selectedCategory}, Match: ${match}`); // Debug
                        return match;
                    });
                }

                // Sort blogs
                filteredBlogs.sort((a, b) => {
                    if (sort === 'newest') {
                        return new Date(b.created_at) - new Date(a.created_at);
                    } else if (sort === 'oldest') {
                        return new Date(a.created_at) - new Date(b.created_at);
                    } else if (sort === 'title-asc') {
                        return a.title.localeCompare(b.title);
                    } else if (sort === 'title-desc') {
                        return b.title.localeCompare(a.title);
                    }
                    return 0;
                });

                console.log('Filtered and sorted blogs:', filteredBlogs); // Debug: Check result
                updateBlogGrid(filteredBlogs);
            }

            function updateURL(page) {
                history.pushState({}, '', `blog.php?page=${page}`);
            }

            function updateBlogGrid(blogs) {
                if (!blogs || blogs.length === 0) {
                    blogGrid.innerHTML = '<p class="no-results">No blog posts found on this page.</p>';
                    return;
                }

                blogGrid.innerHTML = blogs.map(blog => {
                    const dateonly = blog.created_at.split(' ')[0];
                    return `
                        <article class="blog-post-card" data-category="${blog.category_id}" data-date="${dateonly}">
                            <div class="post-image">
                                <img src="${blog.featured_image_url}" alt="${blog.title}" loading="lazy">
                            </div>
                            <div class="post-content">
                                <div class="post-meta">
                                    <span class="post-category">${blog.name}</span>
                                    <span class="post-date">${dateonly}</span>
                                </div>
                               <h2 class="post-title"><a href="single-blog/${blog.slug}">${blog.title}</a></h2>
                                <p class="post-excerpt">${blog.excert}</p>
                                <a href="single-blog/${blog.slug}" class="read-more">Read More <i class="fas fa-arrow-right"></i></a></div>
                        </article>
                    `;
                }).join('');
            }

            function updatePagination(currentPage, totalPages) {
                let paginationHtml = '';

                paginationHtml += currentPage > 1 ?
                    `<a href="?page=${currentPage - 1}" class="page-link prev" aria-label="Previous page">
                        <i class="fas fa-chevron-left"></i> Previous
                    </a>` :
                    `<span class="page-link prev disabled" aria-label="Previous page">
                        <i class="fas fa-chevron-left"></i> Previous
                    </span>`;

                paginationHtml += '<div class="page-numbers">';
                if (currentPage > 3) {
                    paginationHtml += `<a href="?page=1" class="page-link" aria-label="Page 1">1</a>`;
                    if (currentPage > 4) paginationHtml += '<span class="page-dots">...</span>';
                }
                const startPage = Math.max(1, currentPage - 2);
                const endPage = Math.min(totalPages, currentPage + 2);
                for (let i = startPage; i <= endPage; i++) {
                    paginationHtml += i === currentPage ?
                        `<span class="page-link active" aria-label="Page ${i}">${i}</span>` :
                        `<a href="?page=${i}" class="page-link" aria-label="Page ${i}">${i}</a>`;
                }
                if (currentPage < totalPages - 2) {
                    if (currentPage < totalPages - 3) paginationHtml += '<span class="page-dots">...</span>';
                    paginationHtml += `<a href="?page=${totalPages}" class="page-link" aria-label="Page ${totalPages}">${totalPages}</a>`;
                }
                paginationHtml += '</div>';

                paginationHtml += currentPage < totalPages ?
                    `<a href="?page=${currentPage + 1}" class="page-link next" aria-label="Next page">
                        Next <i class="fas fa-chevron-right"></i>
                    </a>` :
                    `<span class="page-link next disabled" aria-label="Next page">
                        Next <i class="fas fa-chevron-right"></i>
                    </span>`;

                if (paginationEl) {
                    paginationEl.innerHTML = paginationHtml;
                }
            }

            // Handle back/forward navigation
            window.addEventListener('popstate', function() {
                const params = new URLSearchParams(window.location.search);
                const page = parseInt(params.get('page'), 10) || 1;
                loadContent(page);
            });

            // Initialize with current URL
            const params = new URLSearchParams(window.location.search);
            const page = parseInt(params.get('page'), 10) || 1;
            loadContent(page);
        });
    </script>
</body>

</html>