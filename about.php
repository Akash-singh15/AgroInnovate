<?php
// Include header
include_once 'includes/header.php';
?>

<!-- Page Header -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <h1 data-en="About AgroInnovate" data-hi="एग्रोइनोवेट के बारे में">
            <?php echo ($_SESSION['language'] == 'en') ? 'About AgroInnovate' : 'एग्रोइनोवेट के बारे में'; ?>
        </h1>
        <p class="lead" data-en="Bridging the gap between technology and agriculture for Indian farmers" data-hi="भारतीय किसानों के लिए प्रौद्योगिकी और कृषि के बीच की खाई को पाटना">
            <?php echo ($_SESSION['language'] == 'en') ? 'Bridging the gap between technology and agriculture for Indian farmers' : 'भारतीय किसानों के लिए प्रौद्योगिकी और कृषि के बीच की खाई को पाटना'; ?>
        </p>
    </div>
</section>

<!-- About Section -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="/assets/about-mission.svg" alt="Our Mission" class="img-fluid rounded">
            </div>
            <div class="col-lg-6">
                <h2 data-en="Our Mission" data-hi="हमारा मिशन">
                    <?php echo ($_SESSION['language'] == 'en') ? 'Our Mission' : 'हमारा मिशन'; ?>
                </h2>
                <p data-en="AgroInnovate was founded with a clear mission: to empower Indian farmers with the information, technology, and community they need to thrive in an increasingly challenging agricultural landscape." data-hi="एग्रोइनोवेट की स्थापना एक स्पष्ट मिशन के साथ की गई थी: भारतीय किसानों को उस जानकारी, प्रौद्योगिकी और समुदाय से सशक्त बनाना जिसकी उन्हें तेजी से चुनौतीपूर्ण कृषि परिदृश्य में समृद्ध होने के लिए आवश्यकता है।">
                    <?php echo ($_SESSION['language'] == 'en') ? 'AgroInnovate was founded with a clear mission: to empower Indian farmers with the information, technology, and community they need to thrive in an increasingly challenging agricultural landscape.' : 'एग्रोइनोवेट की स्थापना एक स्पष्ट मिशन के साथ की गई थी: भारतीय किसानों को उस जानकारी, प्रौद्योगिकी और समुदाय से सशक्त बनाना जिसकी उन्हें तेजी से चुनौतीपूर्ण कृषि परिदृश्य में समृद्ध होने के लिए आवश्यकता है।'; ?>
                </p>
                <p data-en="We believe that by providing accurate weather forecasts, timely market information, and access to agricultural best practices, we can help farmers make informed decisions that increase yields, reduce losses, and improve livelihoods." data-hi="हमारा मानना है कि सटीक मौसम पूर्वानुमान, समय पर बाजार की जानकारी और कृषि की सर्वोत्तम प्रथाओं तक पहुंच प्रदान करके, हम किसानों को सूचित निर्णय लेने में मदद कर सकते हैं जो उपज बढ़ाते हैं, नुकसान कम करते हैं और आजीविका में सुधार करते हैं।">
                    <?php echo ($_SESSION['language'] == 'en') ? 'We believe that by providing accurate weather forecasts, timely market information, and access to agricultural best practices, we can help farmers make informed decisions that increase yields, reduce losses, and improve livelihoods.' : 'हमारा मानना है कि सटीक मौसम पूर्वानुमान, समय पर बाजार की जानकारी और कृषि की सर्वोत्तम प्रथाओं तक पहुंच प्रदान करके, हम किसानों को सूचित निर्णय लेने में मदद कर सकते हैं जो उपज बढ़ाते हैं, नुकसान कम करते हैं और आजीविका में सुधार करते हैं।'; ?>
                </p>
            </div>
        </div>
        
        <div class="row align-items-center mb-5 flex-lg-row-reverse">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="/assets/about-vision.svg" alt="Our Vision" class="img-fluid rounded">
            </div>
            <div class="col-lg-6">
                <h2 data-en="Our Vision" data-hi="हमारी दृष्टि">
                    <?php echo ($_SESSION['language'] == 'en') ? 'Our Vision' : 'हमारी दृष्टि'; ?>
                </h2>
                <p data-en="We envision a future where every Indian farmer has access to the tools, information, and community support needed to practice sustainable and profitable agriculture." data-hi="हम एक ऐसे भविष्य की कल्पना करते हैं जहां हर भारतीय किसान के पास टिकाऊ और लाभदायक कृषि का अभ्यास करने के लिए आवश्यक उपकरण, जानकारी और सामुदायिक समर्थन तक पहुंच हो।">
                    <?php echo ($_SESSION['language'] == 'en') ? 'We envision a future where every Indian farmer has access to the tools, information, and community support needed to practice sustainable and profitable agriculture.' : 'हम एक ऐसे भविष्य की कल्पना करते हैं जहां हर भारतीय किसान के पास टिकाऊ और लाभदायक कृषि का अभ्यास करने के लिए आवश्यक उपकरण, जानकारी और सामुदायिक समर्थन तक पहुंच हो।'; ?>
                </p>
                <p data-en="Our goal is to build a digital bridge connecting farmers with vital information and each other, creating resilient agricultural communities that can adapt to challenges such as climate change, market fluctuations, and evolving farming practices." data-hi="हमारा लक्ष्य किसानों को महत्वपूर्ण जानकारी और एक-दूसरे से जोड़ने वाला एक डिजिटल पुल बनाना है, जिससे लचीले कृषि समुदाय बनें जो जलवायु परिवर्तन, बाजार उतार-चढ़ाव और विकसित होती कृषि प्रथाओं जैसी चुनौतियों के अनुकूल हो सकें।">
                    <?php echo ($_SESSION['language'] == 'en') ? 'Our goal is to build a digital bridge connecting farmers with vital information and each other, creating resilient agricultural communities that can adapt to challenges such as climate change, market fluctuations, and evolving farming practices.' : 'हमारा लक्ष्य किसानों को महत्वपूर्ण जानकारी और एक-दूसरे से जोड़ने वाला एक डिजिटल पुल बनाना है, जिससे लचीले कृषि समुदाय बनें जो जलवायु परिवर्तन, बाजार उतार-चढ़ाव और विकसित होती कृषि प्रथाओं जैसी चुनौतियों के अनुकूल हो सकें।'; ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Our Values -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h2 data-en="Our Core Values" data-hi="हमारे मूल मूल्य">
                <?php echo ($_SESSION['language'] == 'en') ? 'Our Core Values' : 'हमारे मूल मूल्य'; ?>
            </h2>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <i data-feather="users" style="width: 48px; height: 48px; color: var(--primary-color);"></i>
                        </div>
                        <h4 class="card-title" data-en="Farmer First" data-hi="किसान पहले">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Farmer First' : 'किसान पहले'; ?>
                        </h4>
                        <p class="card-text" data-en="Every decision we make and feature we develop is centered around the needs of Indian farmers. Their success is our success." data-hi="हम जो हर निर्णय लेते हैं और हर सुविधा विकसित करते हैं वह भारतीय किसानों की जरूरतों के इर्द-गिर्द केंद्रित है। उनकी सफलता हमारी सफलता है।">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Every decision we make and feature we develop is centered around the needs of Indian farmers. Their success is our success.' : 'हम जो हर निर्णय लेते हैं और हर सुविधा विकसित करते हैं वह भारतीय किसानों की जरूरतों के इर्द-गिर्द केंद्रित है। उनकी सफलता हमारी सफलता है।'; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <i data-feather="shield" style="width: 48px; height: 48px; color: var(--primary-color);"></i>
                        </div>
                        <h4 class="card-title" data-en="Accuracy & Reliability" data-hi="सटीकता और विश्वसनीयता">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Accuracy & Reliability' : 'सटीकता और विश्वसनीयता'; ?>
                        </h4>
                        <p class="card-text" data-en="We're committed to providing the most accurate information possible. Farmers rely on our data to make crucial decisions, and we take that responsibility seriously." data-hi="हम संभव सबसे सटीक जानकारी प्रदान करने के लिए प्रतिबद्ध हैं। किसान महत्वपूर्ण निर्णय लेने के लिए हमारे डेटा पर भरोसा करते हैं, और हम उस जिम्मेदारी को गंभीरता से लेते हैं।">
                            <?php echo ($_SESSION['language'] == 'en') ? 'We\'re committed to providing the most accurate information possible. Farmers rely on our data to make crucial decisions, and we take that responsibility seriously.' : 'हम संभव सबसे सटीक जानकारी प्रदान करने के लिए प्रतिबद्ध हैं। किसान महत्वपूर्ण निर्णय लेने के लिए हमारे डेटा पर भरोसा करते हैं, और हम उस जिम्मेदारी को गंभीरता से लेते हैं।'; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <i data-feather="globe" style="width: 48px; height: 48px; color: var(--primary-color);"></i>
                        </div>
                        <h4 class="card-title" data-en="Sustainability" data-hi="स्थिरता">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Sustainability' : 'स्थिरता'; ?>
                        </h4>
                        <p class="card-text" data-en="We promote farming practices that are not only profitable but also sustainable for the environment and future generations." data-hi="हम ऐसी कृषि प्रथाओं को बढ़ावा देते हैं जो न केवल लाभदायक हैं बल्कि पर्यावरण और भविष्य की पीढ़ियों के लिए भी टिकाऊ हैं।">
                            <?php echo ($_SESSION['language'] == 'en') ? 'We promote farming practices that are not only profitable but also sustainable for the environment and future generations.' : 'हम ऐसी कृषि प्रथाओं को बढ़ावा देते हैं जो न केवल लाभदायक हैं बल्कि पर्यावरण और भविष्य की पीढ़ियों के लिए भी टिकाऊ हैं।'; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <i data-feather="share-2" style="width: 48px; height: 48px; color: var(--primary-color);"></i>
                        </div>
                        <h4 class="card-title" data-en="Community" data-hi="समुदाय">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Community' : 'समुदाय'; ?>
                        </h4>
                        <p class="card-text" data-en="We believe in the power of farmers connecting with and learning from each other. Our platform fosters community-building and knowledge-sharing." data-hi="हम किसानों के एक-दूसरे से जुड़ने और सीखने की शक्ति में विश्वास करते हैं। हमारा प्लेटफॉर्म समुदाय-निर्माण और ज्ञान-साझाकरण को बढ़ावा देता है।">
                            <?php echo ($_SESSION['language'] == 'en') ? 'We believe in the power of farmers connecting with and learning from each other. Our platform fosters community-building and knowledge-sharing.' : 'हम किसानों के एक-दूसरे से जुड़ने और सीखने की शक्ति में विश्वास करते हैं। हमारा प्लेटफॉर्म समुदाय-निर्माण और ज्ञान-साझाकरण को बढ़ावा देता है।'; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <i data-feather="accessibility" style="width: 48px; height: 48px; color: var(--primary-color);"></i>
                        </div>
                        <h4 class="card-title" data-en="Inclusivity" data-hi="समावेशिता">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Inclusivity' : 'समावेशिता'; ?>
                        </h4>
                        <p class="card-text" data-en="We design our platform to be accessible to all farmers, regardless of education level, language preference, or technological familiarity." data-hi="हम अपने प्लेटफॉर्म को सभी किसानों के लिए सुलभ बनाने के लिए डिज़ाइन करते हैं, चाहे शिक्षा का स्तर, भाषा की प्राथमिकता, या तकनीकी परिचितता कुछ भी हो।">
                            <?php echo ($_SESSION['language'] == 'en') ? 'We design our platform to be accessible to all farmers, regardless of education level, language preference, or technological familiarity.' : 'हम अपने प्लेटफॉर्म को सभी किसानों के लिए सुलभ बनाने के लिए डिज़ाइन करते हैं, चाहे शिक्षा का स्तर, भाषा की प्राथमिकता, या तकनीकी परिचितता कुछ भी हो।'; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <div class="mb-4">
                            <i data-feather="refresh-cw" style="width: 48px; height: 48px; color: var(--primary-color);"></i>
                        </div>
                        <h4 class="card-title" data-en="Innovation" data-hi="नवाचार">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Innovation' : 'नवाचार'; ?>
                        </h4>
                        <p class="card-text" data-en="We continuously evolve our platform by incorporating new technologies and approaches that can better serve the agricultural community." data-hi="हम नई तकनीकों और दृष्टिकोणों को शामिल करके अपने प्लेटफॉर्म को लगातार विकसित करते हैं जो कृषि समुदाय को बेहतर ढंग से सेवा दे सकते हैं।">
                            <?php echo ($_SESSION['language'] == 'en') ? 'We continuously evolve our platform by incorporating new technologies and approaches that can better serve the agricultural community.' : 'हम नई तकनीकों और दृष्टिकोणों को शामिल करके अपने प्लेटफॉर्म को लगातार विकसित करते हैं जो कृषि समुदाय को बेहतर ढंग से सेवा दे सकते हैं।'; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Impact -->
<section class="py-5">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h2 data-en="Our Impact" data-hi="हमारा प्रभाव">
                <?php echo ($_SESSION['language'] == 'en') ? 'Our Impact' : 'हमारा प्रभाव'; ?>
            </h2>
        </div>
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="p-4">
                    <h3 class="display-4 text-primary fw-bold">10,000+</h3>
                    <h5 data-en="Farmers Reached" data-hi="किसानों तक पहुंचे">
                        <?php echo ($_SESSION['language'] == 'en') ? 'Farmers Reached' : 'किसानों तक पहुंचे'; ?>
                    </h5>
                    <p data-en="Across 15 states in India" data-hi="भारत के 15 राज्यों में">
                        <?php echo ($_SESSION['language'] == 'en') ? 'Across 15 states in India' : 'भारत के 15 राज्यों में'; ?>
                    </p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="p-4">
                    <h3 class="display-4 text-primary fw-bold">20%</h3>
                    <h5 data-en="Average Yield Increase" data-hi="औसत उपज वृद्धि">
                        <?php echo ($_SESSION['language'] == 'en') ? 'Average Yield Increase' : 'औसत उपज वृद्धि'; ?>
                    </h5>
                    <p data-en="Reported by farmers using our platform" data-hi="हमारे प्लेटफॉर्म का उपयोग करने वाले किसानों द्वारा रिपोर्ट किया गया">
                        <?php echo ($_SESSION['language'] == 'en') ? 'Reported by farmers using our platform' : 'हमारे प्लेटफॉर्म का उपयोग करने वाले किसानों द्वारा रिपोर्ट किया गया'; ?>
                    </p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="p-4">
                    <h3 class="display-4 text-primary fw-bold">15%</h3>
                    <h5 data-en="Water Conservation" data-hi="जल संरक्षण">
                        <?php echo ($_SESSION['language'] == 'en') ? 'Water Conservation' : 'जल संरक्षण'; ?>
                    </h5>
                    <p data-en="Through weather-informed irrigation planning" data-hi="मौसम-सूचित सिंचाई योजना के माध्यम से">
                        <?php echo ($_SESSION['language'] == 'en') ? 'Through weather-informed irrigation planning' : 'मौसम-सूचित सिंचाई योजना के माध्यम से'; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h2 data-en="Our Team" data-hi="हमारी टीम">
                <?php echo ($_SESSION['language'] == 'en') ? 'Our Team' : 'हमारी टीम'; ?>
            </h2>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <div class="mb-3">
                            <img src="/assets/team-member1.svg" alt="Rajiv Sharma" class="rounded-circle" width="150" height="150">
                        </div>
                        <h4 class="card-title">Rajiv Sharma</h4>
                        <p class="card-text text-muted" data-en="Founder & Agricultural Scientist" data-hi="संस्थापक और कृषि वैज्ञानिक">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Founder & Agricultural Scientist' : 'संस्थापक और कृषि वैज्ञानिक'; ?>
                        </p>
                        <p class="card-text" data-en="With 15 years of experience in agricultural research, Rajiv combines scientific knowledge with practical farming insights." data-hi="कृषि अनुसंधान में 15 वर्षों के अनुभव के साथ, राजीव वैज्ञानिक ज्ञान को व्यावहारिक खेती की अंतर्दृष्टि के साथ जोड़ते हैं।">
                            <?php echo ($_SESSION['language'] == 'en') ? 'With 15 years of experience in agricultural research, Rajiv combines scientific knowledge with practical farming insights.' : 'कृषि अनुसंधान में 15 वर्षों के अनुभव के साथ, राजीव वैज्ञानिक ज्ञान को व्यावहारिक खेती की अंतर्दृष्टि के साथ जोड़ते हैं।'; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <div class="mb-3">
                            <img src="/assets/team-member2.svg" alt="Priya Patel" class="rounded-circle" width="150" height="150">
                        </div>
                        <h4 class="card-title">Priya Patel</h4>
                        <p class="card-text text-muted" data-en="Technology Lead" data-hi="प्रौद्योगिकी प्रमुख">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Technology Lead' : 'प्रौद्योगिकी प्रमुख'; ?>
                        </p>
                        <p class="card-text" data-en="Priya leads our technical development, focusing on creating accessible and intuitive tools for farmers with varying levels of technical expertise." data-hi="प्रिया हमारे तकनीकी विकास का नेतृत्व करती हैं, विभिन्न स्तरों की तकनीकी विशेषज्ञता वाले किसानों के लिए सुलभ और सहज उपकरण बनाने पर ध्यान केंद्रित करती हैं।">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Priya leads our technical development, focusing on creating accessible and intuitive tools for farmers with varying levels of technical expertise.' : 'प्रिया हमारे तकनीकी विकास का नेतृत्व करती हैं, विभिन्न स्तरों की तकनीकी विशेषज्ञता वाले किसानों के लिए सुलभ और सहज उपकरण बनाने पर ध्यान केंद्रित करती हैं।'; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <div class="mb-3">
                            <img src="/assets/team-member3.svg" alt="Amit Verma" class="rounded-circle" width="150" height="150">
                        </div>
                        <h4 class="card-title">Amit Verma</h4>
                        <p class="card-text text-muted" data-en="Community Manager" data-hi="समुदाय प्रबंधक">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Community Manager' : 'समुदाय प्रबंधक'; ?>
                        </p>
                        <p class="card-text" data-en="With deep roots in rural India, Amit ensures our platform meets the real needs of farmers and facilitates meaningful connections within the community." data-hi="ग्रामीण भारत में गहरी जड़ों के साथ, अमित यह सुनिश्चित करते हैं कि हमारा प्लेटफॉर्म किसानों की वास्तविक जरूरतों को पूरा करता है और समुदाय के भीतर सार्थक संबंध बनाता है।">
                            <?php echo ($_SESSION['language'] == 'en') ? 'With deep roots in rural India, Amit ensures our platform meets the real needs of farmers and facilitates meaningful connections within the community.' : 'ग्रामीण भारत में गहरी जड़ों के साथ, अमित यह सुनिश्चित करते हैं कि हमारा प्लेटफॉर्म किसानों की वास्तविक जरूरतों को पूरा करता है और समुदाय के भीतर सार्थक संबंध बनाता है।'; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Join Us Section -->
<section class="py-5 bg-primary text-white">
    <div class="container text-center">
        <h2 class="mb-4" data-en="Join Our Mission" data-hi="हमारे मिशन में शामिल हों">
            <?php echo ($_SESSION['language'] == 'en') ? 'Join Our Mission' : 'हमारे मिशन में शामिल हों'; ?>
        </h2>
        <p class="lead mb-5" data-en="Together, we can transform Indian agriculture for a more sustainable and prosperous future." data-hi="एक साथ, हम भारतीय कृषि को अधिक टिकाऊ और समृद्ध भविष्य के लिए बदल सकते हैं।">
            <?php echo ($_SESSION['language'] == 'en') ? 'Together, we can transform Indian agriculture for a more sustainable and prosperous future.' : 'एक साथ, हम भारतीय कृषि को अधिक टिकाऊ और समृद्ध भविष्य के लिए बदल सकते हैं।'; ?>
        </p>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <a href="/community.php" class="btn btn-light btn-lg w-100 mb-3" data-en="Join Our Community" data-hi="हमारे समुदाय में शामिल हों">
                    <?php echo ($_SESSION['language'] == 'en') ? 'Join Our Community' : 'हमारे समुदाय में शामिल हों'; ?>
                </a>
            </div>
            <div class="col-md-4">
                <a href="/contact.php" class="btn btn-outline-light btn-lg w-100 mb-3" data-en="Contact Us" data-hi="हमसे संपर्क करें">
                    <?php echo ($_SESSION['language'] == 'en') ? 'Contact Us' : 'हमसे संपर्क करें'; ?>
                </a>
            </div>
        </div>
    </div>
</section>

<?php
// Include footer
include_once 'includes/footer.php';
?>
