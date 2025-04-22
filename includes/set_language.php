<?php
// Include language helper
require_once 'language.php';

// Get language parameter
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';
$redirect = isset($_GET['redirect']) ? $_GET['redirect'] : '../index.php';

// Validate and set language
if (setCurrentLanguage($lang)) {
    // Log language change
    error_log("Language changed to: $lang for session ID: " . session_id());
} else {
    // Log error for invalid language
    error_log("Invalid language code provided: $lang");
}

// Redirect back to the original page
header("Location: $redirect");
exit;
?>