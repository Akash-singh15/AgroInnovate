    </main>
    <footer class="site-footer mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <h5 class="footer-heading" data-en="About AgroInnovate" data-hi="एग्रोइनोवेट के बारे में">
                        <?php echo ($_SESSION['language'] == 'en') ? 'About AgroInnovate' : 'एग्रोइनोवेट के बारे में'; ?>
                    </h5>
                    <p data-en="AgroInnovate is dedicated to empowering Indian farmers with technology, information, and community support." data-hi="एग्रोइनोवेट भारतीय किसानों को प्रौद्योगिकी, जानकारी और सामुदायिक समर्थन के साथ सशक्त बनाने के लिए समर्पित है।">
                        <?php echo ($_SESSION['language'] == 'en') ? 'AgroInnovate is dedicated to empowering Indian farmers with technology, information, and community support.' : 'एग्रोइनोवेट भारतीय किसानों को प्रौद्योगिकी, जानकारी और सामुदायिक समर्थन के साथ सशक्त बनाने के लिए समर्पित है।'; ?>
                    </p>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5 class="footer-heading" data-en="Quick Links" data-hi="त्वरित लिंक">
                        <?php echo ($_SESSION['language'] == 'en') ? 'Quick Links' : 'त्वरित लिंक'; ?>
                    </h5>
                    <ul class="list-unstyled">
                        <li><a href="/" data-en="Home" data-hi="होम">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Home' : 'होम'; ?>
                        </a></li>
                        <li><a href="/weather.php" data-en="Weather" data-hi="मौसम">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Weather' : 'मौसम'; ?>
                        </a></li>
                        <li><a href="/market.php" data-en="Market" data-hi="बाज़ार">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Market' : 'बाज़ार'; ?>
                        </a></li>
                        <li><a href="/education.php" data-en="Education" data-hi="शिक्षा">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Education' : 'शिक्षा'; ?>
                        </a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
                    <h5 class="footer-heading" data-en="Resources" data-hi="संसाधन">
                        <?php echo ($_SESSION['language'] == 'en') ? 'Resources' : 'संसाधन'; ?>
                    </h5>
                    <ul class="list-unstyled">
                        <li><a href="/community.php" data-en="Community" data-hi="समुदाय">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Community' : 'समुदाय'; ?>
                        </a></li>
                        <li><a href="/about.php" data-en="About Us" data-hi="हमारे बारे में">
                            <?php echo ($_SESSION['language'] == 'en') ? 'About Us' : 'हमारे बारे में'; ?>
                        </a></li>
                        <li><a href="/contact.php" data-en="Contact" data-hi="संपर्क">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Contact' : 'संपर्क'; ?>
                        </a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                    <h5 class="footer-heading" data-en="Connect With Us" data-hi="हमसे जुड़ें">
                        <?php echo ($_SESSION['language'] == 'en') ? 'Connect With Us' : 'हमसे जुड़ें'; ?>
                    </h5>
                    <div class="social-icons">
                        <a href="#" aria-label="Facebook"><i data-feather="facebook"></i></a>
                        <a href="#" aria-label="Twitter"><i data-feather="twitter"></i></a>
                        <a href="#" aria-label="Instagram"><i data-feather="instagram"></i></a>
                        <a href="#" aria-label="YouTube"><i data-feather="youtube"></i></a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <p class="copyright" data-en="&copy; 2025 AgroInnovate. All rights reserved." data-hi="&copy; 2025 एग्रोइनोवेट. सर्वाधिकार सुरक्षित।">
                        <?php echo ($_SESSION['language'] == 'en') ? '&copy; 2025 AgroInnovate. All rights reserved.' : '&copy; 2025 एग्रोइनोवेट. सर्वाधिकार सुरक्षित।'; ?>
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="footer-link me-3">Privacy Policy</a>
                    <a href="#" class="footer-link">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/js/main.js"></script>
    <script src="/js/language.js"></script>
    
    <script>
        // Initialize Feather icons
        feather.replace();
    </script>
</body>
</html>
