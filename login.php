<?php
require_once 'includes/session.php';
require_once 'includes/functions.php';

// Initialize variables for form processing
$loginError = '';
$registerError = '';
$registerSuccess = '';

// Process login form
if (isset($_POST['login'])) {
    $email = sanitizeInput($_POST['login_email']);
    $password = $_POST['login_password'];
    
    // Validate email
    if (!isValidEmail($email)) {
        $loginError = 'Please enter a valid email address.';
    } else {
        // Check if user exists in database
        $sql = "SELECT * FROM users WHERE email = ?";
        $user = fetchOne($sql, [$email]);
        
        if ($user && password_verify($password, $user['password'])) {
            // Login successful
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            
            // Redirect to home page
            header('Location: index.php');
            exit;
        } else {
            $loginError = 'Invalid email or password.';
        }
    }
}

// Process registration form
if (isset($_POST['register'])) {
    $name = sanitizeInput($_POST['register_name']);
    $email = sanitizeInput($_POST['register_email']);
    $password = $_POST['register_password'];
    $confirmPassword = $_POST['register_password_confirm'];
    
    // Validate inputs
    if (empty($name) || empty($email) || empty($password)) {
        $registerError = 'All fields are required.';
    } elseif (!isValidEmail($email)) {
        $registerError = 'Please enter a valid email address.';
    } elseif ($password !== $confirmPassword) {
        $registerError = 'Passwords do not match.';
    } elseif (strlen($password) < 6) {
        $registerError = 'Password must be at least 6 characters long.';
    } else {
        // Check if email already exists
        $sql = "SELECT * FROM users WHERE email = ?";
        $existingUser = fetchOne($sql, [$email]);
        
        if ($existingUser) {
            $registerError = 'Email already registered. Please use a different email or login.';
        } else {
            // Hash password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            // Insert user into database
            $userData = [
                'name' => $name,
                'email' => $email,
                'password' => $hashedPassword,
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            $userId = insertData('users', $userData);
            
            if ($userId) {
                // Registration successful
                $registerSuccess = 'Registration successful! You can now login.';
                
                // Send confirmation email
                $subject = 'Welcome to AgroInnovate - Registration Confirmation';
                $message = "Hello $name,\n\nYou have successfully registered to AgroInnovate using this email: $email.\n\nThank you for joining us!\n\nThe AgroInnovate Team";
                $headers = 'From: noreply@agroinnovate.com' . "\r\n" .
                    'Reply-To: contact@agroinnovate.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                
                mail($email, $subject, $message, $headers);
            } else {
                $registerError = 'Registration failed. Please try again later.';
            }
        }
    }
}

// Process forgot password request
if (isset($_POST['forgot_password'])) {
    $email = sanitizeInput($_POST['forgot_email']);
    
    // Validate email
    if (!isValidEmail($email)) {
        $loginError = 'Please enter a valid email address.';
    } else {
        // Check if user exists
        $sql = "SELECT * FROM users WHERE email = ?";
        $user = fetchOne($sql, [$email]);
        
        if ($user) {
            // Send password reset email
            $subject = 'AgroInnovate - Password Recovery';
            $message = "Hello {$user['name']},\n\nYou requested to recover your password for AgroInnovate.\n\nYour current password is: [MASKED FOR SECURITY].\n\nPlease login and change your password immediately for security reasons.\n\nThe AgroInnovate Team";
            $headers = 'From: noreply@agroinnovate.com' . "\r\n" .
                'Reply-To: contact@agroinnovate.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
            
            mail($email, $subject, $message, $headers);
            
            $loginError = 'Password recovery email sent. Please check your inbox.';
        } else {
            $loginError = 'Email not found. Please check your email or register a new account.';
        }
    }
}

// Determine which tab to show (login or register)
$activeTab = isset($_GET['tab']) && $_GET['tab'] === 'register' ? 'register' : 'login';
?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION['language']; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AgroInnovate</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .auth-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        
        .auth-tabs {
            margin-bottom: 25px;
        }
        
        .nav-tabs .nav-link {
            color: #495057;
            font-weight: 500;
            font-size: 16px;
            padding: 15px 25px;
            border: none;
            border-bottom: 2px solid transparent;
        }
        
        .nav-tabs .nav-link.active {
            color: #28a745;
            border-bottom: 2px solid #28a745;
            background-color: transparent;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .auth-divider {
            position: relative;
            text-align: center;
            margin: 1.5rem 0;
        }
        
        .auth-divider:before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            border-top: 1px solid #ddd;
            z-index: 1;
        }
        
        .auth-divider span {
            position: relative;
            background: #fff;
            padding: 0 10px;
            z-index: 2;
        }
        
        .forgot-password {
            margin-top: 1rem;
            text-align: right;
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <div class="container">
        <div class="auth-container">
            <!-- Auth Tabs -->
            <ul class="nav nav-tabs auth-tabs" id="authTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link <?php echo $activeTab === 'login' ? 'active' : ''; ?>" 
                       id="login-tab" data-bs-toggle="tab" href="#login" role="tab" 
                       aria-controls="login" aria-selected="<?php echo $activeTab === 'login' ? 'true' : 'false'; ?>"
                       data-en="Login" data-hi="लॉगिन">
                        <?php echo ($_SESSION['language'] == 'en') ? 'Login' : 'लॉगिन'; ?>
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link <?php echo $activeTab === 'register' ? 'active' : ''; ?>" 
                       id="register-tab" data-bs-toggle="tab" href="#register" role="tab" 
                       aria-controls="register" aria-selected="<?php echo $activeTab === 'register' ? 'true' : 'false'; ?>"
                       data-en="Register" data-hi="पंजीकरण">
                        <?php echo ($_SESSION['language'] == 'en') ? 'Register' : 'पंजीकरण'; ?>
                    </a>
                </li>
            </ul>
            
            <!-- Tab Content -->
            <div class="tab-content" id="authTabContent">
                <!-- Login Tab -->
                <div class="tab-pane fade <?php echo $activeTab === 'login' ? 'show active' : ''; ?>" id="login" role="tabpanel" aria-labelledby="login-tab">
                    <h3 data-en="Welcome back!" data-hi="वापसी पर स्वागत है!">
                        <?php echo ($_SESSION['language'] == 'en') ? 'Welcome back!' : 'वापसी पर स्वागत है!'; ?>
                    </h3>
                    <p class="text-muted mb-4" data-en="Please login to your account." data-hi="कृपया अपने खाते में लॉगिन करें।">
                        <?php echo ($_SESSION['language'] == 'en') ? 'Please login to your account.' : 'कृपया अपने खाते में लॉगिन करें।'; ?>
                    </p>
                    
                    <?php if ($loginError && $activeTab === 'login'): ?>
                        <div class="alert alert-danger"><?php echo $loginError; ?></div>
                    <?php endif; ?>
                    
                    <form class="auth-form" method="post" action="login.php">
                        <div class="form-group">
                            <label for="login_email" data-en="Email" data-hi="ईमेल">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Email' : 'ईमेल'; ?>
                            </label>
                            <input type="email" class="form-control" id="login_email" name="login_email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="login_password" data-en="Password" data-hi="पासवर्ड">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Password' : 'पासवर्ड'; ?>
                            </label>
                            <input type="password" class="form-control" id="login_password" name="login_password" required>
                        </div>
                        
                        <button type="submit" name="login" class="btn btn-primary w-100" data-en="Login" data-hi="लॉगिन">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Login' : 'लॉगिन'; ?>
                        </button>
                    </form>
                    
                    <div class="forgot-password">
                        <a href="#" id="forgot-password-link" data-en="Forgot Password?" data-hi="पासवर्ड भूल गए?">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Forgot Password?' : 'पासवर्ड भूल गए?'; ?>
                        </a>
                    </div>
                    
                    <!-- Forgot Password Form (Hidden by default) -->
                    <div id="forgot-password-form" style="display: none;">
                        <form method="post" action="login.php">
                            <div class="form-group">
                                <label for="forgot_email" data-en="Enter your email" data-hi="अपना ईमेल दर्ज करें">
                                    <?php echo ($_SESSION['language'] == 'en') ? 'Enter your email' : 'अपना ईमेल दर्ज करें'; ?>
                                </label>
                                <input type="email" class="form-control" id="forgot_email" name="forgot_email" required>
                            </div>
                            
                            <button type="submit" name="forgot_password" class="btn btn-outline-primary w-100" data-en="Reset Password" data-hi="पासवर्ड रीसेट करें">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Reset Password' : 'पासवर्ड रीसेट करें'; ?>
                            </button>
                        </form>
                        
                        <div class="mt-3 text-center">
                            <a href="#" id="back-to-login" data-en="Back to Login" data-hi="लॉगिन पर वापस जाएं">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Back to Login' : 'लॉगिन पर वापस जाएं'; ?>
                            </a>
                        </div>
                    </div>
                    
                    <div class="auth-divider">
                        <span data-en="New user?" data-hi="नए उपयोगकर्ता?">
                            <?php echo ($_SESSION['language'] == 'en') ? 'New user?' : 'नए उपयोगकर्ता?'; ?>
                        </span>
                    </div>
                    
                    <a href="login.php?tab=register" class="btn btn-outline-success w-100" data-en="Create an account" data-hi="खाता बनाएं">
                        <?php echo ($_SESSION['language'] == 'en') ? 'Create an account' : 'खाता बनाएं'; ?>
                    </a>
                </div>
                
                <!-- Register Tab -->
                <div class="tab-pane fade <?php echo $activeTab === 'register' ? 'show active' : ''; ?>" id="register" role="tabpanel" aria-labelledby="register-tab">
                    <h3 data-en="Create an account" data-hi="खाता बनाएं">
                        <?php echo ($_SESSION['language'] == 'en') ? 'Create an account' : 'खाता बनाएं'; ?>
                    </h3>
                    <p class="text-muted mb-4" data-en="Join AgroInnovate to access all features." data-hi="सभी सुविधाओं का उपयोग करने के लिए एग्रोइनोवेट से जुड़ें।">
                        <?php echo ($_SESSION['language'] == 'en') ? 'Join AgroInnovate to access all features.' : 'सभी सुविधाओं का उपयोग करने के लिए एग्रोइनोवेट से जुड़ें।'; ?>
                    </p>
                    
                    <?php if ($registerError && $activeTab === 'register'): ?>
                        <div class="alert alert-danger"><?php echo $registerError; ?></div>
                    <?php endif; ?>
                    
                    <?php if ($registerSuccess && $activeTab === 'register'): ?>
                        <div class="alert alert-success"><?php echo $registerSuccess; ?></div>
                    <?php endif; ?>
                    
                    <form class="auth-form" method="post" action="login.php?tab=register">
                        <div class="form-group">
                            <label for="register_name" data-en="Full Name" data-hi="पूरा नाम">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Full Name' : 'पूरा नाम'; ?>
                            </label>
                            <input type="text" class="form-control" id="register_name" name="register_name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="register_email" data-en="Email" data-hi="ईमेल">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Email' : 'ईमेल'; ?>
                            </label>
                            <input type="email" class="form-control" id="register_email" name="register_email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="register_password" data-en="Password" data-hi="पासवर्ड">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Password' : 'पासवर्ड'; ?>
                            </label>
                            <input type="password" class="form-control" id="register_password" name="register_password" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="register_password_confirm" data-en="Confirm Password" data-hi="पासवर्ड की पुष्टि करें">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Confirm Password' : 'पासवर्ड की पुष्टि करें'; ?>
                            </label>
                            <input type="password" class="form-control" id="register_password_confirm" name="register_password_confirm" required>
                        </div>
                        
                        <button type="submit" name="register" class="btn btn-success w-100" data-en="Register" data-hi="पंजीकरण करें">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Register' : 'पंजीकरण करें'; ?>
                        </button>
                    </form>
                    
                    <div class="auth-divider">
                        <span data-en="Already have an account?" data-hi="पहले से ही एक खाता है?">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Already have an account?' : 'पहले से ही एक खाता है?'; ?>
                        </span>
                    </div>
                    
                    <a href="login.php" class="btn btn-outline-primary w-100" data-en="Login to your account" data-hi="अपने खाते में लॉगिन करें">
                        <?php echo ($_SESSION['language'] == 'en') ? 'Login to your account' : 'अपने खाते में लॉगिन करें'; ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
    
    <script src="js/language.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tab switching via Bootstrap's tab API
            const loginTab = document.getElementById('login-tab');
            const registerTab = document.getElementById('register-tab');
            
            // Forgot password toggle
            const forgotPasswordLink = document.getElementById('forgot-password-link');
            const forgotPasswordForm = document.getElementById('forgot-password-form');
            const backToLoginLink = document.getElementById('back-to-login');
            const loginForm = document.querySelector('#login .auth-form');
            
            if (forgotPasswordLink) {
                forgotPasswordLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    loginForm.style.display = 'none';
                    forgotPasswordForm.style.display = 'block';
                    forgotPasswordLink.style.display = 'none';
                });
            }
            
            if (backToLoginLink) {
                backToLoginLink.addEventListener('click', function(e) {
                    e.preventDefault();
                    loginForm.style.display = 'block';
                    forgotPasswordForm.style.display = 'none';
                    forgotPasswordLink.style.display = 'block';
                });
            }
        });
    </script>
</body>
</html> 