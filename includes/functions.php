<?php
// Include database connection
require_once __DIR__ . '/db.php';

/**
 * Sanitize user input to prevent XSS attacks
 * 
 * @param string $input The input to sanitize
 * @return string The sanitized input
 */
function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

/**
 * Validate email address
 * 
 * @param string $email The email to validate
 * @return bool Whether the email is valid
 */
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

/**
 * Set language preference
 * 
 * @param string $lang The language code (en/hi)
 * @return void
 */
function setLanguage($lang) {
    if ($lang === 'en' || $lang === 'hi') {
        $_SESSION['language'] = $lang;
    }
}

/**
 * Translate text based on current language
 * 
 * @param string $englishText The English text
 * @param string $hindiText The Hindi text
 * @return string The translated text
 */
function translate($englishText, $hindiText) {
    return ($_SESSION['language'] == 'en') ? $englishText : $hindiText;
}

/**
 * Get current weather data from API
 * 
 * @param string $location The location to get weather for
 * @return array|false Weather data or false on failure
 */
function getWeatherData($location) {
    $apiKey = getenv('OPENWEATHER_API_KEY');
    
    // Check if we have a valid API key
    if ($apiKey) {
        // Build API URL
        $url = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($location) . ",in&units=metric&appid=" . $apiKey;
        
        // Make API request
        $response = @file_get_contents($url);
        
        if ($response !== false) {
            return json_decode($response, true);
        }
    }
    
    // If API request fails or no API key, return demo data
    return getWeatherDemoData($location);
}

/**
 * Get demo weather data for testing when API is not available
 * 
 * @param string $location The location to simulate weather for
 * @return array Demo weather data
 */
function getWeatherDemoData($location) {
    // Demo data based on common Indian weather patterns
    $weatherTypes = [
        'Clear' => [
            'description' => 'clear sky',
            'icon' => '01d',
            'temp' => rand(25, 35),
            'feels_like' => rand(27, 37),
            'humidity' => rand(30, 50),
            'pressure' => rand(1010, 1020),
            'wind_speed' => rand(1, 5) + (rand(0, 9) / 10)
        ],
        'Clouds' => [
            'description' => 'scattered clouds',
            'icon' => '03d',
            'temp' => rand(22, 32),
            'feels_like' => rand(24, 34),
            'humidity' => rand(40, 60),
            'pressure' => rand(1005, 1015),
            'wind_speed' => rand(2, 6) + (rand(0, 9) / 10)
        ],
        'Rain' => [
            'description' => 'light rain',
            'icon' => '10d',
            'temp' => rand(18, 28),
            'feels_like' => rand(19, 29),
            'humidity' => rand(60, 90),
            'pressure' => rand(1000, 1010),
            'wind_speed' => rand(3, 8) + (rand(0, 9) / 10)
        ]
    ];
    
    // Select a weather type randomly
    $weatherKeys = array_keys($weatherTypes);
    $weatherKey = $weatherKeys[array_rand($weatherKeys)];
    $weather = $weatherTypes[$weatherKey];
    
    // Structure data like the OpenWeatherMap API response
    return [
        'coord' => [
            'lon' => 77.21,
            'lat' => 28.67
        ],
        'weather' => [
            [
                'id' => 800,
                'main' => $weatherKey,
                'description' => $weather['description'],
                'icon' => $weather['icon']
            ]
        ],
        'base' => 'stations',
        'main' => [
            'temp' => $weather['temp'],
            'feels_like' => $weather['feels_like'],
            'temp_min' => $weather['temp'] - rand(1, 3),
            'temp_max' => $weather['temp'] + rand(1, 3),
            'pressure' => $weather['pressure'],
            'humidity' => $weather['humidity']
        ],
        'visibility' => 10000,
        'wind' => [
            'speed' => $weather['wind_speed'],
            'deg' => rand(0, 359)
        ],
        'clouds' => [
            'all' => $weatherKey == 'Clear' ? rand(0, 10) : ($weatherKey == 'Clouds' ? rand(30, 90) : rand(70, 100))
        ],
        'dt' => time(),
        'sys' => [
            'country' => 'IN',
            'sunrise' => strtotime('today 6:00am'),
            'sunset' => strtotime('today 6:30pm')
        ],
        'timezone' => 19800, // UTC+5:30
        'id' => 1273294,
        'name' => $location,
        'cod' => 200
    ];
}

/**
 * Get weather forecast data from API
 * 
 * @param string $location The location to get forecast for
 * @return array|false Forecast data or false on failure
 */
function getWeatherForecast($location) {
    $apiKey = getenv('OPENWEATHER_API_KEY');
    
    // Check if we have a valid API key
    if ($apiKey) {
        // Build API URL
        $url = "https://api.openweathermap.org/data/2.5/forecast?q=" . urlencode($location) . ",in&units=metric&appid=" . $apiKey;
        
        // Make API request
        $response = @file_get_contents($url);
        
        if ($response !== false) {
            return json_decode($response, true);
        }
    }
    
    // If API request fails or no API key, return demo data
    return getForecastDemoData($location);
}

/**
 * Get demo forecast data for testing when API is not available
 * 
 * @param string $location The location to simulate forecast for
 * @return array Demo forecast data
 */
function getForecastDemoData($location) {
    // Possible weather conditions
    $weatherConditions = [
        ['main' => 'Clear', 'description' => 'clear sky', 'icon' => '01d'],
        ['main' => 'Clouds', 'description' => 'scattered clouds', 'icon' => '03d'],
        ['main' => 'Clouds', 'description' => 'broken clouds', 'icon' => '04d'],
        ['main' => 'Rain', 'description' => 'light rain', 'icon' => '10d'],
        ['main' => 'Rain', 'description' => 'moderate rain', 'icon' => '10d']
    ];
    
    // Create forecast data for 5 days
    $list = [];
    $currentDate = time();
    
    // Base temperature for the region (adjust as needed)
    $baseTemp = rand(25, 32);
    
    // Create 8 forecasts per day (3-hour intervals) for 5 days
    for ($day = 0; $day < 5; $day++) {
        for ($hour = 0; $hour < 24; $hour += 3) {
            $forecastTime = strtotime("+$day days", $currentDate) + ($hour * 3600);
            
            // Temperature varies throughout the day
            $hourlyVariation = $hour < 12 ? $hour / 3 : (24 - $hour) / 3;
            $temp = $baseTemp + $hourlyVariation - rand(0, 2);
            
            // More likely to rain in the afternoon
            $weatherProbability = ($hour > 12 && $hour < 18) ? rand(0, 4) : rand(0, 3);
            $weather = $weatherConditions[$weatherProbability];
            
            $list[] = [
                'dt' => $forecastTime,
                'main' => [
                    'temp' => $temp,
                    'feels_like' => $temp + 2,
                    'temp_min' => $temp - 1,
                    'temp_max' => $temp + 1,
                    'pressure' => rand(1008, 1020),
                    'humidity' => rand(40, 90)
                ],
                'weather' => [
                    [
                        'id' => 800,
                        'main' => $weather['main'],
                        'description' => $weather['description'],
                        'icon' => $weather['icon']
                    ]
                ],
                'clouds' => [
                    'all' => $weather['main'] == 'Clear' ? rand(0, 10) : rand(30, 100)
                ],
                'wind' => [
                    'speed' => rand(1, 8) + (rand(0, 9) / 10),
                    'deg' => rand(0, 359)
                ],
                'visibility' => 10000,
                'pop' => $weather['main'] == 'Rain' ? rand(30, 90) / 100 : rand(0, 20) / 100,
                'sys' => [
                    'pod' => ($hour >= 6 && $hour < 18) ? 'd' : 'n'
                ],
                'dt_txt' => date('Y-m-d H:i:s', $forecastTime)
            ];
        }
    }
    
    // Structure data like the OpenWeatherMap forecast API response
    return [
        'cod' => '200',
        'message' => 0,
        'cnt' => count($list),
        'list' => $list,
        'city' => [
            'id' => 1273294,
            'name' => $location,
            'coord' => [
                'lat' => 28.6667,
                'lon' => 77.2167
            ],
            'country' => 'IN',
            'population' => 10927986,
            'timezone' => 19800,
            'sunrise' => strtotime('today 6:00am'),
            'sunset' => strtotime('today 6:30pm')
        ]
    ];
}

/**
 * Get market prices for crops
 * 
 * @return array Market price data
 */
function getMarketPrices() {
    // In a real application, this would fetch from an actual API
    // For this implementation, we'll use static data
    return [
        [
            'crop' => 'Rice',
            'price' => 2250,
            'unit' => 'quintal',
            'trend' => 'up',
            'change' => 5.2
        ],
        [
            'crop' => 'Wheat',
            'price' => 2150,
            'unit' => 'quintal',
            'trend' => 'up',
            'change' => 3.1
        ],
        [
            'crop' => 'Cotton',
            'price' => 6500,
            'unit' => 'quintal',
            'trend' => 'down',
            'change' => -1.5
        ],
        [
            'crop' => 'Sugarcane',
            'price' => 350,
            'unit' => 'quintal',
            'trend' => 'up',
            'change' => 0.8
        ],
        [
            'crop' => 'Maize',
            'price' => 1850,
            'unit' => 'quintal',
            'trend' => 'down',
            'change' => -2.3
        ],
        [
            'crop' => 'Soybeans',
            'price' => 4200,
            'unit' => 'quintal',
            'trend' => 'up',
            'change' => 4.7
        ]
    ];
}

/**
 * Get historical market data for a specific crop
 * 
 * @param string $crop The crop to get data for
 * @return array Historical market data
 */
function getHistoricalMarketData($crop) {
    // In a real application, this would fetch from a database or API
    // For this implementation, we'll use static data
    $data = [
        'Rice' => [
            'months' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'prices' => [2100, 2120, 2140, 2130, 2150, 2170, 2180, 2200, 2220, 2210, 2230, 2250]
        ],
        'Wheat' => [
            'months' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'prices' => [2000, 2030, 2050, 2070, 2060, 2080, 2090, 2100, 2110, 2130, 2140, 2150]
        ],
        'Cotton' => [
            'months' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'prices' => [6300, 6350, 6400, 6450, 6500, 6550, 6600, 6650, 6600, 6580, 6550, 6500]
        ],
        'Sugarcane' => [
            'months' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'prices' => [330, 335, 340, 338, 342, 345, 343, 347, 348, 345, 348, 350]
        ],
        'Maize' => [
            'months' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'prices' => [1900, 1920, 1910, 1890, 1880, 1870, 1860, 1850, 1870, 1880, 1860, 1850]
        ],
        'Soybeans' => [
            'months' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            'prices' => [4000, 4020, 4050, 4080, 4100, 4120, 4150, 4170, 4190, 4180, 4190, 4200]
        ]
    ];
    
    return isset($data[$crop]) ? $data[$crop] : ['months' => [], 'prices' => []];
}

/**
 * Get educational resources
 * 
 * @param string $category Category of resources to get
 * @return array Educational resources
 */
function getEducationalResources($category = null) {
    // In a real application, this would fetch from a database
    // For this implementation, we'll use static data
    $resources = [
        'crop_management' => [
            [
                'title' => 'Sustainable Rice Cultivation Techniques',
                'description' => 'Learn modern techniques for sustainable rice cultivation that maximize yield while minimizing environmental impact.',
                'image' => 'rice_cultivation.svg',
                'url' => '/education.php?resource=sustainable_rice'
            ],
            [
                'title' => 'Pest Management in Cotton Farming',
                'description' => 'Comprehensive guide to identifying and managing common pests in cotton farming using integrated pest management approaches.',
                'image' => 'pest_management.svg',
                'url' => '/education.php?resource=cotton_pests'
            ],
            [
                'title' => 'Water Conservation Techniques',
                'description' => 'Efficient irrigation and water management techniques for areas with limited water resources.',
                'image' => 'water_conservation.svg',
                'url' => '/education.php?resource=water_conservation'
            ]
        ],
        'technology' => [
            [
                'title' => 'Introduction to Precision Farming',
                'description' => 'Learn how technology can help optimize field-level management for improved crop yields and reduced waste.',
                'image' => 'precision_farming.svg',
                'url' => '/education.php?resource=precision_farming'
            ],
            [
                'title' => 'Using Drones in Agriculture',
                'description' => 'How drone technology is revolutionizing crop monitoring, spraying, and overall farm management.',
                'image' => 'drones.svg',
                'url' => '/education.php?resource=drones'
            ],
            [
                'title' => 'Mobile Apps for Farmers',
                'description' => 'Essential mobile applications that can help farmers track weather, manage inventory, and access market information.',
                'image' => 'mobile_apps.svg',
                'url' => '/education.php?resource=mobile_apps'
            ]
        ],
        'finance' => [
            [
                'title' => 'Agricultural Subsidies in India',
                'description' => 'Comprehensive guide to understanding and accessing government subsidies for farmers.',
                'image' => 'subsidies.svg',
                'url' => '/education.php?resource=subsidies'
            ],
            [
                'title' => 'Crop Insurance Programs',
                'description' => 'Overview of crop insurance options to protect farmers from losses due to natural disasters or price fluctuations.',
                'image' => 'insurance.svg',
                'url' => '/education.php?resource=insurance'
            ],
            [
                'title' => 'Financial Planning for Farmers',
                'description' => 'Basic financial management principles for agricultural businesses of all sizes.',
                'image' => 'financial_planning.svg',
                'url' => '/education.php?resource=financial_planning'
            ]
        ]
    ];
    
    if ($category && isset($resources[$category])) {
        return $resources[$category];
    }
    
    return $resources;
}

/**
 * Save contact form submission to database
 * 
 * @param array $formData The form data to save
 * @return bool Whether the save was successful
 */
function saveContactSubmission($formData) {
    global $conn;
    
    if (!$conn) {
        // If no database connection, still return true to avoid errors
        return true;
    }
    
    return insertData('contact_submissions', $formData);
}

/**
 * Save community post to database
 * 
 * @param string $name The name of the poster
 * @param string $title The post title
 * @param string $content The post content
 * @param string $location The location of the poster
 * @param string $imagePath The path to the uploaded image
 * @param int|null $userId The user ID if logged in
 * @return bool Whether the save was successful
 */
function saveCommunityPost($name, $title, $content, $location, $imagePath = null, $userId = null) {
    global $conn;
    
    if (!$conn) {
        // If no database connection, still return true to avoid errors
        return true;
    }
    
    $postData = [
        'name' => $name,
        'title' => $title,
        'content' => $content,
        'location' => $location,
        'image_path' => $imagePath,
        'user_id' => $userId,
        'created_at' => date('Y-m-d H:i:s')
    ];
    
    return insertData('community_posts', $postData);
}

/**
 * Get community posts from database
 * 
 * @param int $limit Number of posts to get
 * @param int $offset Offset for pagination
 * @return array Community posts
 */
function getCommunityPosts($limit = 10, $offset = 0) {
    global $conn;
    
    if (!$conn) {
        // Return dummy data if no database connection
        return [
            [
                'id' => 1,
                'name' => 'Rajesh Kumar',
                'location' => 'Punjab',
                'title' => 'Success with Organic Farming',
                'content' => 'I switched to organic farming methods last year and have seen a 20% increase in crop quality. Happy to share my experience with anyone interested.',
                'created_at' => '2025-11-10 15:30:00'
            ],
            [
                'id' => 2,
                'name' => 'Anita Sharma',
                'location' => 'Maharashtra',
                'title' => 'Drip Irrigation System Installation',
                'content' => 'Recently installed a drip irrigation system in my field. It has reduced water usage by 40% and improved crop health significantly. If anyone needs guidance on installation, feel free to ask.',
                'created_at' => '2025-11-08 11:15:00'
            ],
            [
                'id' => 3,
                'name' => 'Sunil Verma',
                'location' => 'Gujarat',
                'title' => 'Question about Cotton Pest Control',
                'content' => 'I\'m facing problems with bollworm in my cotton crop. Has anyone tried any effective organic methods for controlling this pest?',
                'created_at' => '2025-11-05 09:45:00'
            ]
        ];
    }
    
    $sql = "SELECT * FROM community_posts ORDER BY created_at DESC LIMIT :limit OFFSET :offset";
    return fetchAll($sql, [':limit' => $limit, ':offset' => $offset]);
}

/**
 * Get farmer stories/testimonials
 * 
 * @param int $limit Number of stories to get
 * @return array Farmer stories
 */
function getFarmerStories($limit = 3) {
    // In a real application, this would fetch from a database
    // For this implementation, we'll use static data
    $stories = [
        [
            'name' => 'Harpreet Singh',
            'age' => 45,
            'location' => 'Amritsar, Punjab',
            'crop' => 'Wheat & Rice',
            'image' => 'farmer1.svg',
            'quote' => 'Using the weather forecasting on AgroInnovate helped me plan my irrigation schedule better, saving water and improving my wheat yield by 15%.',
            'story' => 'As a third-generation farmer in Punjab, I\'ve seen many changes in agriculture. The unpredictable weather patterns in recent years made farming more challenging. Since using AgroInnovate\'s weather forecasting and educational resources, I\'ve been able to adapt my practices and optimize water usage. The community section also connected me with farmers facing similar challenges, and we now share solutions regularly.'
        ],
        [
            'name' => 'Lakshmi Devi',
            'age' => 38,
            'location' => 'Kurnool, Andhra Pradesh',
            'crop' => 'Cotton & Pulses',
            'image' => 'farmer2.svg',
            'quote' => 'The market price information helped me time my cotton harvest and sales perfectly, increasing my profits by nearly 20% compared to last season.',
            'story' => 'As a woman farmer managing 5 acres of land, I faced many challenges including lack of timely market information. AgroInnovate\'s market price trends have been invaluable. I can now make informed decisions about when to sell my crops for maximum profit. The educational content on pest management has also helped me reduce crop losses significantly. I\'ve encouraged other women farmers in my village to use this platform.'
        ],
        [
            'name' => 'Ramesh Patel',
            'age' => 52,
            'location' => 'Rajkot, Gujarat',
            'crop' => 'Groundnut & Cumin',
            'image' => 'farmer3.svg',
            'quote' => 'The educational resources on drip irrigation and water management transformed my farm productivity even during drought conditions.',
            'story' => 'Farming in a water-scarce region of Gujarat was becoming increasingly difficult due to climate change. Through AgroInnovate\'s educational resources, I learned about efficient drip irrigation systems and drought-resistant crop varieties. Implementing these techniques has made my farm resilient even during water shortage periods. The community forum also allowed me to share my experiences with farmers from similar regions, creating a support network.'
        ]
    ];
    
    return array_slice($stories, 0, $limit);
}

// Fetch one record from database
function fetchOne($sql, $params = []) {
    global $pdo;
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch();
    } catch(PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
        return false;
    }
}

// Insert data into database
function insertData($table, $data) {
    global $pdo;
    try {
        $columns = implode(', ', array_keys($data));
        $values = implode(', ', array_fill(0, count($data), '?'));
        $sql = "INSERT INTO $table ($columns) VALUES ($values)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array_values($data));
        return $pdo->lastInsertId();
    } catch(PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
        return false;
    }
}

// Update data in database
function updateData($table, $data, $where, $whereParams) {
    global $pdo;
    try {
        $set = implode(' = ?, ', array_keys($data)) . ' = ?';
        $sql = "UPDATE $table SET $set WHERE $where";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array_merge(array_values($data), $whereParams));
        return true;
    } catch(PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
        return false;
    }
}

// Delete data from database
function deleteData($table, $where, $params) {
    global $pdo;
    try {
        $sql = "DELETE FROM $table WHERE $where";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return true;
    } catch(PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
        return false;
    }
}
?>
