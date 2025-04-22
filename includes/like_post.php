<?php
// Include necessary files
require_once 'db_connect.php';
require_once 'functions.php';
session_start();

// Set content type to JSON
header('Content-Type: application/json');

// Check if post_id was provided
if (!isset($_POST['post_id']) || empty($_POST['post_id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Post ID is required'
    ]);
    exit;
}

$postId = intval($_POST['post_id']);
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Get session ID for guest users
$sessionId = session_id();

// Check if user is logged in or has a session
if (!$userId && !$sessionId) {
    echo json_encode([
        'success' => false,
        'message' => 'Authentication required'
    ]);
    exit;
}

$conn = db_connect();

// First check if user/session has already liked this post
$isLiked = false;
$stmt = null;

if ($userId) {
    // Check for logged in user
    $stmt = $conn->prepare("SELECT id FROM post_likes WHERE post_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $postId, $userId);
} else {
    // Check for guest user
    $stmt = $conn->prepare("SELECT id FROM post_likes WHERE post_id = ? AND session_id = ?");
    $stmt->bind_param("is", $postId, $sessionId);
}

$stmt->execute();
$result = $stmt->get_result();
$likeExists = $result->num_rows > 0;

if ($likeExists) {
    // User already liked this post - remove the like (unlike)
    if ($userId) {
        $deleteStmt = $conn->prepare("DELETE FROM post_likes WHERE post_id = ? AND user_id = ?");
        $deleteStmt->bind_param("ii", $postId, $userId);
    } else {
        $deleteStmt = $conn->prepare("DELETE FROM post_likes WHERE post_id = ? AND session_id = ?");
        $deleteStmt->bind_param("is", $postId, $sessionId);
    }
    
    $deleteStmt->execute();
    $isLiked = false;
} else {
    // User hasn't liked this post yet - add a like
    if ($userId) {
        $insertStmt = $conn->prepare("INSERT INTO post_likes (post_id, user_id, created_at) VALUES (?, ?, NOW())");
        $insertStmt->bind_param("ii", $postId, $userId);
    } else {
        $insertStmt = $conn->prepare("INSERT INTO post_likes (post_id, session_id, created_at) VALUES (?, ?, NOW())");
        $insertStmt->bind_param("is", $postId, $sessionId);
    }
    
    $insertStmt->execute();
    $isLiked = true;
}

// Get updated like count
$countStmt = $conn->prepare("SELECT COUNT(*) as like_count FROM post_likes WHERE post_id = ?");
$countStmt->bind_param("i", $postId);
$countStmt->execute();
$countResult = $countStmt->get_result();
$likeCount = $countResult->fetch_assoc()['like_count'];

// Update like count in posts table
$updateStmt = $conn->prepare("UPDATE community_posts SET likes = ? WHERE id = ?");
$updateStmt->bind_param("ii", $likeCount, $postId);
$updateStmt->execute();

// Return response
echo json_encode([
    'success' => true,
    'liked' => $isLiked,
    'likes' => $likeCount
]);

$conn->close(); 