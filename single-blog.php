<?php
require_once('./includes/conn.php');
$slug = isset($_GET['slug']) ? $_GET['slug'] : null;
if (!$slug) {
    // Redirect to 404 if no slug is provided
    header('Location: ../404.php');
    exit;
}
$stmt = $conn->prepare("SELECT * FROM site_settings WHERE id = ?");
$stmt->execute(["1"]);
$setting = $stmt->fetch(PDO::FETCH_ASSOC);



$stmt = $conn->prepare("
    SELECT 
    posts.*,
    admins.name AS admin_name,
    admins.profile_image_url AS admin_pic,
    admins.bio AS admin_bio,
    categories.name AS category_name
FROM 
    posts
LEFT JOIN admins ON posts.added_by = admins.id
LEFT JOIN categories ON posts.category_id = categories.id WHERE posts.slug= ?
");

$stmt->execute([$slug]);
$blog = $stmt->fetch(PDO::FETCH_ASSOC);
$dateTime = (new DateTime($blog['created_at']))->format('M, d, Y');


$stmt = $conn->prepare("SELECT comments.name,comments.content AS comment_content, comments.created_at AS comment_date 
FROM comments 
INNER JOIN posts ON comments.post_id = posts.id 
WHERE comments.post_id = ? AND comments.status = ? ORDER BY comments.created_at DESC
");

$stmt->execute([$blog['id'], "APPROVED"]);
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT COUNT(*) AS commentcount 
FROM comments 
INNER JOIN posts ON comments.post_id = posts.id 
WHERE comments.post_id = ? AND comments.status = ?;
");

$stmt->execute([$blog['id'], "APPROVED"]);
$commentsCount = $stmt->fetch(PDO::FETCH_ASSOC);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="http://localhost/hamisangai/">
    <title><?php echo $blog['title'] ?> - HamiSangai</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

    <!-- Header Section -->
    <?php
    require_once('./includes/navbar.php');
    ?>


    <!-- Blog Post Hero -->
    <section class="single-post-hero" aria-labelledby="post-hero-heading">
        <div class="container">
            <div class="post-hero-content">
                <div class="post-meta">
                    <span class="post-category"><?php echo $blog['category_name'] ?></span>
                    <span class="post-date"><?php echo  $dateTime ?></span>
                    <span class="post-reading-time"><?php echo $blog['reading_time_minutes'] ?> min read</span>
                </div>
                <h1 id="post-hero-heading"><?php echo $blog['title'] ?></h1>
                <div class="post-author">
                    <img src="<?php echo $blog['admin_pic'] ?>" alt="Author avatar" class="author-avatar" loading="lazy">
                    <div class="author-info">
                        <span class="author-name"><?php echo $blog['admin_name'] ?></span>
                    </div>
                </div>
                <!-- Breadcrumb Navigation -->
            </div>
        </div>
        <nav class="breadcrumb container" aria-label="Breadcrumb">
            <ol>
                <li><a href="http://localhost/hamisangai/">Home</a></li>
                <li><a href="http://localhost/hamisangai/blog.php">Blog</a></li>
                <li aria-current="page"><?php echo htmlspecialchars($blog['title']); ?></li>
            </ol>
        </nav>
    </section>

    <!-- Main Content -->
    <main id="main-content" class="single-post-main">
        <div class="container">
            <article class="single-post-content">
                <div class="featured-image">
                    <img src="<?php echo $blog['featured_image_url'] ?>" alt="<?php echo $blog['title'] ?>" loading="lazy">
                    <p class="image-caption"><?php echo $blog['excert'] ?></p>
                </div>

                <div class="post-body">
                    <?php echo $blog['content'] ?>
                </div>
                <?php
                $tags = explode(',', $blog['meta_keywords']); // Split comma-separated string into an array                
                ?>
                <div class="post-tags">
                    <span>Tags:</span>
                    <?php foreach ($tags as $tag): ?>
                        <a href="#"><?= htmlspecialchars(trim($tag)) ?></a>
                    <?php endforeach; ?>
                </div>

                <!-- Share Buttons -->
                <div class="post-share">
                    <span>Share:</span>
                    <a id="facebookShare" target="_blank" rel="noopener" aria-label="Share on Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a id="twitterShare" target="_blank" rel="noopener" aria-label="Share on Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a id="linkedinShare" target="_blank" rel="noopener" aria-label="Share on LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a id="emailShare" target="_blank" rel="noopener" aria-label="Share via Email">
                        <i class="fas fa-envelope"></i>
                    </a>
                </div>

                <!-- JavaScript to Set URLs -->
                <script>
                    const currentURL = encodeURIComponent(window.location.href);
                    const pageTitle = encodeURIComponent(document.title);

                    document.getElementById("facebookShare").href =
                        `https://www.facebook.com/sharer/sharer.php?u=${currentURL}`;

                    document.getElementById("twitterShare").href =
                        `https://twitter.com/intent/tweet?url=${currentURL}&text=${pageTitle}`;

                    document.getElementById("linkedinShare").href =
                        `https://www.linkedin.com/shareArticle?mini=true&url=${currentURL}&title=${pageTitle}`;

                    document.getElementById("emailShare").href =
                        `mailto:?subject=${pageTitle}&body=Check this out: ${currentURL}`;
                </script>
            </article>

            <!-- Author Bio -->
            <div class="author-bio">
                <div class="author-avatar">
                    <img src="<?php echo $blog['admin_pic'] ?>" alt="<?php echo $blog['admin_name'] ?>" loading="lazy">
                </div>
                <div class="author-details">
                    <h3>About <?php echo $blog['admin_name'] ?></h3>
                    <p><?php echo $blog['admin_bio'] ?></p>

                </div>
            </div>

            <!-- Related Posts -->
            <div class="related-posts">


                <h2>Related Posts</h2>
                <div class="related-grid">
                    <?php
                    $stmt = $conn->prepare("SELECT posts.*, categories.name 
                        FROM posts 
                        INNER JOIN categories ON posts.category_id = categories.id 
                        WHERE categories.name = ? LIMIT 3");

                    $stmt->execute([$blog['category_name']]);
                    $related_posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if ($related_posts) {
                        foreach ($related_posts as $related_post) {
                    ?>
                            <article class="related-post">
                                <a href="single-blog/<?php echo $related_post['slug'] ?>">
                                    <img src="<?php echo $related_post['featured_image_url'] ?>" alt="<?php echo $related_post['title'] ?>" loading="lazy">
                                    <h3><?php echo $related_post['title'] ?></h3>
                                </a>
                            </article>
                    <?php
                        }
                    }
                    ?>

                </div>
            </div>

            <!-- Comments Section -->
            <div class="comments-section">
                <h2>Comments (<?php echo $commentsCount['commentcount'] ?>)</h2>
                <div class="comment-list">
                    <?php
                    if ($comments) {
                        foreach ($comments as $comment) {
                            $commentDate = (new DateTime($comment['comment_date']))->format('M, d, Y');
                    ?>
                            <div class="comment">
                                <div class="comment-author">
                                    <img src="#" alt="Comment author avatar" loading="lazy" style="visibility: hidden;">
                                    <div class="comment-author-info">
                                        <h4><?php echo $comment['name'] ?></h4>
                                        <span class="comment-date"><?php echo $commentDate ?></span>
                                    </div>
                                </div>
                                <div class="comment-content">
                                    <p><?php echo $comment['comment_content'] ?></p>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>

                </div>
                <form class="comment-form">
                    <h3>Leave a Comment</h3>
                    <div class="form-group">
                        <label for="comment-name">Name</label>
                        <input type="text" id="comment-name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="comment-email">Email</label>
                        <input type="email" id="comment-email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="comment-message">Comment</label>
                        <textarea id="comment-message" name="message" rows="5" required></textarea>
                    </div>
                    <input type="hidden" id="post-id" value="<?php echo $blog['id'] ?>">
                    <input type="text" id="website" style="display: none;">

                    <button type="submit" class="btn btn-primary post-comments">Post Comment</button>
                    <div class="error-message visually-hidden"></div>
                </form>
                <script>
                    document.querySelector('.post-comments').addEventListener("click", (e) => {
                        e.preventDefault();

                        const name = document.querySelector('#comment-name').value;
                        const email = document.querySelector('#comment-email').value;
                        const message = document.querySelector('#comment-message').value;
                        const postid = document.querySelector('#post-id').value;
                        const website = document.querySelector('#website').value;
                        const error = document.querySelector('.error-message');
                        let xhr = new XMLHttpRequest();
                        xhr.open("POST", "./php/post_comments.php");
                        xhr.onload = () => {
                            if (xhr.readyState == XMLHttpRequest.DONE) {
                                if (xhr.status == 200) {
                                    let data = xhr.response;
                                    console.log(data);

                                    if (data == "success") {
                                        document.location.reload();
                                    } else {
                                        error.innerHTML = data;
                                        error.classList.remove("visually-hidden");
                                    }
                                }
                            }
                        }
                        const formData = new FormData();
                        formData.append('name', name);
                        formData.append('email', email);
                        formData.append('message', message);
                        formData.append('post', postid);
                        formData.append('website', website);

                        xhr.send(formData);
                    });
                </script>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <script src="http://localhost/hamisangai/js/script.js"></script>
    <?php
    require_once('./includes/footer.php');
    ?>

</body>

</html>