document.addEventListener('DOMContentLoaded', function() {
    // Initialize variables
    let currentPage = 1;
    const postsPerPage = 5;
    const postsContainer = document.getElementById('community-posts');
    const loadMoreBtn = document.getElementById('load-more-btn');
    let totalPages = 1;
    
    // Initial load of posts
    loadPosts(currentPage);
    
    // Load more button event listener
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            if (currentPage < totalPages) {
                currentPage++;
                loadPosts(currentPage, true);
            } else {
                loadMoreBtn.style.display = 'none';
            }
        });
    }
    
    // Function to load posts
    function loadPosts(page, append = false) {
        // Show loading indicator
        const loadingIndicator = document.getElementById('loading-indicator');
        if (loadingIndicator) loadingIndicator.style.display = 'block';
        
        // Fetch posts from the server
        fetch(`includes/fetch_posts.php?page=${page}&limit=${postsPerPage}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update total pages
                    totalPages = data.pagination.totalPages;
                    
                    // Hide load more button if on last page
                    if (page >= totalPages && loadMoreBtn) {
                        loadMoreBtn.style.display = 'none';
                    } else if (loadMoreBtn) {
                        loadMoreBtn.style.display = 'block';
                    }
                    
                    // Render posts
                    renderPosts(data.posts, append);
                } else {
                    console.error('Failed to load posts');
                }
                
                // Hide loading indicator
                if (loadingIndicator) loadingIndicator.style.display = 'none';
            })
            .catch(error => {
                console.error('Error loading posts:', error);
                if (loadingIndicator) loadingIndicator.style.display = 'none';
            });
    }
    
    // Function to render posts
    function renderPosts(posts, append = false) {
        if (!postsContainer) return;
        
        // Create HTML for posts
        const postsHTML = posts.map(post => {
            const date = new Date(post.created_at);
            const formattedDate = date.toLocaleDateString();
            
            return `
            <div class="card mb-4 post-card" data-post-id="${post.id}">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <h5 class="card-title">${post.title}</h5>
                            <h6 class="card-subtitle text-muted">
                                ${post.author_name} ${post.author_location ? '- ' + post.author_location : ''}
                            </h6>
                        </div>
                        <small class="text-muted">${formattedDate}</small>
                    </div>
                    <p class="card-text">${post.content}</p>
                    ${post.image_path ? `<img src="${post.image_path}" class="img-fluid rounded mb-3" alt="Post image">` : ''}
                    <div class="d-flex justify-content-between align-items-center">
                        <button class="btn btn-sm ${post.isLiked ? 'btn-success' : 'btn-outline-success'} like-button" data-post-id="${post.id}">
                            <i class="fas fa-thumbs-up"></i> 
                            <span class="like-count">${post.likes}</span> Likes
                        </button>
                        <div class="share-buttons">
                            <button class="btn btn-sm btn-outline-primary share-whatsapp" data-post-id="${post.id}">
                                <i class="fab fa-whatsapp"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-primary share-facebook" data-post-id="${post.id}">
                                <i class="fab fa-facebook-f"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-primary share-twitter" data-post-id="${post.id}">
                                <i class="fab fa-twitter"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>`;
        }).join('');
        
        // Append or replace posts
        if (append) {
            postsContainer.innerHTML += postsHTML;
        } else {
            postsContainer.innerHTML = postsHTML;
        }
        
        // Add event listeners to like buttons
        document.querySelectorAll('.like-button').forEach(button => {
            button.addEventListener('click', handleLikeClick);
        });
        
        // Add event listeners to share buttons
        document.querySelectorAll('.share-whatsapp').forEach(button => {
            button.addEventListener('click', shareOnWhatsApp);
        });
        
        document.querySelectorAll('.share-facebook').forEach(button => {
            button.addEventListener('click', shareOnFacebook);
        });
        
        document.querySelectorAll('.share-twitter').forEach(button => {
            button.addEventListener('click', shareOnTwitter);
        });
    }
    
    // Function to handle like button clicks
    function handleLikeClick(event) {
        const button = event.currentTarget;
        const postId = button.getAttribute('data-post-id');
        const likeCountElement = button.querySelector('.like-count');
        
        // Send like request to server
        fetch('includes/like_post.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `post_id=${postId}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update like count
                likeCountElement.textContent = data.likes;
                
                // Toggle button appearance
                if (data.liked) {
                    button.classList.remove('btn-outline-success');
                    button.classList.add('btn-success');
                } else {
                    button.classList.remove('btn-success');
                    button.classList.add('btn-outline-success');
                }
            }
        })
        .catch(error => {
            console.error('Error liking post:', error);
        });
    }
    
    // Share functions
    function shareOnWhatsApp(event) {
        const postId = event.currentTarget.getAttribute('data-post-id');
        const postCard = document.querySelector(`.post-card[data-post-id="${postId}"]`);
        const title = postCard.querySelector('.card-title').textContent;
        const url = window.location.href.split('?')[0] + '?post=' + postId;
        
        window.open(`https://api.whatsapp.com/send?text=${encodeURIComponent(title + ' - ' + url)}`, '_blank');
    }
    
    function shareOnFacebook(event) {
        const postId = event.currentTarget.getAttribute('data-post-id');
        const url = window.location.href.split('?')[0] + '?post=' + postId;
        
        window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`, '_blank');
    }
    
    function shareOnTwitter(event) {
        const postId = event.currentTarget.getAttribute('data-post-id');
        const postCard = document.querySelector(`.post-card[data-post-id="${postId}"]`);
        const title = postCard.querySelector('.card-title').textContent;
        const url = window.location.href.split('?')[0] + '?post=' + postId;
        
        window.open(`https://twitter.com/intent/tweet?text=${encodeURIComponent(title)}&url=${encodeURIComponent(url)}`, '_blank');
    }
    
    // Form submission handling
    const communityForm = document.getElementById('community-post-form');
    if (communityForm) {
        communityForm.addEventListener('submit', function(event) {
            // Form is handled by PHP, so no need to prevent default
            // This is just for any additional client-side validation or UI updates
            
            // Reset form on successful submission (handled by PHP redirect)
            // Could add additional validation here if needed
        });
    }
}); 