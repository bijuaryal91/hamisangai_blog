<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Admin - Edit Post</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <style>
        .image-preview {
            max-width: 100%;
            max-height: 200px;
            display: none;
            margin-bottom: 1rem;
        }
        .note-modal-footer
        {
            position: relative;
            bottom: 25px;
        }
        

        #post-image-input,
        #featured-image-input {
            display: none;
        }

        /* Summernote customization */
        .note-editor.note-frame {
            border: 1px solid var(--light-gray);
            border-radius: 0.5rem;
        }

        .note-editor.note-frame .note-toolbar {
            background-color: var(--light-gray);
            border-radius: 0.5rem 0.5rem 0 0;
            padding: 0.5rem;
        }

        .note-editor.note-frame .note-statusbar {
            background-color: var(--light-gray);
            border-radius: 0 0 0.5rem 0.5rem;
        }

        .note-editor.note-frame .note-editing-area .note-editable {
            padding: 1rem;
            min-height: 400px;
            line-height: 1.8;
        }

        .note-btn {
            border-radius: 0.3rem !important;
            border: 1px solid var(--light-gray) !important;
            background-color: var(--white) !important;
            color: var(--dark-color) !important;
            transition: var(--transition) !important;
        }

        .note-btn:hover {
            background-color: var(--primary-color) !important;
            color: var(--white) !important;
            border-color: var(--primary-color) !important;
        }

        .note-btn.active {
            background-color: var(--primary-color) !important;
            color: var(--white) !important;
            border-color: var(--primary-color) !important;
        }

        .image-container {
            margin: 1rem 0;
            text-align: center;
        }

        .image-container img {
            max-width: 100%;
            height: auto;
            border-radius: 0.5rem;
        }

        /* Link styling in editor */
        #post-content a {
            color: var(--primary-color);
            text-decoration: underline;
        }

        /* List styling in editor */
        #post-content ul,
        #post-content ol {
            padding-left: 2rem;
            margin: 1rem 0;
        }

        #post-content li {
            margin-bottom: 0.5rem;
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h1><i class="fas fa-blog"></i> Blog Admin</h1>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li class="active">
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

            <!-- Post Editor Content -->
            <div class="content">
                <div class="page-header">
                    <h2>Edit Post</h2>
                    <div class="action-buttons">
                        <button class="btn">
                            <i class="fas fa-save"></i> Save Draft
                        </button>
                        <button class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> Publish
                        </button>
                    </div>
                </div>

                <div class="post-editor">
                    <div class="editor-main">
                        <div class="form-group">
                            <input type="text" id="post-title" placeholder="Post title...">
                        </div>
                        <div class="form-group">
                            <textarea id="post-content"></textarea>
                        </div>
                    </div>

                    <div class="editor-sidebar">
                        <div class="sidebar-section">
                            <h3>Publish</h3>
                            <div class="form-group">
                                <label>Status</label>
                                <select>
                                    <option>Draft</option>
                                    <option selected>Published</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Visibility</label>
                                <select>
                                    <option selected>Public</option>
                                    <option>Private</option>
                                    <option>Password Protected</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Publish Date</label>
                                <input type="datetime-local" value="2023-05-15T10:00">
                            </div>
                        </div>

                        <div class="sidebar-section">
                            <h3>Categories</h3>
                            <div class="form-group">
                                <select>
                                    <option>Technology</option>
                                    <option selected>Web Development</option>
                                    <option>Business</option>
                                    <option>Health</option>
                                </select>
                            </div>
                            <a href="#"><i class="fas fa-plus"></i> Add New Category</a>
                        </div>

                        <div class="sidebar-section">
                            <h3>Tags</h3>
                            <div class="form-group">
                                <input type="text" placeholder="Add tags..." id="tags-input">
                                <div class="tags-container">
                                    <span class="tag">JavaScript <i class="fas fa-times"></i></span>
                                    <span class="tag">React <i class="fas fa-times"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-section">
                            <h3>Featured Image</h3>
                            <div class="image-upload">
                                <img id="featured-image-preview" src="https://picsum.photos/300/200"
                                    alt="Featured Image" class="image-preview">
                                <input type="file" id="featured-image-input" accept="image/*">
                                <button class="btn" id="upload-featured-btn"><i class="fas fa-upload"></i> Upload
                                    Image</button>
                                <button class="btn btn-danger" id="remove-featured-btn"><i class="fas fa-trash"></i>
                                    Remove</button>
                            </div>
                        </div>

                        <div class="sidebar-section">
                            <h3>SEO Settings</h3>
                            <div class="form-group">
                                <label>Meta Title</label>
                                <input type="text" placeholder="Meta title...">
                            </div>
                            <div class="form-group">
                                <label>Meta Description</label>
                                <textarea placeholder="Meta description..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- jQuery (required for Summernote) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="js/script.js"></script>

   <script>
    $(document).ready(function () {
        // Initialize Summernote editor
        $('#post-content').summernote({
            height: 400,
            placeholder: 'Write your post content here...',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            callbacks: {
                onInit: function() {
                    // Ensure placeholder is visible when editor is empty
                    if ($('#post-content').summernote('isEmpty')) {
                        $('.note-placeholder').show();
                    }
                },
                onImageUpload: function (files) {
                    // Handle image upload with resizing
                    for (let i = 0; i < files.length; i++) {
                        resizeAndUploadImage(files[i]);
                    }
                }
            }
        });

        // Function to resize and upload image
        function resizeAndUploadImage(file) {
            const maxWidth = 800; // Maximum width for uploaded images
            const maxHeight = 600; // Maximum height for uploaded images
            const quality = 0.7; // Image quality (0.7 = 70%)
            
            const reader = new FileReader();
            reader.onload = function(event) {
                const img = new Image();
                img.src = event.target.result;
                
                img.onload = function() {
                    const canvas = document.createElement('canvas');
                    let width = img.width;
                    let height = img.height;
                    
                    // Calculate new dimensions while maintaining aspect ratio
                    if (width > height) {
                        if (width > maxWidth) {
                            height *= maxWidth / width;
                            width = maxWidth;
                        }
                    } else {
                        if (height > maxHeight) {
                            width *= maxHeight / height;
                            height = maxHeight;
                        }
                    }
                    
                    // Set canvas dimensions
                    canvas.width = width;
                    canvas.height = height;
                    
                    // Draw resized image
                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, width, height);
                    
                    // Convert to data URL with reduced quality
                    const resizedDataUrl = canvas.toDataURL('image/jpeg', quality);
                    
                    // Insert resized image into editor
                    $('#post-content').summernote('insertImage', resizedDataUrl);
                };
            };
            reader.readAsDataURL(file);
        }

        // Featured image upload
        $('#upload-featured-btn').click(function () {
            $('#featured-image-input').click();
        });

        $('#featured-image-input').change(function () {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $('#featured-image-preview').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(this.files[0]);
            }
        });

        $('#remove-featured-btn').click(function () {
            $('#featured-image-preview').attr('src', '').hide();
            $('#featured-image-input').val('');
        });
    });
</script>
</body>

</html>