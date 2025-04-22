<?php
// Include necessary files
require_once 'db_connect.php';
require_once 'functions.php';
session_start();

// Set content type to JSON
header('Content-Type: application/json');

// Get pagination parameters
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$postsPerPage = isset($_GET['per_page']) ? intval($_GET['per_page']) : 6;

// Ensure valid values
if ($page < 1) $page = 1;
if ($postsPerPage < 1 || $postsPerPage > 20) $postsPerPage = 6;

// Calculate offset
$offset = ($page - 1) * $postsPerPage;

$conn = db_connect();

// Get total post count
$totalCountQuery = "SELECT COUNT(*) as total FROM community_posts WHERE status = 'approved'";
$totalResult = $conn->query($totalCountQuery);
$totalRow = $totalResult->fetch_assoc();
$totalPosts = $totalRow['total'];
$totalPages = ceil($totalPosts / $postsPerPage);

// Get current user ID if logged in
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$sessionId = session_id();

// Fetch posts with pagination
$query = "SELECT cp.*, u.name as user_name, u.profile_image 
          FROM community_posts cp 
          LEFT JOIN users u ON cp.user_id = u.id 
          WHERE cp.status = 'approved' 
          ORDER BY cp.created_at DESC 
          LIMIT ? OFFSET ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $postsPerPage, $offset);
$stmt->execute();
$result = $stmt->get_result();

$posts = [];
while ($row = $result->fetch_assoc()) {
    // Check if current user/session has liked each post
    $isLiked = false;
    
    if ($userId) {
        $likeStmt = $conn->prepare("SELECT id FROM post_likes WHERE post_id = ? AND user_id = ?");
        $likeStmt->bind_param("ii", $row['id'], $userId);
    } else {
        $likeStmt = $conn->prepare("SELECT id FROM post_likes WHERE post_id = ? AND session_id = ?");
        $likeStmt->bind_param("is", $row['id'], $sessionId);
    }
    
    $likeStmt->execute();
    $likeResult = $likeStmt->get_result();
    $isLiked = $likeResult->num_rows > 0;
    
    // Format post data
    $post = [
        'id' => $row['id'],
        'title' => $row['title'],
        'content' => $row['content'],
        'image' => $row['image_path'] ? 'uploads/community/' . $row['image_path'] : null,
        'user_name' => $row['user_name'] ?: $row['name'], // Use name from post if user_name is null
        'profile_image' => $row['profile_image'] ? 'uploads/profiles/' . $row['profile_image'] : 'images/default-avatar.png',
        'likes' => $row['likes'],
        'created_at' => date('M d, Y', strtotime($row['created_at'])),
        'is_liked' => $isLiked
    ];
    
    $posts[] = $post;
}

// Return JSON response
echo json_encode([
    'success' => true,
    'posts' => $posts,
    'pagination' => [
        'current_page' => $page,
        'per_page' => $postsPerPage,
        'total_posts' => $totalPosts,
        'total_pages' => $totalPages
    ]
]);

$conn->close();
?> 