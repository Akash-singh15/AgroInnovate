<?php
// Include header
include_once 'includes/header.php';
?>

<!-- Page Header -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <h1 data-en="Weather Forecasts" data-hi="मौसम पूर्वानुमान">
            <?php echo ($_SESSION['language'] == 'en') ? 'Weather Forecasts' : 'मौसम पूर्वानुमान'; ?>
        </h1>
        <p class="lead" data-en="Real-time weather data to help you plan your farming activities" data-hi="आपकी कृषि गतिविधियों की योजना बनाने में मदद के लिए वास्तविक समय के मौसम डेटा">
            <?php echo ($_SESSION['language'] == 'en') ? 'Real-time weather data to help you plan your farming activities' : 'आपकी कृषि गतिविधियों की योजना बनाने में मदद के लिए वास्तविक समय के मौसम डेटा'; ?>
        </p>
    </div>
</section>

<!-- Weather Search Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="card-title" data-en="Find Weather for Your Location" data-hi="अपने स्थान के लिए मौसम खोजें">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Find Weather for Your Location' : 'अपने स्थान के लिए मौसम खोजें'; ?>
                        </h3>
                        <div class="weather-search">
                            <form id="weather-search-form" class="weather-search-form">
                                <div class="input-group">
                                    <input type="text" id="weather-location" class="form-control" 
                                        placeholder="<?php echo ($_SESSION['language'] == 'en') ? 'Enter your city or village name' : 'अपने शहर या गांव का नाम दर्ज करें'; ?>" 
                                        aria-label="Location" value="Delhi" required>
                                    <button type="submit" class="btn btn-primary">
                                        <i data-feather="search"></i>
                                        <span data-en="Search" data-hi="खोजें">
                                            <?php echo ($_SESSION['language'] == 'en') ? 'Search' : 'खोजें'; ?>
                                        </span>
                                    </button>
                                </div>
                                <small class="form-text text-muted" data-en="Examples: Mumbai, Delhi, Chennai, Kolkata, Bangalore" data-hi="उदाहरण: मुंबई, दिल्ली, चेन्नई, कोलकाता, बैंगलोर">
                                    <?php echo ($_SESSION['language'] == 'en') ? 'Examples: Mumbai, Delhi, Chennai, Kolkata, Bangalore' : 'उदाहरण: मुंबई, दिल्ली, चेन्नई, कोलकाता, बैंगलोर'; ?>
                                </small>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Current Weather Section -->
<section class="py-3">
    <div class="container">
        <h2 class="mb-4" data-en="Current Weather" data-hi="वर्तमान मौसम">
            <?php echo ($_SESSION['language'] == 'en') ? 'Current Weather' : 'वर्तमान मौसम'; ?>
        </h2>
        <div class="row">
            <div class="col-lg-8">
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
                <div id="weather-tips" class="mt-4">
                    <!-- Weather-based farming tips will be loaded here -->
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0" data-en="Weather Impact on Farming" data-hi="कृषि पर मौसम का प्रभाव">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Weather Impact on Farming' : 'कृषि पर मौसम का प्रभाव'; ?>
                        </h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <strong data-en="Rainfall:" data-hi="वर्षा:">
                                    <?php echo ($_SESSION['language'] == 'en') ? 'Rainfall:' : 'वर्षा:'; ?>
                                </strong>
                                <span data-en="Impacts irrigation needs and potential for water-related crop diseases." data-hi="सिंचाई की आवश्यकताओं और पानी से संबंधित फसल रोगों की संभावना को प्रभावित करता है।">
                                    <?php echo ($_SESSION['language'] == 'en') ? 'Impacts irrigation needs and potential for water-related crop diseases.' : 'सिंचाई की आवश्यकताओं और पानी से संबंधित फसल रोगों की संभावना को प्रभावित करता है।'; ?>
                                </span>
                            </li>
                            <li class="list-group-item">
                                <strong data-en="Temperature:" data-hi="तापमान:">
                                    <?php echo ($_SESSION['language'] == 'en') ? 'Temperature:' : 'तापमान:'; ?>
                                </strong>
                                <span data-en="Affects plant growth, flowering, and fruiting patterns." data-hi="पौधों के विकास, फूलों, और फलने के पैटर्न को प्रभावित करता है।">
                                    <?php echo ($_SESSION['language'] == 'en') ? 'Affects plant growth, flowering, and fruiting patterns.' : 'पौधों के विकास, फूलों, और फलने के पैटर्न को प्रभावित करता है।'; ?>
                                </span>
                            </li>
                            <li class="list-group-item">
                                <strong data-en="Humidity:" data-hi="आर्द्रता:">
                                    <?php echo ($_SESSION['language'] == 'en') ? 'Humidity:' : 'आर्द्रता:'; ?>
                                </strong>
                                <span data-en="Influences disease prevalence and pollination effectiveness." data-hi="रोग की व्यापकता और परागण प्रभावशीलता को प्रभावित करता है।">
                                    <?php echo ($_SESSION['language'] == 'en') ? 'Influences disease prevalence and pollination effectiveness.' : 'रोग की व्यापकता और परागण प्रभावशीलता को प्रभावित करता है।'; ?>
                                </span>
                            </li>
                            <li class="list-group-item">
                                <strong data-en="Wind:" data-hi="हवा:">
                                    <?php echo ($_SESSION['language'] == 'en') ? 'Wind:' : 'हवा:'; ?>
                                </strong>
                                <span data-en="Can cause physical damage or assist in pollination and seed dispersal." data-hi="भौतिक क्षति का कारण बन सकती है या परागण और बीज प्रसार में सहायता कर सकती है।">
                                    <?php echo ($_SESSION['language'] == 'en') ? 'Can cause physical damage or assist in pollination and seed dispersal.' : 'भौतिक क्षति का कारण बन सकती है या परागण और बीज प्रसार में सहायता कर सकती है।'; ?>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Forecast Section -->
<section class="py-3">
    <div class="container">
        <h2 class="mb-4" data-en="5-Day Forecast" data-hi="5-दिन का पूर्वानुमान">
            <?php echo ($_SESSION['language'] == 'en') ? '5-Day Forecast' : '5-दिन का पूर्वानुमान'; ?>
        </h2>
        <div id="forecast-data">
            <!-- Forecast data will be loaded here via JavaScript -->
            <div class="text-center my-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2" data-en="Loading forecast data..." data-hi="पूर्वानुमान डेटा लोड हो रहा है...">
                    <?php echo ($_SESSION['language'] == 'en') ? 'Loading forecast data...' : 'पूर्वानुमान डेटा लोड हो रहा है...'; ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Weather Planning Tools -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="section-title">
            <h2 data-en="Weather-Based Planning Tools" data-hi="मौसम-आधारित योजना उपकरण">
                <?php echo ($_SESSION['language'] == 'en') ? 'Weather-Based Planning Tools' : 'मौसम-आधारित योजना उपकरण'; ?>
            </h2>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="card-title h5">
                            <i data-feather="droplet" class="me-2 text-primary"></i>
                            <span data-en="Irrigation Planner" data-hi="सिंचाई योजनाकार">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Irrigation Planner' : 'सिंचाई योजनाकार'; ?>
                            </span>
                        </h3>
                        <p class="card-text" data-en="Plan your irrigation schedule based on upcoming rainfall and evaporation predictions to optimize water usage." data-hi="आगामी वर्षा और वाष्पीकरण भविष्यवाणियों के आधार पर पानी के उपयोग को अनुकूलित करने के लिए अपनी सिंचाई अनुसूची की योजना बनाएं।">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Plan your irrigation schedule based on upcoming rainfall and evaporation predictions to optimize water usage.' : 'आगामी वर्षा और वाष्पीकरण भविष्यवाणियों के आधार पर पानी के उपयोग को अनुकूलित करने के लिए अपनी सिंचाई अनुसूची की योजना बनाएं।'; ?>
                        </p>
                        <a href="#" class="btn btn-outline-primary" data-en="Coming Soon" data-hi="जल्द आ रहा है">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Coming Soon' : 'जल्द आ रहा है'; ?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="card-title h5">
                            <i data-feather="calendar" class="me-2 text-primary"></i>
                            <span data-en="Crop Calendar" data-hi="फसल कैलेंडर">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Crop Calendar' : 'फसल कैलेंडर'; ?>
                            </span>
                        </h3>
                        <p class="card-text" data-en="Get personalized planting and harvesting dates based on local weather patterns and crop-specific requirements." data-hi="स्थानीय मौसम पैटर्न और फसल-विशिष्ट आवश्यकताओं के आधार पर व्यक्तिगत रोपण और कटाई की तारीखें प्राप्त करें।">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Get personalized planting and harvesting dates based on local weather patterns and crop-specific requirements.' : 'स्थानीय मौसम पैटर्न और फसल-विशिष्ट आवश्यकताओं के आधार पर व्यक्तिगत रोपण और कटाई की तारीखें प्राप्त करें।'; ?>
                        </p>
                        <a href="#" class="btn btn-outline-primary" data-en="Coming Soon" data-hi="जल्द आ रहा है">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Coming Soon' : 'जल्द आ रहा है'; ?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="card-title h5">
                            <i data-feather="alert-triangle" class="me-2 text-primary"></i>
                            <span data-en="Severe Weather Alerts" data-hi="गंभीर मौसम अलर्ट">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Severe Weather Alerts' : 'गंभीर मौसम अलर्ट'; ?>
                            </span>
                        </h3>
                        <p class="card-text" data-en="Receive timely notifications about potentially damaging weather events to protect your crops and livestock." data-hi="अपनी फसलों और पशुधन की रक्षा के लिए संभावित रूप से नुकसान पहुंचाने वाली मौसमी घटनाओं के बारे में समय पर सूचनाएं प्राप्त करें।">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Receive timely notifications about potentially damaging weather events to protect your crops and livestock.' : 'अपनी फसलों और पशुधन की रक्षा के लिए संभावित रूप से नुकसान पहुंचाने वाली मौसमी घटनाओं के बारे में समय पर सूचनाएं प्राप्त करें।'; ?>
                        </p>
                        <a href="#" class="btn btn-outline-primary" data-en="Coming Soon" data-hi="जल्द आ रहा है">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Coming Soon' : 'जल्द आ रहा है'; ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Weather FAQ Section -->
<section class="py-5">
    <div class="container">
        <div class="section-title">
            <h2 data-en="Weather FAQs" data-hi="मौसम के बारे में अक्सर पूछे जाने वाले प्रश्न">
                <?php echo ($_SESSION['language'] == 'en') ? 'Weather FAQs' : 'मौसम के बारे में अक्सर पूछे जाने वाले प्रश्न'; ?>
            </h2>
        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="accordion" id="weatherFAQ">
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" data-en="How accurate is the weather forecast?" data-hi="मौसम का पूर्वानुमान कितना सटीक है?">
                                <?php echo ($_SESSION['language'] == 'en') ? 'How accurate is the weather forecast?' : 'मौसम का पूर्वानुमान कितना सटीक है?'; ?>
                            </button>
                        </h3>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#weatherFAQ">
                            <div class="accordion-body" data-en="Our weather forecasts are sourced from OpenWeatherMap, which provides reliable data with approximately 80-85% accuracy for the current day and 70-75% accuracy for the 5-day forecast. Weather forecasting becomes less accurate the further into the future it predicts." data-hi="हमारे मौसम पूर्वानुमान OpenWeatherMap से प्राप्त होते हैं, जो वर्तमान दिन के लिए लगभग 80-85% सटीकता और 5-दिवसीय पूर्वानुमान के लिए 70-75% सटीकता के साथ विश्वसनीय डेटा प्रदान करता है। मौसम पूर्वानुमान भविष्य में जितना अधिक भविष्यवाणी करता है, उतना कम सटीक हो जाता है।">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Our weather forecasts are sourced from OpenWeatherMap, which provides reliable data with approximately 80-85% accuracy for the current day and 70-75% accuracy for the 5-day forecast. Weather forecasting becomes less accurate the further into the future it predicts.' : 'हमारे मौसम पूर्वानुमान OpenWeatherMap से प्राप्त होते हैं, जो वर्तमान दिन के लिए लगभग 80-85% सटीकता और 5-दिवसीय पूर्वानुमान के लिए 70-75% सटीकता के साथ विश्वसनीय डेटा प्रदान करता है। मौसम पूर्वानुमान भविष्य में जितना अधिक भविष्यवाणी करता है, उतना कम सटीक हो जाता है।'; ?>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" data-en="How should I use weather data for farming decisions?" data-hi="कृषि निर्णयों के लिए मैं मौसम डेटा का उपयोग कैसे करूं?">
                                <?php echo ($_SESSION['language'] == 'en') ? 'How should I use weather data for farming decisions?' : 'कृषि निर्णयों के लिए मैं मौसम डेटा का उपयोग कैसे करूं?'; ?>
                            </button>
                        </h3>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#weatherFAQ">
                            <div class="accordion-body" data-en="Weather data can inform many farming decisions. Use current forecasts for short-term activities like spraying, irrigation, and harvesting. For planting and longer-term decisions, combine our forecasts with seasonal trends. Always have contingency plans ready, as weather can change unpredictably." data-hi="मौसम डेटा कई कृषि निर्णयों को सूचित कर सकता है। छिड़काव, सिंचाई और कटाई जैसी अल्पकालिक गतिविधियों के लिए वर्तमान पूर्वानुमानों का उपयोग करें। रोपण और लंबी अवधि के निर्णयों के लिए, हमारे पूर्वानुमानों को मौसमी रुझानों के साथ जोड़ें। हमेशा आकस्मिक योजनाएँ तैयार रखें, क्योंकि मौसम अप्रत्याशित रूप से बदल सकता है।">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Weather data can inform many farming decisions. Use current forecasts for short-term activities like spraying, irrigation, and harvesting. For planting and longer-term decisions, combine our forecasts with seasonal trends. Always have contingency plans ready, as weather can change unpredictably.' : 'मौसम डेटा कई कृषि निर्णयों को सूचित कर सकता है। छिड़काव, सिंचाई और कटाई जैसी अल्पकालिक गतिविधियों के लिए वर्तमान पूर्वानुमानों का उपयोग करें। रोपण और लंबी अवधि के निर्णयों के लिए, हमारे पूर्वानुमानों को मौसमी रुझानों के साथ जोड़ें। हमेशा आकस्मिक योजनाएँ तैयार रखें, क्योंकि मौसम अप्रत्याशित रूप से बदल सकता है।'; ?>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" data-en="Why can't I find my exact village location?" data-hi="मैं अपने सटीक गांव का स्थान क्यों नहीं ढूंढ सकता?">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Why can\'t I find my exact village location?' : 'मैं अपने सटीक गांव का स्थान क्यों नहीं ढूंढ सकता?'; ?>
                            </button>
                        </h3>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#weatherFAQ">
                            <div class="accordion-body" data-en="Our weather service covers most cities and larger towns across India. If your exact village isn't found, try searching for the nearest larger town. The weather conditions will generally be similar for locations within 10-15 kilometers of each other unless there are significant geographical features like mountains between them." data-hi="हमारी मौसम सेवा भारत भर के अधिकांश शहरों और बड़े कस्बों को कवर करती है। यदि आपका सटीक गांव नहीं मिलता है, तो निकटतम बड़े कस्बे को खोजने का प्रयास करें। मौसम की स्थिति आम तौर पर एक-दूसरे से 10-15 किलोमीटर के भीतर के स्थानों के लिए समान होगी, जब तक कि उनके बीच पहाड़ों जैसी महत्वपूर्ण भौगोलिक विशेषताएं न हों।">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Our weather service covers most cities and larger towns across India. If your exact village isn\'t found, try searching for the nearest larger town. The weather conditions will generally be similar for locations within 10-15 kilometers of each other unless there are significant geographical features like mountains between them.' : 'हमारी मौसम सेवा भारत भर के अधिकांश शहरों और बड़े कस्बों को कवर करती है। यदि आपका सटीक गांव नहीं मिलता है, तो निकटतम बड़े कस्बे को खोजने का प्रयास करें। मौसम की स्थिति आम तौर पर एक-दूसरे से 10-15 किलोमीटर के भीतर के स्थानों के लिए समान होगी, जब तक कि उनके बीच पहाड़ों जैसी महत्वपूर्ण भौगोलिक विशेषताएं न हों।'; ?>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h3 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour" data-en="How can I receive weather alerts?" data-hi="मैं मौसम अलर्ट कैसे प्राप्त कर सकता हूं?">
                                <?php echo ($_SESSION['language'] == 'en') ? 'How can I receive weather alerts?' : 'मैं मौसम अलर्ट कैसे प्राप्त कर सकता हूं?'; ?>
                            </button>
                        </h3>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#weatherFAQ">
                            <div class="accordion-body" data-en="We're currently developing a weather alert system that will send notifications for extreme weather events like heavy rainfall, storms, and heatwaves. This feature will be launched soon. In the meantime, we recommend checking our forecasts regularly during critical growing periods." data-hi="हम वर्तमान में एक मौसम अलर्ट सिस्टम विकसित कर रहे हैं जो भारी वर्षा, तूफान और गर्मी की लहरों जैसी चरम मौसम की घटनाओं के लिए सूचनाएं भेजेगा। यह सुविधा जल्द ही लॉन्च की जाएगी। इस बीच, हम महत्वपूर्ण उगाने की अवधि के दौरान नियमित रूप से हमारे पूर्वानुमानों की जांच करने की सलाह देते हैं।">
                                <?php echo ($_SESSION['language'] == 'en') ? 'We\'re currently developing a weather alert system that will send notifications for extreme weather events like heavy rainfall, storms, and heatwaves. This feature will be launched soon. In the meantime, we recommend checking our forecasts regularly during critical growing periods.' : 'हम वर्तमान में एक मौसम अलर्ट सिस्टम विकसित कर रहे हैं जो भारी वर्षा, तूफान और गर्मी की लहरों जैसी चरम मौसम की घटनाओं के लिए सूचनाएं भेजेगा। यह सुविधा जल्द ही लॉन्च की जाएगी। इस बीच, हम महत्वपूर्ण उगाने की अवधि के दौरान नियमित रूप से हमारे पूर्वानुमानों की जांच करने की सलाह देते हैं।'; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Load Weather JavaScript -->
<script src="/js/weather.js"></script>

<?php
// Include footer
include_once 'includes/footer.php';
?>
