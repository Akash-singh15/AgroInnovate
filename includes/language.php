<?php
/**
 * Language functions for AgroInnovate
 */

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Set default language if not set or from cookie if available
if (!isset($_SESSION['language'])) {
    // Try to get language from cookie first
    if (isset($_COOKIE['preferred_language'])) {
        $_SESSION['language'] = $_COOKIE['preferred_language'];
    } else {
        $_SESSION['language'] = 'en'; // Default to English
    }
}

/**
 * Get the current language
 * 
 * @return string The current language code
 */
function getCurrentLanguage() {
    return $_SESSION['language'] ?? 'en';
}

/**
 * Set the current language
 * 
 * @param string $lang The language code to set
 * @return bool Whether the language was set successfully
 */
function setCurrentLanguage($lang) {
    if (in_array($lang, ['en', 'hi', 'pa'])) {
        $_SESSION['language'] = $lang;
        
        // Also set a cookie for persistence across sessions
        setcookie('preferred_language', $lang, time() + (86400 * 30), '/'); // 30 days
        
        return true;
    }
    return false;
}

/**
 * Load language strings for the current language
 * 
 * @return array The language strings
 */
function loadLanguage() {
    $langCode = getCurrentLanguage();
    $langFile = __DIR__ . '/../lang/' . $langCode . '.php';
    
    if (file_exists($langFile)) {
        require $langFile;
        return $lang ?? [];
    }
    
    // Fallback to English
    require __DIR__ . '/../lang/en.php';
    return $lang ?? [];
}

/**
 * Translate a string key to the current language
 * 
 * @param string $key The translation key
 * @param string|null $default The default value if key is not found
 * @return string The translated string
 */
function __($key, $default = null) {
    static $translations = null;
    
    if ($translations === null) {
        $translations = loadLanguage();
    }
    
    return $translations[$key] ?? $default ?? $key;
}
?> 