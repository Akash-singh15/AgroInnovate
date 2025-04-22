/**
 * AgroInnovate - Weather JavaScript file
 * Handles all weather-related functionality
 */

// Global variables
let currentLocation = 'Delhi';
let weatherData = null;

// Document ready function
document.addEventListener('DOMContentLoaded', function() {
    // Initialize weather functionality
    initWeather();
    
    // Set up location search form
    setupLocationSearch();
});

/**
 * Initializes weather functionality
 */
function initWeather() {
    // Load weather data for default location
    loadWeatherData(currentLocation);
    
    // Set up weather tabs if they exist
    const weatherTabs = document.querySelectorAll('.weather-tab');
    if (weatherTabs.length > 0) {
        weatherTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs
                weatherTabs.forEach(t => t.classList.remove('active'));
                // Add active class to clicked tab
                this.classList.add('active');
                
                // Show corresponding content
                const contentId = this.getAttribute('data-target');
                document.querySelectorAll('.weather-content').forEach(content => {
                    content.classList.remove('active');
                });
                document.getElementById(contentId).classList.add('active');
            });
        });
    }
}

/**
 * Sets up location search form
 */
function setupLocationSearch() {
    const searchForm = document.getElementById('weather-search-form');
    if (!searchForm) return;
    
    searchForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const locationInput = document.getElementById('weather-location');
        if (!locationInput || !locationInput.value.trim()) return;
        
        currentLocation = locationInput.value.trim();
        loadWeatherData(currentLocation);
    });
}

/**
 * Loads weather data from API
 * 
 * @param {string} location - The location to get weather for
 */
function loadWeatherData(location) {
    const weatherContainer = document.getElementById('weather-data');
    const forecastContainer = document.getElementById('forecast-data');
    
    if (!weatherContainer) return;
    
    // Show loading state
    weatherContainer.innerHTML = `
        <div class="text-center my-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Loading weather data...</p>
        </div>
    `;
    
    if (forecastContainer) {
        forecastContainer.innerHTML = '';
    }
    
    // Fetch weather data from API
    fetch(`/api/weather.php?location=${encodeURIComponent(location)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Weather data request failed');
            }
            return response.json();
        })
        .then(data => {
            if (!data.success) {
                throw new Error(data.error || 'Failed to retrieve weather data');
            }
            
            weatherData = data;
            displayWeatherData();
            displayForecastData();
        })
        .catch(error => {
            weatherContainer.innerHTML = `
                <div class="alert alert-danger" role="alert">
                    <i data-feather="alert-circle"></i>
                    ${error.message || 'An error occurred while fetching weather data. Please try again later.'}
                </div>
            `;
            
            // Initialize feather icons
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        });
}

/**
 * Displays current weather data
 */
function displayWeatherData() {
    const weatherContainer = document.getElementById('weather-data');
    if (!weatherContainer || !weatherData) return;
    
    const current = weatherData.current;
    
    // Build HTML for weather data
    const html = `
        <div class="weather-card">
            <div class="weather-location">
                ${weatherData.location}, ${weatherData.country}
            </div>
            <div class="weather-info">
                <div class="weather-temp">
                    ${current.temp}°C
                </div>
                <div class="weather-icon">
                    <img src="https://openweathermap.org/img/wn/${current.weather_icon}@2x.png" alt="${current.weather_description}">
                </div>
                <div class="weather-description">
                    ${current.weather_description}
                </div>
            </div>
            <div class="weather-details">
                <div class="weather-detail">
                    <div class="weather-detail-icon">
                        <i data-feather="thermometer"></i>
                    </div>
                    <div>
                        <span>Feels Like</span>
                        <div>${current.feels_like}°C</div>
                    </div>
                </div>
                <div class="weather-detail">
                    <div class="weather-detail-icon">
                        <i data-feather="droplet"></i>
                    </div>
                    <div>
                        <span>Humidity</span>
                        <div>${current.humidity}%</div>
                    </div>
                </div>
                <div class="weather-detail">
                    <div class="weather-detail-icon">
                        <i data-feather="wind"></i>
                    </div>
                    <div>
                        <span>Wind Speed</span>
                        <div>${current.wind_speed} m/s</div>
                    </div>
                </div>
                <div class="weather-detail">
                    <div class="weather-detail-icon">
                        <i data-feather="compass"></i>
                    </div>
                    <div>
                        <span>Pressure</span>
                        <div>${current.pressure} hPa</div>
                    </div>
                </div>
            </div>
            <div class="text-muted mt-3 small">
                Last updated: ${new Date(current.timestamp * 1000).toLocaleString()}
            </div>
        </div>
    `;
    
    weatherContainer.innerHTML = html;
    
    // Initialize feather icons
    if (typeof feather !== 'undefined') {
        feather.replace();
    }
    
    // Add farming tips based on weather conditions
    addWeatherBasedTips(current.weather_main);
}

/**
 * Displays forecast data
 */
function displayForecastData() {
    const forecastContainer = document.getElementById('forecast-data');
    if (!forecastContainer || !weatherData || !weatherData.forecast) return;
    
    // Build HTML for each forecast day
    let forecastHtml = '<div class="weather-forecast">';
    
    weatherData.forecast.forEach(day => {
        forecastHtml += `
            <div class="forecast-item">
                <div class="forecast-day">${day.day}</div>
                <div class="forecast-icon">
                    <img src="https://openweathermap.org/img/wn/${day.weather_icon}.png" alt="${day.weather_description}">
                </div>
                <div class="forecast-description">${day.weather_description}</div>
                <div class="forecast-temp">
                    <span class="forecast-high">${day.temp_max}°</span> / 
                    <span class="forecast-low">${day.temp_min}°</span>
                </div>
            </div>
        `;
    });
    
    forecastHtml += '</div>';
    forecastContainer.innerHTML = forecastHtml;
}

/**
 * Adds weather-based farming tips
 * 
 * @param {string} weatherCondition - The current weather condition
 */
function addWeatherBasedTips(weatherCondition) {
    const tipsContainer = document.getElementById('weather-tips');
    if (!tipsContainer) return;
    
    const tips = getWeatherBasedTips(weatherCondition);
    
    let tipsHtml = `
        <div class="card mt-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Farming Tips Based on Current Weather</h5>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
    `;
    
    tips.forEach(tip => {
        tipsHtml += `<li class="list-group-item">${tip}</li>`;
    });
    
    tipsHtml += `
                </ul>
            </div>
        </div>
    `;
    
    tipsContainer.innerHTML = tipsHtml;
}

/**
 * Gets farming tips based on weather condition
 * 
 * @param {string} condition - The weather condition
 * @returns {Array} - Array of tips
 */
function getWeatherBasedTips(condition) {
    const tips = {
        'Clear': [
            'Great day for harvesting crops if they are ready.',
            'Consider irrigating in the early morning or late evening to minimize evaporation.',
            'Good day for applying foliar fertilizers.',
            'Optimal conditions for planting new crops.',
            'Take advantage of sunlight for solar-powered equipment.'
        ],
        'Clouds': [
            'Good conditions for transplanting seedlings.',
            'Reduced evaporation means more efficient irrigation.',
            'Ideal for applying fertilizers.',
            'Comfortable conditions for fieldwork and maintenance.',
            'Consider harvesting crops that don\'t require drying.'
        ],
        'Rain': [
            'Postpone spraying pesticides or fertilizers.',
            'Check drainage systems to prevent waterlogging.',
            'Monitor low-lying areas for potential flooding.',
            'Good time to clean and maintain farm equipment indoors.',
            'Consider reinforcing greenhouse structures if heavy rain is expected.'
        ],
        'Drizzle': [
            'Light rain provides natural irrigation, consider reducing artificial watering.',
            'Good conditions for transplanting.',
            'Avoid spraying chemicals as they may wash away.',
            'Monitor humidity-loving pests that thrive in damp conditions.',
            'Consider delaying harvesting of dry crops.'
        ],
        'Thunderstorm': [
            'Stay indoors and away from open fields during storms.',
            'Ensure livestock has proper shelter.',
            'Secure loose equipment and structures.',
            'Check fields for damage after the storm passes.',
            'Be aware of potential flooding in low areas.'
        ],
        'Snow': [
            'Protect sensitive crops with covers.',
            'Ensure livestock has warm shelter and adequate food.',
            'Check greenhouse heating systems.',
            'Clear snow from structures to prevent collapse.',
            'Use the time for farm planning and equipment maintenance.'
        ],
        'Mist': [
            'Good conditions for transplanting.',
            'Be careful with machinery operation due to reduced visibility.',
            'Monitor fungal diseases that thrive in high humidity.',
            'Delay spraying operations until visibility improves.',
            'Great conditions for certain crops like tea and coffee.'
        ],
        'Smoke': [
            'Minimize outdoor work to reduce exposure.',
            'Ensure proper ventilation in barns and animal shelters.',
            'Monitor air quality reports.',
            'Consider using masks for necessary outdoor work.',
            'Check crops for ash deposit and rinse if needed.'
        ],
        'Haze': [
            'Monitor air quality and minimize prolonged outdoor exposure.',
            'Ensure adequate hydration for livestock.',
            'Consider delaying sensitive operations that require clear visibility.',
            'Clean equipment filters more frequently.',
            'Keep windows closed in farm buildings.'
        ],
        'Dust': [
            'Cover sensitive crops if possible.',
            'Ensure livestock has clean water sources.',
            'Wear protective masks during fieldwork.',
            'Consider postponing seeding operations.',
            'Clean equipment filters regularly.'
        ],
        'Fog': [
            'Postpone operations requiring good visibility like spraying or harvesting.',
            'Be careful with machinery operation.',
            'Good time for greenhouse work or indoor farming activities.',
            'Monitor humidity-sensitive crops for disease.',
            'Consider delaying transport of produce.'
        ],
        'Sand': [
            'Protect crops with covers if possible.',
            'Secure loose materials and equipment.',
            'Ensure livestock has shelter and clean water.',
            'Wear protective gear during necessary outdoor work.',
            'Check irrigation systems for blockages after the conditions improve.'
        ],
        'Ash': [
            'Cover crops if volcanic ash is present.',
            'Keep livestock indoors with clean feed and water.',
            'Wear respiratory protection during outdoor work.',
            'Rinse ash from crops before consumption.',
            'Check and clean equipment regularly.'
        ],
        'Squall': [
            'Secure loose equipment and structures immediately.',
            'Move livestock to sheltered areas.',
            'Postpone all field operations.',
            'Check for damage once the squall has passed.',
            'Be prepared for heavy but brief rainfall.'
        ],
        'Tornado': [
            'Seek shelter immediately in a sturdy building.',
            'Move to a basement or interior room if possible.',
            'Stay away from windows.',
            'Check for injuries and damages after the event.',
            'Contact emergency services if needed.'
        ],
        'default': [
            'Monitor weather forecasts regularly for changes.',
            'Adjust irrigation based on weather conditions.',
            'Consider the weather impact on planned farm activities.',
            'Maintain equipment for efficient operation in all conditions.',
            'Adapt planting and harvesting schedules to weather patterns.'
        ]
    };
    
    return tips[condition] || tips['default'];
}
