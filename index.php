<?php
// Include required files
include_once 'includes/header.php';
include_once 'includes/functions.php';
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 hero-content">
                <h1 class="hero-title" data-en="Empowering Indian Farmers" data-hi="भारतीय किसानों को सशक्त बनाना">
                    <?php echo ($_SESSION['language'] == 'en') ? 'Empowering Indian Farmers' : 'भारतीय किसानों को सशक्त बनाना'; ?>
                </h1>
                <p class="hero-subtitle" data-en="Real-time weather updates, market information, and agricultural education at your fingertips." data-hi="वास्तविक समय के मौसम अपडेट, बाजार की जानकारी, और कृषि शिक्षा आपकी उंगलियों पर।">
                    <?php echo ($_SESSION['language'] == 'en') ? 'Real-time weather updates, market information, and agricultural education at your fingertips.' : 'वास्तविक समय के मौसम अपडेट, बाजार की जानकारी, और कृषि शिक्षा आपकी उंगलियों पर।'; ?>
                </p>
                <a href="/weather.php" class="hero-cta" data-en="Check Today's Weather" data-hi="आज का मौसम देखें">
                    <?php echo ($_SESSION['language'] == 'en') ? 'Check Today\'s Weather' : 'आज का मौसम देखें'; ?>
                </a>
            </div>
            <div class="col-md-6 hero-image">
                <img src="/assets/hero-banner.svg" alt="Indian farmer with modern technology" class="img-fluid">
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section">
    <div class="container">
        <div class="section-title">
            <h2 data-en="Our Features" data-hi="हमारी विशेषताएं">
                <?php echo ($_SESSION['language'] == 'en') ? 'Our Features' : 'हमारी विशेषताएं'; ?>
            </h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="feature-box">
                    <div class="feature-icon">
                        <i data-feather="cloud"></i>
                    </div>
                    <h3 class="feature-title" data-en="Weather Forecasts" data-hi="मौसम पूर्वानुमान">
                        <?php echo ($_SESSION['language'] == 'en') ? 'Weather Forecasts' : 'मौसम पूर्वानुमान'; ?>
                    </h3>
                    <p class="feature-text" data-en="Get real-time weather updates and 5-day forecasts for your location to plan farming activities effectively." data-hi="अपने स्थान के लिए वास्तविक समय के मौसम अपडेट और 5-दिवसीय पूर्वानुमान प्राप्त करें ताकि कृषि गतिविधियों की योजना प्रभावी ढंग से बनाई जा सके।">
                        <?php echo ($_SESSION['language'] == 'en') ? 'Get real-time weather updates and 5-day forecasts for your location to plan farming activities effectively.' : 'अपने स्थान के लिए वास्तविक समय के मौसम अपडेट और 5-दिवसीय पूर्वानुमान प्राप्त करें ताकि कृषि गतिविधियों की योजना प्रभावी ढंग से बनाई जा सके।'; ?>
                    </p>
                    <a href="/weather.php" class="mt-3 d-inline-block" data-en="Learn More" data-hi="अधिक जानें">
                        <?php echo ($_SESSION['language'] == 'en') ? 'Learn More' : 'अधिक जानें'; ?> →
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box">
                    <div class="feature-icon">
                        <i data-feather="trending-up"></i>
                    </div>
                    <h3 class="feature-title" data-en="Market Prices" data-hi="बाजार मूल्य">
                        <?php echo ($_SESSION['language'] == 'en') ? 'Market Prices' : 'बाजार मूल्य'; ?>
                    </h3>
                    <p class="feature-text" data-en="Stay updated with current crop prices and historical trends to maximize your profits in the market." data-hi="बाजार में अपने लाभ को अधिकतम करने के लिए वर्तमान फसल मूल्यों और ऐतिहासिक रुझानों के साथ अपडेट रहें।">
                        <?php echo ($_SESSION['language'] == 'en') ? 'Stay updated with current crop prices and historical trends to maximize your profits in the market.' : 'बाजार में अपने लाभ को अधिकतम करने के लिए वर्तमान फसल मूल्यों और ऐतिहासिक रुझानों के साथ अपडेट रहें।'; ?>
                    </p>
                    <a href="/market.php" class="mt-3 d-inline-block" data-en="Learn More" data-hi="अधिक जानें">
                        <?php echo ($_SESSION['language'] == 'en') ? 'Learn More' : 'अधिक जानें'; ?> →
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box">
                    <div class="feature-icon">
                        <i data-feather="book-open"></i>
                    </div>
                    <h3 class="feature-title" data-en="Educational Resources" data-hi="शैक्षिक संसाधन">
                        <?php echo ($_SESSION['language'] == 'en') ? 'Educational Resources' : 'शैक्षिक संसाधन'; ?>
                    </h3>
                    <p class="feature-text" data-en="Access farming best practices, crop management techniques, and modern agricultural methods." data-hi="कृषि की सर्वोत्तम प्रथाओं, फसल प्रबंधन तकनीकों और आधुनिक कृषि विधियों तक पहुंच प्राप्त करें।">
                        <?php echo ($_SESSION['language'] == 'en') ? 'Access farming best practices, crop management techniques, and modern agricultural methods.' : 'कृषि की सर्वोत्तम प्रथाओं, फसल प्रबंधन तकनीकों और आधुनिक कृषि विधियों तक पहुंच प्राप्त करें।'; ?>
                    </p>
                    <a href="/education.php" class="mt-3 d-inline-block" data-en="Learn More" data-hi="अधिक जानें">
                        <?php echo ($_SESSION['language'] == 'en') ? 'Learn More' : 'अधिक जानें'; ?> →
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Weather Section -->
<section class="weather-section">
    <div class="container">
        <div class="section-title">
            <h2 data-en="Current Weather" data-hi="वर्तमान मौसम">
                <?php echo ($_SESSION['language'] == 'en') ? 'Current Weather' : 'वर्तमान मौसम'; ?>
            </h2>
        </div>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="weather-search">
                    <form id="weather-search-form" class="weather-search-form">
                        <input type="text" id="weather-location" class="weather-search-input" placeholder="<?php echo ($_SESSION['language'] == 'en') ? 'Enter your location' : 'अपना स्थान दर्ज करें'; ?>" value="Delhi">
                        <button type="submit" class="weather-search-btn">
                            <i data-feather="search"></i>
                            <span data-en="Search" data-hi="खोजें">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Search' : 'खोजें'; ?>
                            </span>
                        </button>
                    </form>
                </div>
                <div id="weather-data">
                    <!-- Weather data will be loaded here via JavaScript -->
                    <div class="text-center my-5">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2" data-en="Loading weather data..." data-hi="मौसम डेटा लोड हो रहा है...">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Loading weather data...' : 'मौसम डेटा लोड हो रहा है...'; ?>
                        </p>
                    </div>
                </div>
                <div id="weather-tips">
                    <!-- Weather-based farming tips will be loaded here -->
                </div>
                <div class="text-center mt-4">
                    <a href="/weather.php" class="btn btn-primary" data-en="Detailed Weather Forecast" data-hi="विस्तृत मौसम पूर्वानुमान">
                        <?php echo ($_SESSION['language'] == 'en') ? 'Detailed Weather Forecast' : 'विस्तृत मौसम पूर्वानुमान'; ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Market Section -->
<section class="market-section">
    <div class="container">
        <div class="section-title">
            <h2 data-en="Market Prices" data-hi="बाजार मूल्य">
                <?php echo ($_SESSION['language'] == 'en') ? 'Market Prices' : 'बाजार मूल्य'; ?>
            </h2>
        </div>
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="table-responsive">
                    <table class="market-table">
                        <thead>
                            <tr>
                                <th data-en="Crop" data-hi="फसल">
                                    <?php echo ($_SESSION['language'] == 'en') ? 'Crop' : 'फसल'; ?>
                                </th>
                                <th data-en="Price" data-hi="मूल्य">
                                    <?php echo ($_SESSION['language'] == 'en') ? 'Price' : 'मूल्य'; ?>
                                </th>
                                <th data-en="Change" data-hi="बदलाव">
                                    <?php echo ($_SESSION['language'] == 'en') ? 'Change' : 'बदलाव'; ?>
                                </th>
                                <th data-en="History" data-hi="इतिहास">
                                    <?php echo ($_SESSION['language'] == 'en') ? 'History' : 'इतिहास'; ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="market-prices-table">
                            <!-- Market prices will be loaded here via JavaScript -->
                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <p class="mt-2" data-en="Loading market prices..." data-hi="बाजार मूल्य लोड हो रहे हैं...">
                                        <?php echo ($_SESSION['language'] == 'en') ? 'Loading market prices...' : 'बाजार मूल्य लोड हो रहे हैं...'; ?>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-4">
                    <a href="/market.php" class="btn btn-primary" data-en="View All Market Data" data-hi="सभी बाजार डेटा देखें">
                        <?php echo ($_SESSION['language'] == 'en') ? 'View All Market Data' : 'सभी बाजार डेटा देखें'; ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Farmer Stories Section -->
<section class="stories-section">
    <div class="container">
        <div class="section-title">
            <h2 data-en="Farmer Success Stories" data-hi="किसान सफलता की कहानियां">
                <?php echo ($_SESSION['language'] == 'en') ? 'Farmer Success Stories' : 'किसान सफलता की कहानियां'; ?>
            </h2>
        </div>
        <div class="row">
            <?php
            // Get farmer stories
            $stories = getFarmerStories(3);
            
            foreach ($stories as $story) {
                echo '<div class="col-md-4">';
                echo '<div class="story-card">';
                echo '<div class="story-header">';
                echo '<div class="story-avatar">';
                echo '<img src="/assets/' . $story['image'] . '" alt="' . $story['name'] . '" class="img-fluid">';
                echo '</div>';
                echo '<div class="story-meta">';
                echo '<h4 class="story-name">' . $story['name'] . '</h4>';
                echo '<div class="story-location">' . $story['location'] . '</div>';
                echo '<div class="story-crop">' . $story['crop'] . '</div>';
                echo '</div>';
                echo '</div>';
                echo '<div class="story-quote">' . $story['quote'] . '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
        <div class="text-center mt-4">
            <a href="/community.php" class="btn btn-primary" data-en="More Success Stories" data-hi="अधिक सफलता की कहानियां">
                <?php echo ($_SESSION['language'] == 'en') ? 'More Success Stories' : 'अधिक सफलता की कहानियां'; ?>
            </a>
        </div>
    </div>
</section>

<!-- Community Call-to-Action -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h2 data-en="Join Our Farming Community" data-hi="हमारे कृषि समुदाय में शामिल हों">
                    <?php echo ($_SESSION['language'] == 'en') ? 'Join Our Farming Community' : 'हमारे कृषि समुदाय में शामिल हों'; ?>
                </h2>
                <p class="lead" data-en="Connect with fellow farmers, share experiences, and learn together." data-hi="साथी किसानों से जुड़ें, अनुभव साझा करें, और एक साथ सीखें।">
                    <?php echo ($_SESSION['language'] == 'en') ? 'Connect with fellow farmers, share experiences, and learn together.' : 'साथी किसानों से जुड़ें, अनुभव साझा करें, और एक साथ सीखें।'; ?>
                </p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="/community.php" class="btn btn-light btn-lg" data-en="Join Community" data-hi="समुदाय में शामिल हों">
                    <?php echo ($_SESSION['language'] == 'en') ? 'Join Community' : 'समुदाय में शामिल हों'; ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Educational Resources Preview -->
<section class="education-section py-5">
    <div class="container">
        <div class="section-title">
            <h2 data-en="Educational Resources" data-hi="शैक्षिक संसाधन">
                <?php echo ($_SESSION['language'] == 'en') ? 'Educational Resources' : 'शैक्षिक संसाधन'; ?>
            </h2>
        </div>
        <div class="row">
            <?php
            // Get crop management resources
            $resources = getEducationalResources('crop_management');
            
            // Display first 3 resources
            for ($i = 0; $i < min(3, count($resources)); $i++) {
                $resource = $resources[$i];
                echo '<div class="col-md-4">';
                echo '<div class="resource-card">';
                echo '<div class="resource-image">';
                echo '<img src="/assets/' . $resource['image'] . '" alt="' . $resource['title'] . '" class="img-fluid">';
                echo '</div>';
                echo '<div class="resource-content">';
                echo '<h4 class="resource-title">' . $resource['title'] . '</h4>';
                echo '<p class="resource-description">' . $resource['description'] . '</p>';
                echo '<a href="' . $resource['url'] . '" class="resource-link">';
                echo ($_SESSION['language'] == 'en') ? 'Learn More' : 'अधिक जानें';
                echo '</a>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
        <div class="text-center mt-4">
            <a href="/education.php" class="btn btn-primary" data-en="View All Resources" data-hi="सभी संसाधन देखें">
                <?php echo ($_SESSION['language'] == 'en') ? 'View All Resources' : 'सभी संसाधन देखें'; ?>
            </a>
        </div>
    </div>
</section>

<!-- Load Weather JavaScript -->
<script src="/js/weather.js"></script>
<script src="/js/market.js"></script>

<?php
// Include footer
include_once 'includes/footer.php';
?>
