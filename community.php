<?php
// Include header and functions
include_once 'includes/header.php';
include_once 'includes/functions.php';
include_once 'includes/db_connect.php';

// Create community_posts table if it doesn't exist
if ($conn) {
    try {
        $sql = "CREATE TABLE IF NOT EXISTS community_posts (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT,
            name VARCHAR(255) NOT NULL,
            title VARCHAR(255) NOT NULL,
            content TEXT NOT NULL,
            location VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            image_path VARCHAR(255),
            likes INT DEFAULT 0,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
        )";
        $conn->exec($sql);
    } catch (PDOException $e) {
        error_log("Error creating community_posts table: " . $e->getMessage());
    }
}

$error = '';
$success = '';

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if required fields are filled
    if (empty($_POST['name']) || empty($_POST['title']) || empty($_POST['content'])) {
        $error = __('community_required_fields');
    } else {
        // Collect form data
        $name = sanitizeInput($_POST['name']);
        $title = sanitizeInput($_POST['title']);
        $content = sanitizeInput($_POST['content']);
        $location = sanitizeInput($_POST['location']);
        $imagePath = null;
        
        // Handle file upload if present
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $uploadDir = 'uploads/community/';
            
            // Create directory if it doesn't exist
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            $filename = time() . '_' . basename($_FILES['image']['name']);
            $targetFile = $uploadDir . $filename;
            
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($_FILES['image']['type'], $allowedTypes)) {
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    $imagePath = $targetFile;
                } else {
                    error_log("Failed to move uploaded file");
                }
            }
        }
        
        // Get user ID if logged in
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
        } else {
            $userId = null;
        }
        
        // Save post to database
        $result = saveCommunityPost($name, $title, $content, $location, $imagePath, $userId);
        
        if ($result) {
            $success = __('community_success');
            // Clear form data after successful submission
            $_POST = array();
        } else {
            $error = __('community_error');
        }
    }
}

// Get all community posts
$posts = getCommunityPosts();
?>

<!-- Page Header -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <h1><?php echo __('community_title'); ?></h1>
        <p class="lead"><?php echo __('community_subtitle'); ?></p>
    </div>
</section>

<!-- Community Forum Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Post submission alerts -->
                <?php if (!empty($success)): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i data-feather="check-circle"></i>
                    <span><?php echo $success; ?></span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php elseif (!empty($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i data-feather="alert-circle"></i>
                    <span><?php echo $error; ?></span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif; ?>

                <h2><?php echo __('community_recent_posts'); ?></h2>
                
                <!-- Community posts container for dynamic loading -->
                <div id="posts-container">
                    <!-- Initial posts will be loaded here -->
                    <?php if (empty($posts)): ?>
                    <div class="alert alert-info" role="alert">
                        <i data-feather="info"></i>
                        <span><?php echo __('community_no_posts'); ?></span>
                    </div>
                    <?php else: ?>
                        <?php foreach ($posts as $post): ?>
                        <div class="community-post">
                            <div class="post-header">
                                <div class="post-author"><?php echo $post['name']; ?></div>
                                <div class="post-location"><?php echo $post['location']; ?></div>
                            </div>
                            <h3 class="post-title"><?php echo $post['title']; ?></h3>
                            <div class="post-content">
                                <?php echo $post['content']; ?>
                            </div>
                            <?php if (!empty($post['image_path'])): ?>
                            <div class="post-image">
                                <img src="<?php echo $post['image_path']; ?>" alt="Post image" onerror="this.src='assets/default-post-image.jpg'; this.onerror=null;">
                            </div>
                            <?php endif; ?>
                            <div class="post-footer">
                                <div class="post-date">
                                    <?php echo date('F j, Y, g:i a', strtotime($post['created_at'])); ?>
                                </div>
                                <div class="post-actions">
                                    <div class="post-action like-btn" data-post-id="<?php echo $post['id']; ?>">
                                        <i data-feather="thumbs-up"></i>
                                        <span><?php echo __('community_like'); ?></span>
                                        <span class="like-count"><?php echo $post['likes'] ?? 0; ?></span>
                                    </div>
                                    <div class="post-action">
                                        <i data-feather="message-square"></i>
                                        <span><?php echo __('community_comment'); ?></span>
                                    </div>
                                    <div class="post-action">
                                        <i data-feather="share-2"></i>
                                        <span><?php echo __('community_share'); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="col-lg-4">
                <!-- Post submission form -->
                <div class="community-form sticky-top" style="top: 100px;">
                    <h3 class="form-title"><?php echo __('community_share_exp'); ?></h3>
                    <form id="community-post-form" method="post" action="" enctype="multipart/form-data">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label"><?php echo __('community_name'); ?></label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" required>
                            <div class="invalid-feedback"><?php echo __('community_name'); ?></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="location" class="form-label"><?php echo __('community_location'); ?></label>
                            <input type="text" class="form-control" id="location" name="location" required
                                placeholder="<?php echo ($_SESSION['language'] == 'en') ? 'e.g., Punjab, Maharashtra' : 'जैसे, पंजाब, महाराष्ट्र'; ?>">
                            <div class="invalid-feedback"><?php echo __('community_location'); ?></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="title" class="form-label"><?php echo __('community_post_title'); ?></label>
                            <input type="text" class="form-control" id="title" name="title" value="<?php echo isset($_POST['title']) ? htmlspecialchars($_POST['title']) : ''; ?>" required
                                placeholder="<?php echo ($_SESSION['language'] == 'en') ? 'e.g., Success with New Irrigation Method' : 'जैसे, नई सिंचाई पद्धति के साथ सफलता'; ?>">
                            <div class="invalid-feedback"><?php echo __('community_post_title'); ?></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="content" class="form-label"><?php echo __('community_experience'); ?></label>
                            <textarea class="form-control" id="content" name="content" rows="5" required><?php echo isset($_POST['content']) ? htmlspecialchars($_POST['content']) : ''; ?></textarea>
                            <div class="invalid-feedback"><?php echo __('community_experience'); ?></div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="image" class="form-label"><?php echo __('community_upload_image'); ?></label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        </div>
                        <button type="submit" name="submit_post" class="btn btn-primary w-100"><?php echo __('community_submit'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Farmer Stories Section -->
<section class="stories-section py-5">
    <div class="container">
        <div class="section-title">
            <h2><?php echo __('community_stories'); ?></h2>
        </div>
        <div class="row">
            <?php
            // Get farmer stories
            $stories = getFarmerStories(3);
            
            foreach ($stories as $story):
            ?>
            <div class="col-md-4 mb-4">
                <div class="story-card">
                    <div class="story-header">
                        <div class="story-avatar">
                            <img src="/assets/<?php echo $story['image']; ?>" alt="<?php echo $story['name']; ?>" class="img-fluid">
                        </div>
                        <div class="story-meta">
                            <h4 class="story-name"><?php echo $story['name']; ?></h4>
                            <div class="story-location"><?php echo $story['location']; ?></div>
                            <div class="story-crop"><?php echo $story['crop']; ?></div>
                        </div>
                    </div>
                    <div class="story-quote"><?php echo $story['quote']; ?></div>
                    <div class="story-content"><?php echo $story['story']; ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Community Groups Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="section-title">
            <h2><?php echo __('community_groups'); ?></h2>
        </div>
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <p class="lead text-center"><?php echo __('community_subtitle'); ?></p>
                        
                        <div class="row mt-4">
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <i data-feather="droplet" style="width: 48px; height: 48px; color: var(--primary-color);"></i>
                                        <h4 class="mt-3"><?php echo __('community_group_organic_title'); ?></h4>
                                        <p><?php echo __('community_group_organic_desc'); ?></p>
                                        <button class="btn btn-outline-primary"><?php echo __('community_join_group'); ?></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <i data-feather="trending-up" style="width: 48px; height: 48px; color: var(--primary-color);"></i>
                                        <h4 class="mt-3"><?php echo __('community_group_market_title'); ?></h4>
                                        <p><?php echo __('community_group_market_desc'); ?></p>
                                        <button class="btn btn-outline-primary"><?php echo __('community_join_group'); ?></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <i data-feather="cloud-rain" style="width: 48px; height: 48px; color: var(--primary-color);"></i>
                                        <h4 class="mt-3"><?php echo __('community_group_climate_title'); ?></h4>
                                        <p><?php echo __('community_group_climate_desc'); ?></p>
                                        <button class="btn btn-outline-primary"><?php echo __('community_join_group'); ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-center mt-4">
                            <button class="btn btn-primary"><?php echo __('community_view_all'); ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Upcoming Events Section -->
<section class="py-5">
    <div class="container">
        <div class="section-title">
            <h2><?php echo __('community_events'); ?></h2>
        </div>
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th><?php echo __('date'); ?></th>
                                <th><?php echo __('event'); ?></th>
                                <th><?php echo __('location'); ?></th>
                                <th><?php echo __('action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Dec 15, 2025</td>
                                <td><?php echo __('community_event_summit'); ?></td>
                                <td>New Delhi</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary"><?php echo __('community_register'); ?></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Dec 20, 2025</td>
                                <td><?php echo __('community_event_workshop'); ?></td>
                                <td>Pune, Maharashtra</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary"><?php echo __('community_register'); ?></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Jan 5, 2025</td>
                                <td><?php echo __('community_event_expo'); ?></td>
                                <td>Bangalore, Karnataka</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary"><?php echo __('community_register'); ?></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-3">
                    <button class="btn btn-primary"><?php echo __('community_view_all'); ?></button>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize feather icons
    if (typeof feather !== 'undefined') {
        feather.replace();
    }
    
    // Function to refresh posts every 30 seconds
    function refreshPosts() {
        fetch('fetch_posts.php')
            .then(response => response.json())
            .then(posts => {
                const postsContainer = document.getElementById('posts-container');
                
                // If no posts, show the no posts message
                if (posts.length === 0) {
                    postsContainer.innerHTML = `
                        <div class="alert alert-info" role="alert">
                            <i data-feather="info"></i>
                            <span><?php echo __('community_no_posts'); ?></span>
                        </div>
                    `;
                    return;
                }
                
                // Generate HTML for each post
                let postsHTML = '';
                posts.forEach(post => {
                    let imageHTML = '';
                    if (post.image_path) {
                        imageHTML = `
                            <div class="post-image">
                                <img src="${post.image_path}" alt="Post image" onerror="this.src='assets/default-post-image.jpg'; this.onerror=null;">
                            </div>
                        `;
                    }
                    
                    const postDate = new Date(post.created_at).toLocaleString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric',
                        hour: 'numeric',
                        minute: 'numeric',
                        hour12: true
                    });
                    
                    postsHTML += `
                        <div class="community-post">
                            <div class="post-header">
                                <div class="post-author">${post.name}</div>
                                <div class="post-location">${post.location}</div>
                            </div>
                            <h3 class="post-title">${post.title}</h3>
                            <div class="post-content">
                                ${post.content}
                            </div>
                            ${imageHTML}
                            <div class="post-footer">
                                <div class="post-date">
                                    ${postDate}
                                </div>
                                <div class="post-actions">
                                    <div class="post-action like-btn" data-post-id="${post.id}">
                                        <i data-feather="thumbs-up"></i>
                                        <span><?php echo __('community_like'); ?></span>
                                        <span class="like-count">${post.likes || 0}</span>
                                    </div>
                                    <div class="post-action">
                                        <i data-feather="message-square"></i>
                                        <span><?php echo __('community_comment'); ?></span>
                                    </div>
                                    <div class="post-action">
                                        <i data-feather="share-2"></i>
                                        <span><?php echo __('community_share'); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                });
                
                postsContainer.innerHTML = postsHTML;
                
                // Reinitialize feather icons for the new content
                if (typeof feather !== 'undefined') {
                    feather.replace();
                }
                
                // Re-attach event listeners to like buttons
                attachLikeButtonListeners();
            })
            .catch(error => {
                console.error('Error fetching posts:', error);
            });
    }
    
    // Function to attach event listeners to like buttons
    function attachLikeButtonListeners() {
        const likeButtons = document.querySelectorAll('.like-btn');
        likeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const postId = this.getAttribute('data-post-id');
                const likeCount = this.querySelector('.like-count');
                
                // Send AJAX request to like post
                fetch('includes/like_post.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'post_id=' + postId
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        likeCount.textContent = data.likes;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });
    }
    
    // Initial attach of like button listeners
    attachLikeButtonListeners();
    
    // Refresh posts every 30 seconds
    setInterval(refreshPosts, 30000);
});
</script>

<?php
// Include footer
include_once 'includes/footer.php';
?>
