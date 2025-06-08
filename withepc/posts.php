<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Admin - Posts</title>
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
                    <li >
                        <a href="index.php">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="active">
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

            <!-- Posts Content -->
            <div class="content">
                <div class="page-header">
                    <h2>Posts</h2>
                    <a href="post-edit.php" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add New Post
                    </a>
                </div>

                <div class="filters">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search posts...">
                    </div>
                    <div class="filter-group">
                        <label for="category-filter">Category:</label>
                        <select id="category-filter">
                            <option value="">All Categories</option>
                            <option>Technology</option>
                            <option>Business</option>
                            <option>Health</option>
                        </select>
                    </div>
                    <div class="filter-group">
                        <label for="status-filter">Status:</label>
                        <select id="status-filter">
                            <option value="">All Statuses</option>
                            <option>Published</option>
                            <option>Draft</option>
                        </select>
                    </div>
                </div>

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" id="select-all">
                                </th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>Getting Started with React</td>
                                <td>John Doe</td>
                                <td>Technology</td>
                                <td>May 15, 2023</td>
                                <td><span class="status published">Published</span></td>
                                <td>
                                    <button class="btn-icon"><i class="fas fa-edit"></i></button>
                                    <button class="btn-icon"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>CSS Grid Complete Guide</td>
                                <td>Jane Smith</td>
                                <td>Technology</td>
                                <td>May 10, 2023</td>
                                <td><span class="status published">Published</span></td>
                                <td>
                                    <button class="btn-icon"><i class="fas fa-edit"></i></button>
                                    <button class="btn-icon"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>JavaScript Best Practices</td>
                                <td>John Doe</td>
                                <td>Technology</td>
                                <td>May 5, 2023</td>
                                <td><span class="status draft">Draft</span></td>
                                <td>
                                    <button class="btn-icon"><i class="fas fa-edit"></i></button>
                                    <button class="btn-icon"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox"></td>
                                <td>Building REST APIs with Node.js</td>
                                <td>Mike Johnson</td>
                                <td>Technology</td>
                                <td>April 28, 2023</td>
                                <td><span class="status published">Published</span></td>
                                <td>
                                    <button class="btn-icon"><i class="fas fa-edit"></i></button>
                                    <button class="btn-icon"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="table-footer">
                        <div class="table-info">
                            Showing 1 to 4 of 4 entries
                        </div>
                        <div class="pagination">
                            <button disabled><i class="fas fa-chevron-left"></i></button>
                            <button class="active">1</button>
                            <button><i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="js/script.js"></script>
</body>
</html>