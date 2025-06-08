<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Admin - Media Library</title>
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
                    <li class="active">
                        <a href="media.php">
                            <i class="fas fa-images"></i>
                            <span>Media</span>
                        </a>
                    </li>
                    <li>
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

            <!-- Media Content -->
            <div class="content">
                <div class="page-header">
                    <h2>Media Library</h2>
                    <button class="btn btn-primary">
                        <i class="fas fa-upload"></i> Upload New
                    </button>
                </div>

                <div class="media-filter">
                    <div class="filter-group">
                        <label for="media-type">Filter by type:</label>
                        <select id="media-type">
                            <option value="">All media items</option>
                            <option>Images</option>
                            <option>Documents</option>
                            <option>Videos</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="media-date">Filter by date:</label>
                        <select id="media-date">
                            <option value="">All dates</option>
                            <option>May 2023</option>
                            <option>April 2023</option>
                        </select>
                    </div>
                </div>

                <div class="media-grid">
                    <div class="media-item">
                        <div class="media-thumbnail">
                            <img src="https://picsum.photos/300/200" alt="Media">
                            <div class="media-actions">
                                <button class="btn-icon"><i class="fas fa-eye"></i></button>
                                <button class="btn-icon"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                        <div class="media-info">
                            <p>placeholder-image.jpg</p>
                            <small>300 × 200</small>
                        </div>
                    </div>
                    <div class="media-item">
                        <div class="media-thumbnail">
                            <img src="https://picsum.photos/300/200" alt="Media">
                            <div class="media-actions">
                                <button class="btn-icon"><i class="fas fa-eye"></i></button>
                                <button class="btn-icon"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                        <div class="media-info">
                            <p>another-image.png</p>
                            <small>300 × 200</small>
                        </div>
                    </div>
                    <div class="media-item">
                        <div class="media-thumbnail">
                            <i class="fas fa-file-pdf"></i>
                            <div class="media-actions">
                                <button class="btn-icon"><i class="fas fa-eye"></i></button>
                                <button class="btn-icon"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                        <div class="media-info">
                            <p>document.pdf</p>
                            <small>2.4 MB</small>
                        </div>
                    </div>
                </div>

                <div class="pagination">
                    <button disabled><i class="fas fa-chevron-left"></i></button>
                    <button class="active">1</button>
                    <button>2</button>
                    <button><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </main>
    </div>

    <script src="js/script.js"></script>
</body>
</html>