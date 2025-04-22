<?php
// Include header and functions
include_once 'includes/header.php';
include_once 'includes/functions.php';
?>

<!-- Page Header -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <h1 data-en="Educational Resources" data-hi="शैक्षिक संसाधन">
            <?php echo ($_SESSION['language'] == 'en') ? 'Educational Resources' : 'शैक्षिक संसाधन'; ?>
        </h1>
        <p class="lead" data-en="Learn modern farming techniques and best practices" data-hi="आधुनिक खेती तकनीकों और सर्वोत्तम प्रथाओं के बारे में जानें">
            <?php echo ($_SESSION['language'] == 'en') ? 'Learn modern farming techniques and best practices' : 'आधुनिक खेती तकनीकों और सर्वोत्तम प्रथाओं के बारे में जानें'; ?>
        </p>
    </div>
</section>

<!-- Education Tabs Section -->
<section class="py-5">
    <div class="container">
        <div class="education-tabs">
            <div class="education-tab active" id="tab-crop" data-target="content-crop" data-en="Crop Management" data-hi="फसल प्रबंधन">
                <?php echo ($_SESSION['language'] == 'en') ? 'Crop Management' : 'फसल प्रबंधन'; ?>
            </div>
            <div class="education-tab" id="tab-tech" data-target="content-tech" data-en="Technology" data-hi="प्रौद्योगिकी">
                <?php echo ($_SESSION['language'] == 'en') ? 'Technology' : 'प्रौद्योगिकी'; ?>
            </div>
            <div class="education-tab" id="tab-finance" data-target="content-finance" data-en="Finance" data-hi="वित्त">
                <?php echo ($_SESSION['language'] == 'en') ? 'Finance' : 'वित्त'; ?>
            </div>
            <?php if (isset($_GET['resource'])): ?>
            <div class="education-tab" id="tab-detail" data-target="content-detail" data-en="Resource Details" data-hi="संसाधन विवरण">
                <?php echo ($_SESSION['language'] == 'en') ? 'Resource Details' : 'संसाधन विवरण'; ?>
            </div>
            <?php endif; ?>
        </div>

        <!-- Crop Management Content -->
        <div class="education-content active" id="content-crop">
            <div class="row">
                <?php
                $resources = getEducationalResources('crop_management');
                foreach ($resources as $resource):
                ?>
                <div class="col-md-4 mb-4">
                    <div class="resource-card">
                        <div class="resource-image">
                            <img src="/assets/<?php echo $resource['image']; ?>" alt="<?php echo $resource['title']; ?>" class="img-fluid">
                        </div>
                        <div class="resource-content">
                            <h3 class="resource-title"><?php echo $resource['title']; ?></h3>
                            <p class="resource-description"><?php echo $resource['description']; ?></p>
                            <a href="<?php echo $resource['url']; ?>" class="resource-link" data-en="Learn More" data-hi="अधिक जानें">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Learn More' : 'अधिक जानें'; ?>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Technology Content -->
        <div class="education-content" id="content-tech">
            <div class="row">
                <?php
                $resources = getEducationalResources('technology');
                foreach ($resources as $resource):
                ?>
                <div class="col-md-4 mb-4">
                    <div class="resource-card">
                        <div class="resource-image">
                            <img src="/assets/<?php echo $resource['image']; ?>" alt="<?php echo $resource['title']; ?>" class="img-fluid">
                        </div>
                        <div class="resource-content">
                            <h3 class="resource-title"><?php echo $resource['title']; ?></h3>
                            <p class="resource-description"><?php echo $resource['description']; ?></p>
                            <a href="<?php echo $resource['url']; ?>" class="resource-link" data-en="Learn More" data-hi="अधिक जानें">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Learn More' : 'अधिक जानें'; ?>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Finance Content -->
        <div class="education-content" id="content-finance">
            <div class="row">
                <?php
                $resources = getEducationalResources('finance');
                foreach ($resources as $resource):
                ?>
                <div class="col-md-4 mb-4">
                    <div class="resource-card">
                        <div class="resource-image">
                            <img src="/assets/<?php echo $resource['image']; ?>" alt="<?php echo $resource['title']; ?>" class="img-fluid">
                        </div>
                        <div class="resource-content">
                            <h3 class="resource-title"><?php echo $resource['title']; ?></h3>
                            <p class="resource-description"><?php echo $resource['description']; ?></p>
                            <a href="<?php echo $resource['url']; ?>" class="resource-link" data-en="Learn More" data-hi="अधिक जानें">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Learn More' : 'अधिक जानें'; ?>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Resource Detail Content -->
        <?php if (isset($_GET['resource'])): ?>
        <div class="education-content" id="content-detail">
            <?php
            // Get the requested resource
            $resourceId = sanitizeInput($_GET['resource']);
            
            // Define detailed content for each resource
            $resourceDetails = [
                'sustainable_rice' => [
                    'title' => 'Sustainable Rice Cultivation Techniques',
                    'image' => 'rice_cultivation.svg',
                    'content' => [
                        'intro' => 'Rice is a staple crop in India, and sustainable cultivation practices can significantly improve yields while reducing environmental impact. This comprehensive guide covers modern techniques that balance productivity with sustainability.',
                        'sections' => [
                            [
                                'heading' => 'System of Rice Intensification (SRI)',
                                'content' => 'SRI is a methodology aimed at increasing rice yields while using fewer inputs like water and seeds. Key principles include: early, quick and healthy plant establishment; reduced plant density; improved soil conditions and weed control; and careful water management. Studies show SRI can increase yields by 20-50% while reducing water usage by up to 50%.'
                            ],
                            [
                                'heading' => 'Direct Seeded Rice (DSR)',
                                'content' => 'Unlike traditional transplanting, DSR involves sowing seeds directly into the field. Benefits include: reduced labor requirements; less water consumption; earlier crop maturity; and reduced methane emissions. DSR works best with proper land leveling, effective weed management, and appropriate seed treatment.'
                            ],
                            [
                                'heading' => 'Integrated Nutrient Management',
                                'content' => 'Balanced nutrient application improves soil health and crop productivity. Recommended practices include: soil testing before fertilizer application; using organic sources like farmyard manure and green manure; applying biofertilizers like Azolla; and following proper timing for fertilizer application based on crop growth stages.'
                            ],
                            [
                                'heading' => 'Water Management Techniques',
                                'content' => 'Efficient water management is crucial for sustainable rice farming. Techniques include: alternate wetting and drying (AWD) instead of continuous flooding; maintaining water depth based on crop stage; laser land leveling for uniform water distribution; and using furrow irrigated raised bed systems for water conservation.'
                            ],
                            [
                                'heading' => 'Pest Management Strategies',
                                'content' => 'Integrated Pest Management (IPM) reduces pesticide use while effectively controlling pests. Key strategies include: crop rotation to break pest cycles; using resistant varieties; encouraging natural enemies; monitoring pest populations; and using biological controls like Trichogramma and Pseudomonas.'
                            ]
                        ],
                        'conclusion' => 'Implementing these sustainable rice cultivation techniques can lead to higher yields, reduced input costs, and improved environmental outcomes. Start by adopting one or two practices that best suit your specific farming conditions, and gradually incorporate more as you gain experience.',
                        'resources' => [
                            'Indian Agricultural Research Institute (IARI) - https://www.iari.res.in',
                            'International Rice Research Institute (IRRI) - https://www.irri.org',
                            'National Food Security Mission - https://www.nfsm.gov.in'
                        ]
                    ]
                ],
                'cotton_pests' => [
                    'title' => 'Pest Management in Cotton Farming',
                    'image' => 'pest_management.svg',
                    'content' => [
                        'intro' => 'Cotton is vulnerable to numerous pests that can significantly reduce yield and quality. Integrated Pest Management (IPM) approaches provide effective, economical, and environmentally sound solutions for cotton farmers in India.',
                        'sections' => [
                            [
                                'heading' => 'Major Cotton Pests in India',
                                'content' => 'The most damaging cotton pests include bollworms (American, pink, and spotted), sucking pests (aphids, jassids, whiteflies, thrips), and other pests like mites and mealy bugs. Early identification is crucial for effective management. Regular field scouting, at least twice a week, is recommended to monitor pest populations.'
                            ],
                            [
                                'heading' => 'Cultural Control Methods',
                                'content' => 'Cultural practices that reduce pest pressure include: early and synchronized planting; proper spacing; crop rotation with non-host crops like cereals; destruction of crop residue after harvest; and growing trap crops like okra or marigold around cotton fields to divert pests.'
                            ],
                            [
                                'heading' => 'Biological Control Strategies',
                                'content' => 'Natural enemies can effectively control many cotton pests. Methods include: conservation of beneficial insects like ladybirds, spiders, and parasitic wasps; release of Trichogramma cards to control bollworms; use of microbial insecticides like Bacillus thuringiensis (Bt); and application of neem-based formulations as biopesticides.'
                            ],
                            [
                                'heading' => 'Chemical Control and Resistance Management',
                                'content' => 'When chemical control is necessary: follow economic threshold levels before spraying; select appropriate pesticides based on the target pest; alternate pesticides with different modes of action to prevent resistance; apply pesticides during the most vulnerable stage of the pest; and follow proper safety precautions during application.'
                            ],
                            [
                                'heading' => 'Bt Cotton: Benefits and Management',
                                'content' => 'Bt cotton varieties contain genes from Bacillus thuringiensis that produce proteins toxic to certain bollworms. While Bt cotton reduces insecticide use against bollworms, it requires proper management: maintain refuge areas (non-Bt cotton) to prevent resistance development; continue monitoring for secondary pests not controlled by Bt; and follow integrated management for sucking pests which are not controlled by Bt technology.'
                            ]
                        ],
                        'conclusion' => 'Successful pest management in cotton requires a holistic approach that integrates multiple strategies. Regular monitoring, timely intervention, and balanced use of cultural, biological, and chemical methods will lead to sustainable pest control while minimizing environmental impact and production costs.',
                        'resources' => [
                            'Central Institute for Cotton Research - https://www.cicr.org.in',
                            'National Centre for Integrated Pest Management - https://www.ncipm.org.in',
                            'Agricultural Technology Application Research Institute - https://www.atari.icar.gov.in'
                        ]
                    ]
                ],
                'water_conservation' => [
                    'title' => 'Water Conservation Techniques',
                    'image' => 'water_conservation.svg',
                    'content' => [
                        'intro' => 'Water scarcity is a growing challenge for Indian agriculture. Implementing water conservation techniques can improve crop productivity, reduce costs, and ensure sustainable farming in water-limited environments.',
                        'sections' => [
                            [
                                'heading' => 'Efficient Irrigation Systems',
                                'content' => 'Modern irrigation systems significantly reduce water consumption compared to flood irrigation. Options include: drip irrigation, which delivers water directly to the root zone with 40-60% water savings; sprinkler systems, suitable for medium-sized farms with 30-50% water savings; and micro-sprinklers for orchards and plantation crops. Government subsidies are available for installing these systems through state horticulture missions.'
                            ],
                            [
                                'heading' => 'Soil Moisture Conservation Practices',
                                'content' => 'Enhancing soil\'s water-holding capacity reduces irrigation needs. Effective methods include: adding organic matter through compost, farmyard manure, and crop residues; mulching with organic materials or plastic films to reduce evaporation; practicing conservation tillage to maintain soil structure; and contour farming on sloped land to prevent runoff.'
                            ],
                            [
                                'heading' => 'Rainwater Harvesting and Storage',
                                'content' => 'Capturing and storing rainwater provides critical irrigation reserves. Techniques include: farm ponds lined with plastic or clay to reduce seepage; check dams in natural drainage lines; recharge pits to enhance groundwater levels; and rooftop harvesting systems for farm buildings. The Pradhan Mantri Krishi Sinchai Yojana supports farmers in creating water harvesting structures.'
                            ],
                            [
                                'heading' => 'Crop Selection and Management',
                                'content' => 'The right crops and farming practices can dramatically reduce water requirements. Strategies include: selecting drought-tolerant crop varieties suitable for your region; practicing crop rotation with water-efficient crops; adjusting planting dates to maximize use of monsoon rainfall; implementing deficit irrigation during less critical growth stages; and adopting technologies like SRI (System of Rice Intensification) for water-intensive crops.'
                            ],
                            [
                                'heading' => 'Advanced Water Management Tools',
                                'content' => 'Technology can optimize irrigation scheduling and water use. Options include: soil moisture sensors to determine actual water needs; tensiometers for monitoring soil water tension; weather-based irrigation scheduling using local evapotranspiration data; and smartphone apps that provide irrigation recommendations based on crop, soil type, and local weather conditions.'
                            ]
                        ],
                        'conclusion' => 'Water conservation in agriculture requires a combination of appropriate technology, improved farming practices, and careful planning. By implementing these techniques, farmers can achieve "more crop per drop" while ensuring long-term sustainability of water resources.',
                        'resources' => [
                            'National Committee on Plasticulture Applications in Horticulture - https://www.ncpahindia.com',
                            'Central Soil & Water Conservation Research & Training Institute - https://www.icar.org.in/central-soil-water-conservation-research-training-institute',
                            'Water Technology Centre - IARI - https://www.iari.res.in/index.php/research/divisions/wtc'
                        ]
                    ]
                ],
                'precision_farming' => [
                    'title' => 'Introduction to Precision Farming',
                    'image' => 'precision_farming.svg',
                    'content' => [
                        'intro' => 'Precision farming uses technology to optimize field-level management with regard to crop farming. It aims to ensure profitability, sustainability and protection of the environment through targeted application of agricultural inputs based on soil and crop requirements.',
                        'sections' => [
                            [
                                'heading' => 'Basic Principles of Precision Farming',
                                'content' => 'Precision farming is built on three key principles: gathering information about variability within fields; analyzing this data to create management prescriptions; and implementing site-specific management practices. This approach recognizes that fields are not uniform, and different areas have different requirements for optimal crop production.'
                            ],
                            [
                                'heading' => 'Technologies Used in Precision Farming',
                                'content' => 'Several technologies enable precision farming: Global Positioning System (GPS) for accurate location mapping; Geographic Information Systems (GIS) for data management and visualization; sensors for soil properties, crop health, and yield monitoring; Variable Rate Technology (VRT) for precise application of inputs; and decision support systems that convert data into actionable recommendations.'
                            ],
                            [
                                'heading' => 'Getting Started with Precision Farming',
                                'content' => 'Farmers can begin implementing precision farming gradually: start with soil testing and mapping to identify variations in fertility; create management zones based on soil types, topography, and yield history; use simple technologies like GPS-guided tractors for more efficient operations; monitor yields to identify patterns; and keep detailed records for analysis and continuous improvement.'
                            ],
                            [
                                'heading' => 'Benefits and Economic Considerations',
                                'content' => 'Precision farming offers multiple benefits: reduced input costs through targeted application of fertilizers and pesticides; improved yields by addressing specific field conditions; minimized environmental impact by reducing excess chemicals; better farm records and traceability; and improved decision-making based on accurate data. While initial investment can be significant, government schemes like Sub-Mission on Agricultural Mechanization provide subsidies for precision farming equipment.'
                            ],
                            [
                                'heading' => 'Success Stories and Case Studies',
                                'content' => 'Several successful implementations exist across India: sugarcane farmers in Maharashtra using drip irrigation with fertigation have reported 25% water savings and 30% yield increases; potato growers in Gujarat using variable rate fertilizer application have reduced fertilizer use by 20%; and rice farmers in Tamil Nadu implementing site-specific nutrient management have improved nitrogen use efficiency by 25%.'
                            ]
                        ],
                        'conclusion' => 'Precision farming represents the future of agriculture in India, combining traditional farming knowledge with modern technology. It allows farmers to be more efficient with resources while improving productivity and sustainability. Start with simple steps, analyze the results, and gradually adopt more advanced technologies as you become comfortable with the approach.',
                        'resources' => [
                            'Precision Farming Development Centre, IARI - https://www.iari.res.in',
                            'National Committee on Plasticulture Applications in Horticulture - https://www.ncpahindia.com',
                            'Digital India Corporation - https://www.dic.gov.in'
                        ]
                    ]
                ],
                'drones' => [
                    'title' => 'Using Drones in Agriculture',
                    'image' => 'drones.svg',
                    'content' => [
                        'intro' => 'Agricultural drones are revolutionizing farming by providing aerial insights, automating labor-intensive tasks, and enabling precise management of crops. This guide introduces Indian farmers to drone technology and its practical applications in agriculture.',
                        'sections' => [
                            [
                                'heading' => 'Types of Agricultural Drones',
                                'content' => 'Several drone types are used in agriculture: multi-rotor drones, which are affordable and easy to operate but have limited flight time; fixed-wing drones, which cover larger areas but require space for takeoff/landing; hybrid VTOL (Vertical Take-Off and Landing) drones, which combine advantages of both types; and specialized spraying drones designed for pesticide and fertilizer application.'
                            ],
                            [
                                'heading' => 'Key Applications in Farming',
                                'content' => 'Drones serve multiple agricultural functions: crop scouting to identify pest infestations, diseases, and nutrient deficiencies; field mapping to create detailed elevation models and identify drainage issues; crop spraying with 30-40% less chemicals and without soil compaction; seed planting in difficult terrain; and yield estimation prior to harvest. Each application requires specific sensors or attachments.'
                            ],
                            [
                                'heading' => 'Regulatory Framework in India',
                                'content' => 'Drone usage in India is regulated by the Directorate General of Civil Aviation (DGCA). Requirements include: registering drones on the Digital Sky platform; obtaining a Unique Identification Number (UIN) for drones weighing over 250g; securing an Unmanned Aircraft Operator Permit (UAOP) for certain operations; adhering to no-fly zones and flight altitude restrictions; and completing pilot training from an authorized institute. The "Drone Rules, 2021" have simplified regulations for agricultural drones.'
                            ],
                            [
                                'heading' => 'Cost Considerations and ROI',
                                'content' => 'Investment in drone technology varies: entry-level agricultural drones cost ₹50,000-2,00,000; professional models with specialized sensors range from ₹2,00,000-10,00,000; drone services can be hired at ₹1,000-3,000 per acre depending on application. ROI typically comes from reduced input costs, labor savings, improved crop yields, and timely interventions. Government subsidies are available through the Sub-Mission on Agricultural Mechanization and Rashtriya Krishi Vikas Yojana.'
                            ],
                            [
                                'heading' => 'Implementation Strategy',
                                'content' => 'Farmers can adopt a phased approach: start by hiring drone services for specific needs to understand benefits; join farmer groups to share costs; begin with simple applications like crop scouting before advancing to more complex uses; ensure proper training for operators; and keep detailed records to measure impact on productivity and profitability.'
                            ]
                        ],
                        'conclusion' => 'Drone technology offers Indian farmers powerful tools to increase efficiency, reduce costs, and improve crop management. While the initial investment and learning curve must be considered, the potential benefits make drones an increasingly valuable technology for progressive farmers. Start small, gain experience, and expand usage as you see results.',
                        'resources' => [
                            'Digital Sky Portal - https://digitalsky.dgca.gov.in',
                            'Agricultural Engineering Division, ICAR - https://icar.org.in',
                            'Drone Federation of India - https://www.dronefederationofindia.org'
                        ]
                    ]
                ],
                'mobile_apps' => [
                    'title' => 'Mobile Apps for Farmers',
                    'image' => 'mobile_apps.svg',
                    'content' => [
                        'intro' => 'Smartphones have become powerful tools for agriculture, with mobile apps providing farmers access to information, markets, and services. This guide highlights essential mobile applications that can help Indian farmers improve productivity and decision-making.',
                        'sections' => [
                            [
                                'heading' => 'Weather and Climate Apps',
                                'content' => 'Weather apps provide crucial forecasts for planning farm activities: Mausam app by the India Meteorological Department offers location-specific forecasts and weather warnings; Meghdoot provides agro-meteorological advisories specific to your crops and region; FASAL provides weather predictions with agricultural recommendations; and Weather & Radar gives detailed precipitation forecasts with radar visualization. These apps help optimize irrigation scheduling, pesticide application, and harvest timing.'
                            ],
                            [
                                'heading' => 'Crop Management and Advisory Apps',
                                'content' => 'These apps offer guidance on farming practices: Kisan Suvidha provides information on weather, market prices, agro-advisories, and plant protection; IFFCO Kisan offers expert advice, market rates, and agriculture news in multiple languages; Plantix helps identify plant diseases through photo analysis and suggests remedies; and Crop Insurance provides details about the Pradhan Mantri Fasal Bima Yojana and allows online application for coverage.'
                            ],
                            [
                                'heading' => 'Market Access and Price Information',
                                'content' => 'Market-focused apps connect farmers to buyers and price information: e-NAM (National Agriculture Market) facilitates online trading of agricultural commodities; AgriApp connects farmers directly with buyers, eliminating middlemen; RML Farmer provides commodity prices across multiple markets; and Agri Market shows mandi prices for all major agricultural products across India, helping farmers decide when and where to sell.'
                            ],
                            [
                                'heading' => 'Soil and Nutrient Management',
                                'content' => 'These apps help optimize fertilizer use and soil health: Soil Health Card app allows farmers to access their soil test results and recommended fertilizer dosages; Nutrient Manager calculates optimal fertilizer application based on crop, soil type, and target yield; mrittika provides soil fertility maps and nutrient management recommendations; and Fertilizer Calculator helps determine the most economical fertilizer combinations for specific crops.'
                            ],
                            [
                                'heading' => 'Farm Management and Record Keeping',
                                'content' => 'These apps help track farm operations and finances: FarmERP assists in planning farm activities, managing inventory, and tracking expenses; Kheti-Badi allows record-keeping of farm inputs, activities, and yields; Farmbrite helps manage livestock, crops, equipment, and finances in one platform; and AgriYield enables farmers to maintain digital farm diaries and analyze profitability by crop and field.'
                            ]
                        ],
                        'conclusion' => 'Mobile apps offer farmers powerful tools to access information, markets, and services previously unavailable to them. Start by identifying your most pressing needs—whether it\'s weather forecasting, pest management, or market access—and gradually incorporate these digital tools into your farming operations. Most apps are free or have minimal costs, making them accessible to farmers with even basic smartphones.',
                        'resources' => [
                            'Digital Agriculture Mission - https://agricoop.nic.in',
                            'mKisan Portal - https://mkisan.gov.in',
                            'ICAR-Agricultural Technology Application Research Institutes - https://www.icar.org.in'
                        ]
                    ]
                ],
                'subsidies' => [
                    'title' => 'Agricultural Subsidies in India',
                    'image' => 'subsidies.svg',
                    'content' => [
                        'intro' => 'The Indian government offers numerous subsidies to support farmers and enhance agricultural productivity. Understanding and accessing these subsidies can significantly reduce input costs and increase farm profitability. This guide covers the major agricultural subsidy programs available to Indian farmers.',
                        'sections' => [
                            [
                                'heading' => 'Input Subsidies',
                                'content' => 'These subsidies reduce the cost of essential farm inputs: Fertilizer subsidies reduce prices of urea, phosphatic, and potassic fertilizers, with manufacturers receiving compensation for selling at below-market rates; Seed subsidies provide quality seeds at reduced costs, with higher subsidies for certified seeds of high-yielding varieties; Irrigation subsidies help install drip/sprinkler systems with 55-70% of costs covered (higher for small/marginal farmers); and Farm mechanization subsidies offer 25-50% of the cost of equipment like tractors, power tillers, harvesters, and other machinery.'
                            ],
                            [
                                'heading' => 'Major Schemes and Programs',
                                'content' => 'Key government initiatives include: PM-KISAN, which provides ₹6,000 annually to farmer families in three installments; Pradhan Mantri Krishi Sinchai Yojana (PMKSY) for irrigation infrastructure with the motto "Har Khet Ko Pani"; Pradhan Mantri Fasal Bima Yojana (PMFBY) for crop insurance with minimal premium rates; and Kisan Credit Card (KCC) scheme for short-term loans at subsidized interest rates with interest subvention of 2% and an additional 3% for prompt repayment.'
                            ],
                            [
                                'heading' => 'Specialized Subsidies for Different Farming Systems',
                                'content' => 'Targeted programs support specific farming approaches: National Mission for Sustainable Agriculture offers subsidies for climate-resilient farming practices; National Mission on Oilseeds and Oil Palm provides financial assistance for increasing oilseed production; subsidies for organic farming cover certification costs and organic input production; and horticultural subsidies under the Mission for Integrated Development of Horticulture (MIDH) support nurseries, protected cultivation, and post-harvest management.'
                            ],
                            [
                                'heading' => 'How to Apply for Subsidies',
                                'content' => 'The application process typically involves: registering on relevant portals (PM-KISAN, DBT Agri portals); submitting applications through the nearest Krishi Vigyan Kendra, Agriculture Department office, or Common Service Centers; providing required documents including land records, identity proof, bank details, and Aadhaar; and following up with implementing agencies. Most schemes now use Direct Benefit Transfer (DBT) to transfer subsidies directly to farmers\' bank accounts.'
                            ],
                            [
                                'heading' => 'Maximizing Subsidy Benefits',
                                'content' => 'To make the most of available subsidies: keep land records and documents updated; register on the PM-KISAN portal to access multiple schemes; maintain an active Kisan Credit Card; open accounts in cooperative or rural banks for specialized agricultural loans and subsidies; join Farmer Producer Organizations (FPOs) to access group-based subsidies; and stay informed through the Kisan Call Centers (toll-free number: 1800-180-1551) or the Kisan Suvidha mobile app.'
                            ]
                        ],
                        'conclusion' => 'Agricultural subsidies can significantly reduce farming costs and improve profitability, but many farmers miss out due to lack of awareness or difficulty navigating application processes. Make connections with your local Agricultural Department officers, visit Krishi Vigyan Kendras regularly, and use digital platforms to stay updated on available schemes. Remember that subsidy programs change periodically, so maintaining current information is essential.',
                        'resources' => [
                            'PM-KISAN Portal - https://pmkisan.gov.in',
                            'Department of Agriculture & Farmers Welfare - https://agricoop.nic.in',
                            'Ministry of Rural Development - https://rural.nic.in',
                            'Farmers\' Portal - https://farmer.gov.in'
                        ]
                    ]
                ],
                'insurance' => [
                    'title' => 'Crop Insurance Programs',
                    'image' => 'insurance.svg',
                    'content' => [
                        'intro' => 'Crop insurance protects farmers from financial losses due to crop failure caused by natural disasters, pests, and diseases. India has several government-backed insurance schemes that provide affordable coverage to farmers. This guide explains these programs and how to benefit from them.',
                        'sections' => [
                            [
                                'heading' => 'Pradhan Mantri Fasal Bima Yojana (PMFBY)',
                                'content' => 'Launched in 2016, PMFBY is India\'s flagship crop insurance scheme. Key features include: low and uniform premium rates (2% for kharif crops, 1.5% for rabi crops, and 5% for commercial/horticultural crops); comprehensive risk coverage from pre-sowing to post-harvest losses; use of technology like smartphones, drones, and satellite imagery for quick assessment; mandatory for farmers with crop loans but voluntary for others; and coverage for localized calamities like landslides and hailstorms. Apply through banks, insurance companies, Common Service Centers, or the PMFBY app.'
                            ],
                            [
                                'heading' => 'Restructured Weather Based Crop Insurance Scheme (RWBCIS)',
                                'content' => 'RWBCIS offers protection against specific weather perils rather than crop yield losses. Features include: payouts based on weather parameters (rainfall, temperature, humidity) rather than crop damage assessment; automatic weather stations for accurate data collection; similar premium rates as PMFBY; faster claim processing as it doesn\'t require crop cutting experiments; and particularly suitable for areas with limited historical yield data. This scheme works well for crops sensitive to specific weather conditions like temperature-dependent fruits or rainfall-dependent pulses.'
                            ],
                            [
                                'heading' => 'Coconut Palm Insurance Scheme (CPIS)',
                                'content' => 'This specialized scheme covers coconut palms against natural disasters and pest/disease outbreaks. It offers: coverage for palms aged 4-60 years; premium sharing between central government, state government, and farmers; compensation of ₹900-₹1,750 per damaged palm depending on age; coverage period of 12 months; and implementation through Coconut Development Board and designated insurance companies. Farmers with a minimum of 5 palms are eligible to apply.'
                            ],
                            [
                                'heading' => 'Unified Package Insurance Scheme (UPIS)',
                                'content' => 'UPIS is a comprehensive program integrating multiple insurance needs of farmers. It includes: crop insurance (mandatory) plus up to six optional coverages—life, accident, home, farm implements, tractor, and student safety; single premium payment for all coverages; simplified documentation through a unified approach; implementation in selected districts; and seamless coordination between different insurance providers through a nodal agency.'
                            ],
                            [
                                'heading' => 'How to Claim Insurance',
                                'content' => 'The claim process typically involves: immediate notification of loss through the PMFBY app, toll-free numbers, or local agriculture department; documentation of damage through photographs and official assessments; submitting claim forms within the specified timeframe (usually 72 hours of the event for localized claims); cooperation during assessment by insurance officials or government representatives; and tracking claim status through online portals or apps. For widespread calamities, claims are triggered automatically based on yield data without farmer applications.'
                            ]
                        ],
                        'conclusion' => 'Crop insurance is an essential risk management tool for every farmer. With subsidized premiums and comprehensive coverage, these schemes provide affordable protection against unpredictable natural events. Make crop insurance a regular part of your farming strategy, regardless of whether you take agricultural loans. The small premium investment can protect your livelihood when facing crop losses due to events beyond your control.',
                        'resources' => [
                            'PMFBY Portal - https://pmfby.gov.in',
                            'Common Service Centers - https://www.csc.gov.in',
                            'Agriculture Insurance Company of India - https://www.aicofindia.com',
                            'PMFBY Mobile App (available on Google Play Store)'
                        ]
                    ]
                ],
                'financial_planning' => [
                    'title' => 'Financial Planning for Farmers',
                    'image' => 'financial_planning.svg',
                    'content' => [
                        'intro' => 'Sound financial management is essential for sustainable and profitable farming. This guide provides Indian farmers with practical financial planning strategies to manage seasonal income, control costs, build savings, and ensure long-term financial security.',
                        'sections' => [
                            [
                                'heading' => 'Budgeting and Cash Flow Management',
                                'content' => 'Effective cash flow management is critical due to farming\'s seasonal nature. Key strategies include: creating an annual farm budget with monthly breakdown of expected income and expenses; maintaining separate personal and farm finances; planning for critical expenditure periods like planting season; building cash reserves for 3-6 months of operating expenses; and reviewing budget vs. actual expenses regularly to identify patterns and make adjustments. Simple accounting apps like Khata Book or farm-specific tools like FarmERP can help with record keeping.'
                            ],
                            [
                                'heading' => 'Cost Management and Efficiency',
                                'content' => 'Controlling costs directly impacts profitability. Effective approaches include: tracking all farm expenses by category (seeds, fertilizers, labor, etc.); analyzing cost per unit of production for each crop; identifying and eliminating wasteful practices; exploring cooperative purchasing with other farmers for bulk discounts; comparing input suppliers for best value; conducting soil tests to optimize fertilizer application; and implementing water and energy efficiency measures to reduce utility costs.'
                            ],
                            [
                                'heading' => 'Agricultural Credit and Debt Management',
                                'content' => 'Strategic use of credit can enhance farm operations, but requires careful management: obtain a Kisan Credit Card for short-term credit needs at subsidized interest rates; differentiate between productive loans (for assets/improvements that generate returns) and consumption loans; compare loan products from cooperatives, regional rural banks, and commercial banks; understand loan terms including interest rates, repayment schedules, and penalties; and create a debt repayment plan aligned with your farm\'s cash flow cycles.'
                            ],
                            [
                                'heading' => 'Risk Management Strategies',
                                'content' => 'Protecting against financial risks involves multiple approaches: diversify crop/livestock to reduce market and weather risks; purchase appropriate insurance coverage through PMFBY or WBCIS; explore forward contracts or futures markets for price stability; maintain emergency funds for unexpected expenses; consider weather-indexed insurance products; and develop alternative income sources that can provide stability when farming income fluctuates.'
                            ],
                            [
                                'heading' => 'Long-term Financial Planning',
                                'content' => 'Building financial security requires looking beyond the current season: contribute to pension schemes like Pradhan Mantri Kisan Maan-Dhan Yojana (PM-KMY), which requires small monthly contributions for a guaranteed monthly pension after age 60; invest in assets that appreciate or generate passive income; establish systematic savings habits, even with small amounts; plan for farm succession and related tax implications; and build a retirement corpus through instruments like National Pension System (NPS) or Atal Pension Yojana.'
                            ]
                        ],
                        'conclusion' => 'Financial planning transforms farming from a season-to-season activity to a sustainable business enterprise. Start with basic budgeting and record-keeping, then gradually implement more sophisticated financial strategies as your comfort level increases. Seek guidance from agricultural extension services, rural banks, or financial advisors with agricultural expertise. Remember that consistent financial discipline, even with modest resources, compounds over time to create significant financial security.',
                        'resources' => [
                            'National Bank for Agriculture and Rural Development (NABARD) - https://www.nabard.org',
                            'Small Farmers\' Agribusiness Consortium - https://www.sfacindia.com',
                            'Kisan Call Center (toll-free) - 1800-180-1551',
                            'Banking Correspondent Sakhis or Bank Mitras in your village'
                        ]
                    ]
                ]
            ];
            
            // Display the resource if it exists
            if (isset($resourceDetails[$resourceId])) {
                $resource = $resourceDetails[$resourceId];
                ?>
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0"><?php echo $resource['title']; ?></h2>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <img src="/assets/<?php echo $resource['image']; ?>" alt="<?php echo $resource['title']; ?>" class="img-fluid" style="max-height: 200px;">
                        </div>
                        
                        <div class="resource-detail-content">
                            <p class="lead"><?php echo $resource['content']['intro']; ?></p>
                            
                            <?php foreach ($resource['content']['sections'] as $section): ?>
                            <h3 class="mt-4"><?php echo $section['heading']; ?></h3>
                            <p><?php echo $section['content']; ?></p>
                            <?php endforeach; ?>
                            
                            <h3 class="mt-4" data-en="Conclusion" data-hi="निष्कर्ष">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Conclusion' : 'निष्कर्ष'; ?>
                            </h3>
                            <p><?php echo $resource['content']['conclusion']; ?></p>
                            
                            <h3 class="mt-4" data-en="Additional Resources" data-hi="अतिरिक्त संसाधन">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Additional Resources' : 'अतिरिक्त संसाधन'; ?>
                            </h3>
                            <ul>
                                <?php foreach ($resource['content']['resources'] as $res): ?>
                                <li><?php echo $res; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                // Resource not found
                echo '<div class="alert alert-warning" role="alert">';
                echo 'The requested resource could not be found. Please select a resource from the main categories.';
                echo '</div>';
            }
            ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Related Resources Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="section-title">
            <h2 data-en="Government Agricultural Resources" data-hi="सरकारी कृषि संसाधन">
                <?php echo ($_SESSION['language'] == 'en') ? 'Government Agricultural Resources' : 'सरकारी कृषि संसाधन'; ?>
            </h2>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="card-title h5">
                            <i data-feather="book" class="me-2 text-primary"></i>
                            <span data-en="Krishi Vigyan Kendras (KVKs)" data-hi="कृषि विज्ञान केंद्र">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Krishi Vigyan Kendras (KVKs)' : 'कृषि विज्ञान केंद्र'; ?>
                            </span>
                        </h3>
                        <p class="card-text" data-en="District-level farm science centers providing technology assessment, refinement, and demonstration. Contact your local KVK for personalized farming advice." data-hi="जिला स्तरीय कृषि विज्ञान केंद्र जो प्रौद्योगिकी मूल्यांकन, परिष्करण और प्रदर्शन प्रदान करते हैं। व्यक्तिगत कृषि सलाह के लिए अपने स्थानीय KVK से संपर्क करें।">
                            <?php echo ($_SESSION['language'] == 'en') ? 'District-level farm science centers providing technology assessment, refinement, and demonstration. Contact your local KVK for personalized farming advice.' : 'जिला स्तरीय कृषि विज्ञान केंद्र जो प्रौद्योगिकी मूल्यांकन, परिष्करण और प्रदर्शन प्रदान करते हैं। व्यक्तिगत कृषि सलाह के लिए अपने स्थानीय KVK से संपर्क करें।'; ?>
                        </p>
                        <a href="https://kvk.icar.gov.in/" target="_blank" class="btn btn-outline-primary" data-en="Find Your KVK" data-hi="अपना KVK खोजें">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Find Your KVK' : 'अपना KVK खोजें'; ?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="card-title h5">
                            <i data-feather="phone" class="me-2 text-primary"></i>
                            <span data-en="Kisan Call Center" data-hi="किसान कॉल सेंटर">
                                <?php echo ($_SESSION['language'] == 'en') ? 'Kisan Call Center' : 'किसान कॉल सेंटर'; ?>
                            </span>
                        </h3>
                        <p class="card-text" data-en="Get expert advice on agriculture-related issues in your local language by calling the toll-free number 1800-180-1551." data-hi="टोल-फ्री नंबर 1800-180-1551 पर कॉल करके अपनी स्थानीय भाषा में कृषि संबंधी मुद्दों पर विशेषज्ञ सलाह प्राप्त करें।">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Get expert advice on agriculture-related issues in your local language by calling the toll-free number 1800-180-1551.' : 'टोल-फ्री नंबर 1800-180-1551 पर कॉल करके अपनी स्थानीय भाषा में कृषि संबंधी मुद्दों पर विशेषज्ञ सलाह प्राप्त करें।'; ?>
                        </p>
                        <a href="https://dackkms.gov.in/" target="_blank" class="btn btn-outline-primary" data-en="Learn More" data-hi="अधिक जानें">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Learn More' : 'अधिक जानें'; ?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="card-title h5">
                            <i data-feather="smartphone" class="me-2 text-primary"></i>
                            <span data-en="mKisan Portal" data-hi="एम-किसान पोर्टल">
                                <?php echo ($_SESSION['language'] == 'en') ? 'mKisan Portal' : 'एम-किसान पोर्टल'; ?>
                            </span>
                        </h3>
                        <p class="card-text" data-en="Receive SMS advisories on weather, market prices, and farming practices directly on your mobile phone through this government service." data-hi="इस सरकारी सेवा के माध्यम से अपने मोबाइल फोन पर सीधे मौसम, बाजार मूल्य और कृषि प्रथाओं पर एसएमएस सलाह प्राप्त करें।">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Receive SMS advisories on weather, market prices, and farming practices directly on your mobile phone through this government service.' : 'इस सरकारी सेवा के माध्यम से अपने मोबाइल फोन पर सीधे मौसम, बाजार मूल्य और कृषि प्रथाओं पर एसएमएस सलाह प्राप्त करें।'; ?>
                        </p>
                        <a href="https://mkisan.gov.in/" target="_blank" class="btn btn-outline-primary" data-en="Register Now" data-hi="अभी पंजीकरण करें">
                            <?php echo ($_SESSION['language'] == 'en') ? 'Register Now' : 'अभी पंजीकरण करें'; ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Educational Videos Section -->
<section class="py-5">
    <div class="container">
        <div class="section-title">
            <h2 data-en="Educational Videos" data-hi="शैक्षिक वीडियो">
                <?php echo ($_SESSION['language'] == 'en') ? 'Educational Videos' : 'शैक्षिक वीडियो'; ?>
            </h2>
        </div>
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h3 class="card-title h5" data-en="Soil Health Management" data-hi="मिट्टी स्वास्थ्य प्रबंधन">
                                            <?php echo ($_SESSION['language'] == 'en') ? 'Soil Health Management' : 'मिट्टी स्वास्थ्य प्रबंधन'; ?>
                                        </h3>
                                        <p data-en="Learn about soil testing, organic matter management, and balanced fertilizer application for maintaining healthy soil." data-hi="स्वस्थ मिट्टी बनाए रखने के लिए मिट्टी परीक्षण, जैविक पदार्थ प्रबंधन और संतुलित उर्वरक अनुप्रयोग के बारे में जानें।">
                                            <?php echo ($_SESSION['language'] == 'en') ? 'Learn about soil testing, organic matter management, and balanced fertilizer application for maintaining healthy soil.' : 'स्वस्थ मिट्टी बनाए रखने के लिए मिट्टी परीक्षण, जैविक पदार्थ प्रबंधन और संतुलित उर्वरक अनुप्रयोग के बारे में जानें।'; ?>
                                        </p>
                                        <a href="https://www.youtube.com/watch?v=7IuDMN37UxE" target="_blank" class="btn btn-outline-primary" data-en="Watch Video" data-hi="वीडियो देखें">
                                            <?php echo ($_SESSION['language'] == 'en') ? 'Watch Video' : 'वीडियो देखें'; ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h3 class="card-title h5" data-en="Integrated Pest Management" data-hi="एकीकृत कीट प्रबंधन">
                                            <?php echo ($_SESSION['language'] == 'en') ? 'Integrated Pest Management' : 'एकीकृत कीट प्रबंधन'; ?>
                                        </h3>
                                        <p data-en="Discover how to control pests using a combination of biological controls, cultural practices, and judicious use of pesticides." data-hi="जैविक नियंत्रण, सांस्कृतिक प्रथाओं और कीटनाशकों के विवेकपूर्ण उपयोग के संयोजन का उपयोग करके कीटों को नियंत्रित करने के तरीके जानें।">
                                            <?php echo ($_SESSION['language'] == 'en') ? 'Discover how to control pests using a combination of biological controls, cultural practices, and judicious use of pesticides.' : 'जैविक नियंत्रण, सांस्कृतिक प्रथाओं और कीटनाशकों के विवेकपूर्ण उपयोग के संयोजन का उपयोग करके कीटों को नियंत्रित करने के तरीके जानें।'; ?>
                                        </p>
                                        <a href="https://www.youtube.com/watch?v=SgHaYCHAMHg" target="_blank" class="btn btn-outline-primary" data-en="Watch Video" data-hi="वीडियो देखें">
                                            <?php echo ($_SESSION['language'] == 'en') ? 'Watch Video' : 'वीडियो देखें'; ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h3 class="card-title h5" data-en="Water Management in Agriculture" data-hi="कृषि में जल प्रबंधन">
                                            <?php echo ($_SESSION['language'] == 'en') ? 'Water Management in Agriculture' : 'कृषि में जल प्रबंधन'; ?>
                                        </h3>
                                        <p data-en="Learn efficient irrigation techniques, rainwater harvesting, and water conservation methods for sustainable farming." data-hi="टिकाऊ खेती के लिए कुशल सिंचाई तकनीकों, वर्षा जल संचयन और जल संरक्षण के तरीकों के बारे में जानें।">
                                            <?php echo ($_SESSION['language'] == 'en') ? 'Learn efficient irrigation techniques, rainwater harvesting, and water conservation methods for sustainable farming.' : 'टिकाऊ खेती के लिए कुशल सिंचाई तकनीकों, वर्षा जल संचयन और जल संरक्षण के तरीकों के बारे में जानें।'; ?>
                                        </p>
                                        <a href="https://www.youtube.com/watch?v=LFDZk0hJ9UM" target="_blank" class="btn btn-outline-primary" data-en="Watch Video" data-hi="वीडियो देखें">
                                            <?php echo ($_SESSION['language'] == 'en') ? 'Watch Video' : 'वीडियो देखें'; ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h3 class="card-title h5" data-en="Value Addition in Agriculture" data-hi="कृषि में मूल्य संवर्धन">
                                            <?php echo ($_SESSION['language'] == 'en') ? 'Value Addition in Agriculture' : 'कृषि में मूल्य संवर्धन'; ?>
                                        </h3>
                                        <p data-en="Explore simple processing techniques to increase the value of your farm products and improve your income." data-hi="अपने कृषि उत्पादों के मूल्य को बढ़ाने और अपनी आय में सुधार करने के लिए सरल प्रसंस्करण तकनीकों का पता लगाएं।">
                                            <?php echo ($_SESSION['language'] == 'en') ? 'Explore simple processing techniques to increase the value of your farm products and improve your income.' : 'अपने कृषि उत्पादों के मूल्य को बढ़ाने और अपनी आय में सुधार करने के लिए सरल प्रसंस्करण तकनीकों का पता लगाएं।'; ?>
                                        </p>
                                        <a href="https://www.youtube.com/watch?v=vcWDnxJHu48" target="_blank" class="btn btn-outline-primary" data-en="Watch Video" data-hi="वीडियो देखें">
                                            <?php echo ($_SESSION['language'] == 'en') ? 'Watch Video' : 'वीडियो देखें'; ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <a href="https://www.youtube.com/c/icarofficial" target="_blank" class="btn btn-primary" data-en="More Educational Videos" data-hi="अधिक शैक्षिक वीडियो">
                                <?php echo ($_SESSION['language'] == 'en') ? 'More Educational Videos' : 'अधिक शैक्षिक वीडियो'; ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set up tab switching functionality
    const tabs = document.querySelectorAll('.education-tab');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active class from all tabs
            tabs.forEach(t => t.classList.remove('active'));
            // Add active class to clicked tab
            this.classList.add('active');
            
            // Hide all content sections
            document.querySelectorAll('.education-content').forEach(content => {
                content.classList.remove('active');
            });
            
            // Show the corresponding content section
            const targetId = this.getAttribute('data-target');
            document.getElementById(targetId).classList.add('active');
        });
    });
    
    // If resource parameter is present, show the detail tab
    <?php if (isset($_GET['resource'])): ?>
    document.getElementById('tab-detail').click();
    <?php endif; ?>
});
</script>

<?php
// Include footer
include_once 'includes/footer.php';
?>
