<?php
require_once __DIR__ . '/session.php';
require_once __DIR__ . '/language.php';
?>
<!DOCTYPE html>
<html lang="<?php echo getCurrentLanguage(); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroInnovate – <?php echo __('home_hero_title'); ?></title>
    <meta name="description" content="<?php echo __('home_hero_subtitle'); ?>">
    
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/navbar.css">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="js/language.js" defer></script>
</head>
<body>
    <header class="site-header">
        <nav class="navbar navbar-expand-lg navbar-light" style="padding-left: 0;">
            <div class="container-fluid" style="margin-left: 0; padding-left: 0;">
                <div class="d-flex align-items-center">
                    <a class="navbar-brand" href="index.php" style="margin-left: 0; padding-left: 0;width: 70px; height: 70px;">
                        <img src="/assets/logo-transparent.png" alt="AgroInnovate Logo" height="20vh" width="auto" style="margin-left: 30px; padding-left: 0; display: block;">
                    </a>
                    <h1 class="navbar-brand mb-0" style="margin-left: 10px; font-size: 2.5rem; color: #4CAF50; font-weight: bold;">
                        AgroInnovate
                    </h1>
                </div>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>" href="index.php">
                                <?php echo __('nav_home'); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'weather.php') ? 'active' : ''; ?>" href="weather.php">
                                <?php echo __('nav_weather'); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'market.php') ? 'active' : ''; ?>" href="market.php">
                                <?php echo __('nav_market'); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'education.php') ? 'active' : ''; ?>" href="education.php">
                                <?php echo __('nav_education'); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'community.php') ? 'active' : ''; ?>" href="community.php">
                                <?php echo __('nav_community'); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'about.php') ? 'active' : ''; ?>" href="about.php">
                                <?php echo __('nav_about'); ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'contact.php') ? 'active' : ''; ?>" href="contact.php">
                                <?php echo __('nav_contact'); ?>
                            </a>
                        </li>
                        <?php if (isset($_SESSION['user_id'])): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle welcome-user" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i data-feather="user"></i> 👋 Hi, <?php echo htmlspecialchars($_SESSION['username'] ?? $_SESSION['user_name'] ?? 'User'); ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="profile.php"><i data-feather="user"></i> <?php echo __('nav_profile'); ?></a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="logout.php"><i data-feather="log-out"></i> <?php echo __('nav_logout'); ?></a></li>
                            </ul>
                        </li>
                        <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-success auth-button" href="login.php"><i data-feather="log-in"></i> <?php echo __('nav_login'); ?></a>
                        </li>
                        <?php endif; ?>
                        <li class="nav-item ms-2">
                            <div id="language-selector">
                                <select id="language-dropdown" class="form-select form-select-sm">
                                    <option value="en" <?php echo ($_SESSION['language'] == 'en') ? 'selected' : ''; ?>>English</option>
                                    <option value="hi" <?php echo ($_SESSION['language'] == 'hi') ? 'selected' : ''; ?>>हिन्दी</option>
                                    <option value="pa" <?php echo ($_SESSION['language'] == 'pa') ? 'selected' : ''; ?>>ਪੰਜਾਬੀ</option>
                                </select>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <script>
            // Initialize Feather icons
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof feather !== 'undefined') {
                    feather.replace();
                }
                
                // Navbar scroll effect
                const navbar = document.querySelector('.navbar');
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 50) {
                        navbar.classList.add('navbar-scrolled');
                    } else {
                        navbar.classList.remove('navbar-scrolled');
                    }
                });
            });
        </script>
    </header>
    <main>
