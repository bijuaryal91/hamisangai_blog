<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Admin - Settings</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="dashboard-container">
            <aside class="sidebar">
            <div class="sidebar-header">
                <h1><i class="fas fa-blog"></i> Blog Admin</h1>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li>
                        <a href="index.php">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="posts.php">
                            <i class="fas fa-newspaper"></i>
                            <span>Posts</span>
                        </a>
                    </li>
                    <li>
                        <a href="comments.php">
                            <i class="fas fa-comments"></i>
                            <span>Comments</span>
                            <span class="badge">3</span>
                        </a>
                    </li>
                    <li>
                        <a href="users.php">
                            <i class="fas fa-users"></i>
                            <span>Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="categories.php">
                            <i class="fas fa-tags"></i>
                            <span>Categories</span>
                        </a>
                    </li>
                    <li>
                        <a href="media.php">
                            <i class="fas fa-images"></i>
                            <span>Media</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="settings.php">
                            <i class="fas fa-cog"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="sidebar-footer">
                <button id="toggle-theme">
                    <i class="fas fa-moon"></i>
                    <span>Dark Mode</span>
                </button>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
          <header class="header">
                <div class="header-left">
                    <button id="sidebar-toggle" class="menu-toggle">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h2>Dashboard</h2>
                </div>
                <div class="header-right">
                    <div class="notifications">
                        <button class="notification-btn">
                            <i class="fas fa-bell"></i>
                            <span class="badge">5</span>
                        </button>
                        <div class="notification-dropdown">
                            <div class="notification-header">
                                <h4>Notifications</h4>
                                <span class="badge">5 New</span>
                            </div>
                            <div class="notification-list">
                                <a href="#" class="notification-item">
                                    <div class="notification-icon">
                                        <i class="fas fa-comment"></i>
                                    </div>
                                    <div class="notification-content">
                                        <p>New comment on "Getting Started with React"</p>
                                        <small>2 minutes ago</small>
                                    </div>
                                </a>
                                <a href="#" class="notification-item">
                                    <div class="notification-icon">
                                        <i class="fas fa-user-plus"></i>
                                    </div>
                                    <div class="notification-content">
                                        <p>New user registered</p>
                                        <small>10 minutes ago</small>
                                    </div>
                                </a>
                            </div>
                            <div class="notification-footer">
                                <a href="#">View All</a>
                            </div>
                        </div>
                    </div>
                    <div class="profile">
                        <button class="profile-btn">
                            <img src="https://picsum.photos/40" alt="Profile">
                            <span>Admin</span>
                            <i class="fas fa-chevron-down"></i>
                        </button>
                        <div class="profile-dropdown">
                            <a href="#"><i class="fas fa-user"></i> Profile</a>
                            <a href="#"><i class="fas fa-cog"></i> Settings</a>
                            <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Settings Content -->
            <div class="content">
                <div class="page-header">
                    <h2>Settings</h2>
                </div>

                <div class="settings-tabs">
                    <div class="tabs-header">
                        <button class="tab-btn active" data-tab="general">General</button>
                        <button class="tab-btn" data-tab="writing">Writing</button>
                        <button class="tab-btn" data-tab="reading">Reading</button>
                        <button class="tab-btn" data-tab="discussion">Discussion</button>
                        <button class="tab-btn" data-tab="media">Media</button>
                    </div>

                    <div class="tabs-content">
                        <div class="tab-pane active" id="general">
                            <form>
                                <div class="form-group">
                                    <label>Site Title</label>
                                    <input type="text" value="My Awesome Blog">
                                </div>
                                <div class="form-group">
                                    <label>Tagline</label>
                                    <input type="text" value="Just another WordPress site">
                                </div>
                                <div class="form-group">
                                    <label>Site Icon</label>
                                    <div class="image-upload">
                                        <img src="https://picsum.photos/100" alt="Site Icon">
                                        <button class="btn"><i class="fas fa-upload"></i> Upload Image</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Timezone</label>
                                    <select>
                                        <option>UTC</option>
                                        <option selected>UTC+1</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>

                        <div class="tab-pane" id="writing">
                            <form>
                                <div class="form-group">
                                    <label>Default Post Category</label>
                                    <select>
                                        <option>Uncategorized</option>
                                        <option selected>Technology</option>
                                        <option>Business</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Default Post Format</label>
                                    <select>
                                        <option selected>Standard</option>
                                        <option>Aside</option>
                                        <option>Gallery</option>
                                    </select>
                                </div>
                                <div class="form-group checkbox">
                                    <input type="checkbox" id="convert-emoticons" checked>
                                    <label for="convert-emoticons">Convert emoticons like :-) and :-P to graphics</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>

                        <div class="tab-pane" id="reading">
                            <form>
                                <div class="form-group">
                                    <label>Your homepage displays</label>
                                    <div class="radio-group">
                                        <label>
                                            <input type="radio" name="homepage-display" checked>
                                            <span>Your latest posts</span>
                                        </label>
                                        <label>
                                            <input type="radio" name="homepage-display">
                                            <span>A static page</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Blog pages show at most</label>
                                    <input type="number" value="10">
                                    <span>posts</span>
                                </div>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>

                        <div class="tab-pane" id="discussion">
                            <form>
                                <div class="form-group checkbox">
                                    <input type="checkbox" id="allow-comments" checked>
                                    <label for="allow-comments">Allow people to submit comments on new posts</label>
                                </div>
                                <div class="form-group checkbox">
                                    <input type="checkbox" id="comment-approval">
                                    <label for="comment-approval">Comment must be manually approved</label>
                                </div>
                                <div class="form-group checkbox">
                                    <input type="checkbox" id="comment-notify" checked>
                                    <label for="comment-notify">Email me when someone posts a comment</label>
                                </div>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>

                        <div class="tab-pane" id="media">
                            <form>
                                <div class="form-group">
                                    <label>Image sizes</label>
                                    <div class="image-size-options">
                                        <div class="size-option">
                                            <label>Thumbnail size</label>
                                            <div class="size-inputs">
                                                <input type="number" value="150">
                                                <span>×</span>
                                                <input type="number" value="150">
                                            </div>
                                        </div>
                                        <div class="size-option">
                                            <label>Medium size</label>
                                            <div class="size-inputs">
                                                <input type="number" value="300">
                                                <span>×</span>
                                                <input type="number" value="300">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="js/script.js"></script>
</body>
</html>