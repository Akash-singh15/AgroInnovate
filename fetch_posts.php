<?php
// Include necessary files
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

// Set appropriate headers
header('Content-Type: application/json');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

// Get posts from the database
$posts = getCommunityPosts(10);

// Return as JSON
echo json_encode($posts);
?> 