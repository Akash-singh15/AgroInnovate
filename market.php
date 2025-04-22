<?php
// Include header
include_once 'includes/header.php';
?>

<!-- Page Header -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <h1 data-en="Market Prices" data-hi="बाजार मूल्य">
            <?php echo ($_SESSION['language'] == 'en') ? 'Market Prices' : 'बाजार मूल्य'; ?>
        </h1>
        <p class="lead" data-en="Stay updated with current crop prices and market trends" data-hi="वर्तमान फसल मूल्यों और बाजार रुझानों के साथ अपडेट रहें">
            <?php echo ($_SESSION['language'] == 'en') ? 'Stay updated with current crop prices and market trends' : 'वर्तमान फसल मूल्यों और बाजार रुझानों के साथ अपडेट रहें'; ?>
        </p>
    </div>
</section>

<!-- Current Prices Section -->
<section class="py-5">
    <div class="container">
        <div class="section-title">
            <h2 data-en="Current Market Prices" data-hi="वर्तमान बाजार मूल्य">
                <?php echo ($_SESSION['language'] == 'en') ? 'Current Market Prices' : 'वर्तमान बाजार मूल्य'; ?>
            </h2>
        </div>
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card mb-4">
                    <div class="card-body">
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
                                        <th data-en="Details" data-hi="विवरण">
                                            <?php echo ($_SESSION['language'] == 'en') ? 'Details' : 'विवरण'; ?>
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
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <small class="text-muted" data-en="Last updated: Today" data-hi="आखिरी अपडेट: आज">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Last updated: Today' : 'आखिरी अपडेट: आज'; ?>
                            </small>
                            <button class="btn btn-sm btn-outline-primary" id="refresh-prices" data-en="Refresh Prices" data-hi="मूल्य रिफ्रेश करें">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Refresh Prices' : 'मूल्य रिफ्रेश करें'; ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Historical Trends Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="section-title">
            <h2 data-en="Historical Price Trends" data-hi="ऐतिहासिक मूल्य रुझान">
                <?php echo ($_SESSION['language'] == 'en') ? 'Historical Price Trends' : 'ऐतिहासिक मूल्य रुझान'; ?>
            </h2>
        </div>
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="market-crop-selector mb-4">
                            <label for="crop-selector" class="form-label" data-en="Select Crop:" data-hi="फसल चुनें:">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Select Crop:' : 'फसल चुनें:'; ?>
                            </label>
                            <select id="crop-selector" class="form-select">
                                <option value="Rice">Rice</option>
                                <option value="Wheat">Wheat</option>
                                <option value="Cotton">Cotton</option>
                                <option value="Sugarcane">Sugarcane</option>
                                <option value="Maize">Maize</option>
                                <option value="Soybeans">Soybeans</option>
                            </select>
                        </div>
                        <div id="market-chart-container" class="market-chart-container">
                            <!-- Chart will be loaded here via JavaScript -->
                            <div class="text-center my-5">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                                <p class="mt-2" data-en="Loading chart data..." data-hi="चार्ट डेटा लोड हो रहा है...">
                                    <?php echo ($_SESSION['language'] == 'en') ? 'Loading chart data...' : 'चार्ट डेटा लोड हो रहा है...'; ?>
                                </p>
                            </div>
                        </div>
                        <div id="price-analysis">
                            <!-- Price analysis will be loaded here via JavaScript -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Market Insights Section -->
<section class="py-5">
    <div class="container">
        <div class="section-title">
            <h2 data-en="Market Insights" data-hi="बाजार अंतर्दृष्टि">
                <?php echo ($_SESSION['language'] == 'en') ? 'Market Insights' : 'बाजार अंतर्दृष्टि'; ?>
            </h2>
        </div>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="card-title h5" data-en="Best Time to Sell" data-hi="बेचने का सबसे अच्छा समय">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Best Time to Sell' : 'बेचने का सबसे अच्छा समय'; ?>
                        </h3>
                        <p data-en="Knowing when to sell your crops can significantly impact your profits. Our historical data shows that prices for most grain crops typically peak in the months just before new harvests come to market. For perishable crops like vegetables and fruits, prices are highest during off-season periods." data-hi="अपनी फसलों को कब बेचना है, यह जानने से आपके मुनाफे पर महत्वपूर्ण प्रभाव पड़ सकता है। हमारे ऐतिहासिक डेटा से पता चलता है कि अधिकांश अनाज फसलों के लिए कीमतें आमतौर पर नई फसलों के बाजार में आने से ठीक पहले के महीनों में चरम पर होती हैं। सब्जियों और फलों जैसी नाशवान फसलों के लिए, ऑफ-सीजन अवधि के दौरान कीमतें सबसे अधिक होती हैं।">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Knowing when to sell your crops can significantly impact your profits. Our historical data shows that prices for most grain crops typically peak in the months just before new harvests come to market. For perishable crops like vegetables and fruits, prices are highest during off-season periods.' : 'अपनी फसलों को कब बेचना है, यह जानने से आपके मुनाफे पर महत्वपूर्ण प्रभाव पड़ सकता है। हमारे ऐतिहासिक डेटा से पता चलता है कि अधिकांश अनाज फसलों के लिए कीमतें आमतौर पर नई फसलों के बाजार में आने से ठीक पहले के महीनों में चरम पर होती हैं। सब्जियों और फलों जैसी नाशवान फसलों के लिए, ऑफ-सीजन अवधि के दौरान कीमतें सबसे अधिक होती हैं।'; ?>
                        </p>
                        <h5 class="mt-3" data-en="Tips:" data-hi="सुझाव:">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Tips:' : 'सुझाव:'; ?>
                        </h5>
                        <ul>
                            <li data-en="Consider staggered selling to minimize risk from price fluctuations" data-hi="मूल्य उतार-चढ़ाव से जोखिम को कम करने के लिए चरणबद्ध बिक्री पर विचार करें">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Consider staggered selling to minimize risk from price fluctuations' : 'मूल्य उतार-चढ़ाव से जोखिम को कम करने के लिए चरणबद्ध बिक्री पर विचार करें'; ?>
                            </li>
                            <li data-en="Monitor both local and national market trends" data-hi="स्थानीय और राष्ट्रीय बाजार रुझानों दोनों की निगरानी करें">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Monitor both local and national market trends' : 'स्थानीय और राष्ट्रीय बाजार रुझानों दोनों की निगरानी करें'; ?>
                            </li>
                            <li data-en="Factor in storage costs when deciding to hold crops for better prices" data-hi="बेहतर कीमतों के लिए फसलों को रखने का निर्णय लेते समय भंडारण लागतों पर विचार करें">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Factor in storage costs when deciding to hold crops for better prices' : 'बेहतर कीमतों के लिए फसलों को रखने का निर्णय लेते समय भंडारण लागतों पर विचार करें'; ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="card-title h5" data-en="Understanding Market Factors" data-hi="बाजार कारकों को समझना">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Understanding Market Factors' : 'बाजार कारकों को समझना'; ?>
                        </h3>
                        <p data-en="Crop prices are influenced by many factors including seasonal supply and demand, weather conditions, government policies, international markets, and global events. Being aware of these factors can help you anticipate market movements." data-hi="फसल की कीमतें मौसमी आपूर्ति और मांग, मौसम की स्थिति, सरकारी नीतियों, अंतरराष्ट्रीय बाजारों और वैश्विक घटनाओं सहित कई कारकों से प्रभावित होती हैं। इन कारकों के बारे में जागरूक होने से आपको बाजार की गतिविधियों का अनुमान लगाने में मदद मिल सकती है।">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Crop prices are influenced by many factors including seasonal supply and demand, weather conditions, government policies, international markets, and global events. Being aware of these factors can help you anticipate market movements.' : 'फसल की कीमतें मौसमी आपूर्ति और मांग, मौसम की स्थिति, सरकारी नीतियों, अंतरराष्ट्रीय बाजारों और वैश्विक घटनाओं सहित कई कारकों से प्रभावित होती हैं। इन कारकों के बारे में जागरूक होने से आपको बाजार की गतिविधियों का अनुमान लगाने में मदद मिल सकती है।'; ?>
                        </p>
                        <h5 class="mt-3" data-en="Key Factors to Monitor:" data-hi="निगरानी के लिए प्रमुख कारक:">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Key Factors to Monitor:' : 'निगरानी के लिए प्रमुख कारक:'; ?>
                        </h5>
                        <ul>
                            <li data-en="Government Minimum Support Prices (MSP) announcements" data-hi="सरकारी न्यूनतम समर्थन मूल्य (MSP) घोषणाएं">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Government Minimum Support Prices (MSP) announcements' : 'सरकारी न्यूनतम समर्थन मूल्य (MSP) घोषणाएं'; ?>
                            </li>
                            <li data-en="Import/export policies and trade agreements" data-hi="आयात/निर्यात नीतियां और व्यापार समझौते">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Import/export policies and trade agreements' : 'आयात/निर्यात नीतियां और व्यापार समझौते'; ?>
                            </li>
                            <li data-en="Weather events in major production areas" data-hi="प्रमुख उत्पादन क्षेत्रों में मौसम की घटनाएं">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Weather events in major production areas' : 'प्रमुख उत्पादन क्षेत्रों में मौसम की घटनाएं'; ?>
                            </li>
                            <li data-en="Crop acreage reports and harvest forecasts" data-hi="फसल क्षेत्रफल रिपोर्ट और फसल पूर्वानुमान">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Crop acreage reports and harvest forecasts' : 'फसल क्षेत्रफल रिपोर्ट और फसल पूर्वानुमान'; ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="card-title h5" data-en="Direct Marketing Opportunities" data-hi="प्रत्यक्ष विपणन के अवसर">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Direct Marketing Opportunities' : 'प्रत्यक्ष विपणन के अवसर'; ?>
                        </h3>
                        <p data-en="Selling directly to consumers or processors can often result in better prices for farmers by eliminating middlemen. Consider these direct marketing channels to potentially increase your profits." data-hi="बिचौलियों को समाप्त करके सीधे उपभोक्ताओं या प्रोसेसर को बेचने से अक्सर किसानों के लिए बेहतर कीमतें मिल सकती हैं। अपने मुनाफे को बढ़ाने की संभावना के लिए इन प्रत्यक्ष विपणन चैनलों पर विचार करें।">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Selling directly to consumers or processors can often result in better prices for farmers by eliminating middlemen. Consider these direct marketing channels to potentially increase your profits.' : 'बिचौलियों को समाप्त करके सीधे उपभोक्ताओं या प्रोसेसर को बेचने से अक्सर किसानों के लिए बेहतर कीमतें मिल सकती हैं। अपने मुनाफे को बढ़ाने की संभावना के लिए इन प्रत्यक्ष विपणन चैनलों पर विचार करें।'; ?>
                        </p>
                        <h5 class="mt-3" data-en="Options to Consider:" data-hi="विचार करने के लिए विकल्प:">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Options to Consider:' : 'विचार करने के लिए विकल्प:'; ?>
                        </h5>
                        <ul>
                            <li data-en="Farmers' markets in urban areas" data-hi="शहरी क्षेत्रों में किसान बाजार">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Farmers\' markets in urban areas' : 'शहरी क्षेत्रों में किसान बाजार'; ?>
                            </li>
                            <li data-en="Community-supported agriculture (CSA) subscriptions" data-hi="सामुदायिक-समर्थित कृषि (CSA) सदस्यता">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Community-supported agriculture (CSA) subscriptions' : 'सामुदायिक-समर्थित कृषि (CSA) सदस्यता'; ?>
                            </li>
                            <li data-en="Farm-to-restaurant direct sales" data-hi="खेत-से-रेस्तरां तक प्रत्यक्ष बिक्री">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Farm-to-restaurant direct sales' : 'खेत-से-रेस्तरां तक प्रत्यक्ष बिक्री'; ?>
                            </li>
                            <li data-en="Online marketplaces for agricultural products" data-hi="कृषि उत्पादों के लिए ऑनलाइन बाजार">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Online marketplaces for agricultural products' : 'कृषि उत्पादों के लिए ऑनलाइन बाजार'; ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="card-title h5" data-en="Value Addition Strategies" data-hi="मूल्य वर्धन रणनीतियां">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Value Addition Strategies' : 'मूल्य वर्धन रणनीतियां'; ?>
                        </h3>
                        <p data-en="Processing your raw agricultural products can significantly increase their value. Even simple processing like cleaning, grading, and packaging can command premium prices in the market." data-hi="अपने कच्चे कृषि उत्पादों का प्रसंस्करण उनके मूल्य को महत्वपूर्ण रूप से बढ़ा सकता है। सफाई, ग्रेडिंग और पैकेजिंग जैसे सरल प्रसंस्करण भी बाजार में प्रीमियम कीमतों की मांग कर सकते हैं।">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Processing your raw agricultural products can significantly increase their value. Even simple processing like cleaning, grading, and packaging can command premium prices in the market.' : 'अपने कच्चे कृषि उत्पादों का प्रसंस्करण उनके मूल्य को महत्वपूर्ण रूप से बढ़ा सकता है। सफाई, ग्रेडिंग और पैकेजिंग जैसे सरल प्रसंस्करण भी बाजार में प्रीमियम कीमतों की मांग कर सकते हैं।'; ?>
                        </p>
                        <h5 class="mt-3" data-en="Value Addition Ideas:" data-hi="मूल्य वर्धन विचार:">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Value Addition Ideas:' : 'मूल्य वर्धन विचार:'; ?>
                        </h5>
                        <ul>
                            <li data-en="Grain milling and flour production" data-hi="अनाज पीसना और आटा उत्पादन">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Grain milling and flour production' : 'अनाज पीसना और आटा उत्पादन'; ?>
                            </li>
                            <li data-en="Oil extraction from oilseeds" data-hi="तिलहन से तेल निकालना">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Oil extraction from oilseeds' : 'तिलहन से तेल निकालना'; ?>
                            </li>
                            <li data-en="Dehydration for fruits and vegetables" data-hi="फल और सब्जियों के लिए निर्जलीकरण">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Dehydration for fruits and vegetables' : 'फल और सब्जियों के लिए निर्जलीकरण'; ?>
                            </li>
                            <li data-en="Branding and packaging for direct consumer sales" data-hi="प्रत्यक्ष उपभोक्ता बिक्री के लिए ब्रांडिंग और पैकेजिंग">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Branding and packaging for direct consumer sales' : 'प्रत्यक्ष उपभोक्ता बिक्री के लिए ब्रांडिंग और पैकेजिंग'; ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Government Programs Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="section-title">
            <h2 data-en="Government Support Programs" data-hi="सरकारी समर्थन कार्यक्रम">
                <?php echo ($_SESSION['language'] == 'en') ? 'Government Support Programs' : 'सरकारी समर्थन कार्यक्रम'; ?>
            </h2>
        </div>
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th data-en="Program" data-hi="कार्यक्रम">
                                        <?php echo ($_SESSION['language'] == 'en') ? 'Program' : 'कार्यक्रम'; ?>
                                    </th>
                                    <th data-en="Description" data-hi="विवरण">
                                        <?php echo ($_SESSION['language'] == 'en') ? 'Description' : 'विवरण'; ?>
                                    </th>
                                    <th data-en="Eligibility" data-hi="पात्रता">
                                        <?php echo ($_SESSION['language'] == 'en') ? 'Eligibility' : 'पात्रता'; ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <strong data-en="Minimum Support Price (MSP)" data-hi="न्यूनतम समर्थन मूल्य (MSP)">
                                            <?php echo ($_SESSION['language'] == 'en') ? 'Minimum Support Price (MSP)' : 'न्यूनतम समर्थन मूल्य (MSP)'; ?>
                                        </strong>
                                    </td>
                                    <td data-en="Government-set floor prices for key agricultural commodities" data-hi="प्रमुख कृषि वस्तुओं के लिए सरकार द्वारा निर्धारित न्यूनतम मूल्य">
                                        <?php echo ($_SESSION['language'] == 'en') ? 'Government-set floor prices for key agricultural commodities' : 'प्रमुख कृषि वस्तुओं के लिए सरकार द्वारा निर्धारित न्यूनतम मूल्य'; ?>
                                    </td>
                                    <td data-en="All farmers growing notified crops" data-hi="अधिसूचित फसलों की खेती करने वाले सभी किसान">
                                        <?php echo ($_SESSION['language'] == 'en') ? 'All farmers growing notified crops' : 'अधिसूचित फसलों की खेती करने वाले सभी किसान'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong data-en="PM-KISAN" data-hi="पीएम-किसान">
                                            <?php echo ($_SESSION['language'] == 'en') ? 'PM-KISAN' : 'पीएम-किसान'; ?>
                                        </strong>
                                    </td>
                                    <td data-en="Direct income support of ₹6,000 per year to farmer families" data-hi="किसान परिवारों को प्रति वर्ष ₹6,000 का प्रत्यक्ष आय समर्थन">
                                        <?php echo ($_SESSION['language'] == 'en') ? 'Direct income support of ₹6,000 per year to farmer families' : 'किसान परिवारों को प्रति वर्ष ₹6,000 का प्रत्यक्ष आय समर्थन'; ?>
                                    </td>
                                    <td data-en="Small and marginal farmers with less than 2 hectares of land" data-hi="2 हेक्टेयर से कम भूमि वाले छोटे और सीमांत किसान">
                                        <?php echo ($_SESSION['language'] == 'en') ? 'Small and marginal farmers with less than 2 hectares of land' : '2 हेक्टेयर से कम भूमि वाले छोटे और सीमांत किसान'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong data-en="Kisan Credit Card (KCC)" data-hi="किसान क्रेडिट कार्ड (KCC)">
                                            <?php echo ($_SESSION['language'] == 'en') ? 'Kisan Credit Card (KCC)' : 'किसान क्रेडिट कार्ड (KCC)'; ?>
                                        </strong>
                                    </td>
                                    <td data-en="Credit facility for farmers at subsidized interest rates" data-hi="किसानों के लिए सब्सिडी वाली ब्याज दरों पर क्रेडिट सुविधा">
                                        <?php echo ($_SESSION['language'] == 'en') ? 'Credit facility for farmers at subsidized interest rates' : 'किसानों के लिए सब्सिडी वाली ब्याज दरों पर क्रेडिट सुविधा'; ?>
                                    </td>
                                    <td data-en="All farmers, sharecroppers, and tenant farmers" data-hi="सभी किसान, बटाईदार और किरायेदार किसान">
                                        <?php echo ($_SESSION['language'] == 'en') ? 'All farmers, sharecroppers, and tenant farmers' : 'सभी किसान, बटाईदार और किरायेदार किसान'; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong data-en="Pradhan Mantri Fasal Bima Yojana (PMFBY)" data-hi="प्रधानमंत्री फसल बीमा योजना (PMFBY)">
                                            <?php echo ($_SESSION['language'] == 'en') ? 'Pradhan Mantri Fasal Bima Yojana (PMFBY)' : 'प्रधानमंत्री फसल बीमा योजना (PMFBY)'; ?>
                                        </strong>
                                    </td>
                                    <td data-en="Crop insurance scheme to provide financial support to farmers in case of crop failure" data-hi="फसल विफलता के मामले में किसानों को वित्तीय सहायता प्रदान करने के लिए फसल बीमा योजना">
                                        <?php echo ($_SESSION['language'] == 'en') ? 'Crop insurance scheme to provide financial support to farmers in case of crop failure' : 'फसल विफलता के मामले में किसानों को वित्तीय सहायता प्रदान करने के लिए फसल बीमा योजना'; ?>
                                    </td>
                                    <td data-en="All farmers growing notified crops (both loanee and non-loanee)" data-hi="अधिसूचित फसलों की खेती करने वाले सभी किसान (ऋणी और गैर-ऋणी दोनों)">
                                        <?php echo ($_SESSION['language'] == 'en') ? 'All farmers growing notified crops (both loanee and non-loanee)' : 'अधिसूचित फसलों की खेती करने वाले सभी किसान (ऋणी और गैर-ऋणी दोनों)'; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-center mt-4">
                            <a href="https://agricoop.nic.in/" target="_blank" class="btn btn-primary" data-en="Visit Agriculture Ministry Website" data-hi="कृषि मंत्रालय की वेबसाइट पर जाएं">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Visit Agriculture Ministry Website' : 'कृषि मंत्रालय की वेबसाइट पर जाएं'; ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Load Market JavaScript -->
<script src="/js/market.js"></script>

<?php
// Include footer
include_once 'includes/footer.php';
?>
