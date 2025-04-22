<?php
require_once 'includes/session.php';
require_once 'includes/functions.php';

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Initialize variables
$successMessage = '';
$errorMessage = '';

// Get user data
$userData = fetchOne("SELECT * FROM users WHERE id = ?", [$_SESSION['user_id']]);

// Process profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $name = sanitizeInput($_POST['name']);
    $email = sanitizeInput($_POST['email']);
    $currentPassword = $_POST['current_password'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';
    
    // Validate inputs
    if (empty($name)) {
        $errorMessage = 'Name is required.';
    } elseif (empty($email)) {
        $errorMessage = 'Email is required.';
    } elseif (!isValidEmail($email)) {
        $errorMessage = 'Please enter a valid email address.';
    } else {
        // Check if email exists for another user
        $existingUser = fetchOne("SELECT * FROM users WHERE email = ? AND id != ?", [$email, $_SESSION['user_id']]);
        
        if ($existingUser) {
            $errorMessage = 'Email already in use by another account.';
        } else {
            // Update user profile
            $updateData = [
                'name' => $name,
                'email' => $email
            ];
            
            // If changing password
            if (!empty($currentPassword) && !empty($newPassword)) {
                // Verify current password
                if (!password_verify($currentPassword, $userData['password'])) {
                    $errorMessage = 'Current password is incorrect.';
                } elseif ($newPassword !== $confirmPassword) {
                    $errorMessage = 'New passwords do not match.';
                } elseif (strlen($newPassword) < 6) {
                    $errorMessage = 'New password must be at least 6 characters long.';
                } else {
                    // Hash new password
                    $updateData['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
                }
            }
            
            // If no error, update profile
            if (empty($errorMessage)) {
                $updated = updateData('users', $updateData, 'id = ?', [$_SESSION['user_id']]);
                
                if ($updated) {
                    // Update session variables
                    $_SESSION['user_name'] = $name;
                    $_SESSION['user_email'] = $email;
                    
                    $successMessage = 'Profile updated successfully.';
                    
                    // Refresh user data
                    $userData = fetchOne("SELECT * FROM users WHERE id = ?", [$_SESSION['user_id']]);
                } else {
                    $errorMessage = 'Error updating profile. Please try again.';
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="<?php echo $_SESSION['language']; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - AgroInnovate</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .profile-container {
            max-width: 800px;
            margin: 50px auto;
        }
        
        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .profile-avatar {
            width: 100px;
            height: 100px;
            background-color: var(--primary-color);
            border-radius: 50%;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            font-weight: 600;
            margin-right: 20px;
        }
        
        .profile-name h2 {
            margin-bottom: 5px;
        }
        
        .profile-email {
            color: var(--gray-color);
        }
        
        .profile-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            padding: 30px;
            margin-bottom: 30px;
        }
        
        .profile-card h3 {
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }
        
        .profile-card h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: var(--primary-color);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <main>
        <div class="container profile-container">
            <div class="profile-header">
                <div class="profile-avatar">
                    <?php echo strtoupper(substr($userData['name'], 0, 1)); ?>
                </div>
                <div class="profile-name">
                    <h2><?php echo htmlspecialchars($userData['name']); ?></h2>
                    <div class="profile-email"><?php echo htmlspecialchars($userData['email']); ?></div>
                    <div class="profile-joined">Joined: <?php echo date('F j, Y', strtotime($userData['created_at'])); ?></div>
                </div>
            </div>
            
            <div class="profile-card">
                <h3>Edit Profile</h3>
                
                <?php if ($successMessage): ?>
                    <div class="alert alert-success"><?php echo $successMessage; ?></div>
                <?php endif; ?>
                
                <?php if ($errorMessage): ?>
                    <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
                <?php endif; ?>
                
                <form method="post" action="">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($userData['name']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>" required>
                    </div>
                    
                    <h4 class="mt-4 mb-3">Change Password (optional)</h4>
                    
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password">
                        <small class="text-muted">Leave blank if you don't want to change your password</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password">
                    </div>
                    
                    <div class="form-group">
                        <label for="confirm_password">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                    </div>
                    
                    <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>
                </form>
            </div>
        </div>
    </main>
    
    <?php include 'includes/footer.php'; ?>
</body>
</html> 