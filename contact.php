<?php
require_once 'includes/session.php';
require_once 'includes/functions.php';

// Initialize variables
$successMessage = '';
$errorMessage = '';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = sanitizeInput($_POST['name']);
    $email = sanitizeInput($_POST['email']);
    $subject = sanitizeInput($_POST['subject'] ?? 'Contact Form Submission');
    $message = sanitizeInput($_POST['message']);
    
    // Validate inputs
    if (empty($name) || empty($email) || empty($message)) {
        $errorMessage = ($_SESSION['language'] == 'en') ? 'All fields are required.' : 'सभी फ़ील्ड आवश्यक हैं।';
    } elseif (!isValidEmail($email)) {
        $errorMessage = ($_SESSION['language'] == 'en') ? 'Please enter a valid email address.' : 'कृपया एक वैध ईमेल पता दर्ज करें।';
    } else {
        // Save submission to database
        $formData = [
            'name' => $name,
            'email' => $email,
            'subject' => $subject,
            'message' => $message,
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $saved = saveContactSubmission($formData);
        
        if ($saved) {
            // Send email notification to admin
            $adminEmail = 'akashjasrotia2005@gmail.com'; // Replace with actual admin email
            $emailSubject = "New Contact Form Submission: $subject";
            $emailMessage = "New contact form submission received:\n\n";
            $emailMessage .= "Name: $name\n";
            $emailMessage .= "Email: $email\n";
            $emailMessage .= "Subject: $subject\n\n";
            $emailMessage .= "Message:\n$message\n\n";
            $emailMessage .= "Sent on: " . date('Y-m-d H:i:s');
            
            $headers = 'From: ' . $email . "\r\n" .
                       'Reply-To: ' . $email . "\r\n" .
                       'X-Mailer: PHP/' . phpversion();
            
            // Send the email
            $emailSent = mail($adminEmail, $emailSubject, $emailMessage, $headers);
            
            if ($emailSent) {
                $successMessage = ($_SESSION['language'] == 'en') ? 'Thank you for your message. We will get back to you soon!' : 'आपके संदेश के लिए धन्यवाद। हम जल्द ही आपसे संपर्क करेंगे!';
            } else {
                $errorMessage = ($_SESSION['language'] == 'en') ? 'There was an issue sending your message. Please try again later.' : 'आपका संदेश भेजने में समस्या हुई। कृपया बाद में पुन: प्रयास करें।';
            }
        } else {
            $errorMessage = ($_SESSION['language'] == 'en') ? 'There was an error saving your message. Please try again later.' : 'आपका संदेश सहेजने में एक त्रुटि हुई। कृपया बाद में पुन: प्रयास करें।';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['language']; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - AgroInnovate</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    
    <main>
        <section class="contact-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="contact-info">
                            <h2 data-en="Contact Us" data-hi="संपर्क करें">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Contact Us' : 'संपर्क करें'; ?>
                            </h2>
                            <p data-en="Have questions or suggestions? Get in touch with us." data-hi="सवाल या सुझाव हैं? हमसे संपर्क करें।">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Have questions or suggestions? Get in touch with us.' : 'सवाल या सुझाव हैं? हमसे संपर्क करें।'; ?>
                            </p>
                            
                            <div class="contact-item">
                                <i data-feather="mail"></i>
                                <div class="contact-text">
                                    <h4>Email</h4>
                                    <p>akashjasrotia2005@gmail.com</p>
                                </div>
                            </div>
                            
                            <div class="contact-item">
                                <i data-feather="phone"></i>
                                <div class="contact-text">
                                    <h4 data-en="Phone" data-hi="फ़ोन">
                                        <?php echo ($_SESSION['language'] == 'en') ? 'Phone' : 'फ़ोन'; ?>
                                    </h4>
                                    <p>+91 7087792964</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <?php if ($successMessage): ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $successMessage; ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($errorMessage): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $errorMessage; ?>
                            </div>
                        <?php endif; ?>
                        
                        <form id="contact-form" class="contact-form" method="post" action="">
                            <h3 data-en="Send us a Message" data-hi="हमें संदेश भेजें">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Send us a Message' : 'हमें संदेश भेजें'; ?>
                            </h3>
                            
                            <div class="form-group">
                                <label for="name" data-en="Your Name" data-hi="आपका नाम">
                                    <?php echo ($_SESSION['language'] == 'en') ? 'Your Name' : 'आपका नाम'; ?>
                                </label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="email" data-en="Email Address" data-hi="ईमेल पता">
                                    <?php echo ($_SESSION['language'] == 'en') ? 'Email Address' : 'ईमेल पता'; ?>
                                </label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="subject" data-en="Subject" data-hi="विषय">
                                    <?php echo ($_SESSION['language'] == 'en') ? 'Subject' : 'विषय'; ?>
                                </label>
                                <input type="text" class="form-control" id="subject" name="subject">
                            </div>
                            
                            <div class="form-group">
                                <label for="message" data-en="Message" data-hi="संदेश">
                                    <?php echo ($_SESSION['language'] == 'en') ? 'Message' : 'संदेश'; ?>
                                </label>
                                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary" data-en="Send Message" data-hi="संदेश भेजें">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Send Message' : 'संदेश भेजें'; ?>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <?php include 'includes/footer.php'; ?>
    <script src="/js/main.js"></script>
    <script src="/js/language.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        // Initialize Feather icons
        if (typeof feather !== 'undefined') {
            feather.replace();
        }
    </script>
</body>
</html>
