/**
 * AgroInnovate - Market JavaScript file
 * Handles all market price related functionality
 */

// Global variables
let marketPrices = [];
let selectedCrop = 'Rice';
let marketChart = null;

// Document ready function
document.addEventListener('DOMContentLoaded', function() {
    // Initialize market data
    initMarketData();
    
    // Set up crop selector
    setupCropSelector();
});

/**
 * Initializes market data functionality
 */
function initMarketData() {
    // Load market prices
    loadMarketPrices();
    
    // Load historical data for default crop
    loadHistoricalData(selectedCrop);
}

/**
 * Sets up crop selector dropdown
 */
function setupCropSelector() {
    const cropSelector = document.getElementById('crop-selector');
    if (!cropSelector) return;
    
    cropSelector.addEventListener('change', function() {
        selectedCrop = this.value;
        loadHistoricalData(selectedCrop);
    });
}

/**
 * Loads current market prices from API
 */
function loadMarketPrices() {
    const pricesTable = document.getElementById('market-prices-table');
    if (!pricesTable) return;
    
    // Show loading state
    pricesTable.innerHTML = `
        <tr>
            <td colspan="4" class="text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2">Loading market prices...</p>
            </td>
        </tr>
    `;
    
    // Fetch market prices from API
    fetch('/api/market.php?action=prices')
        .then(response => {
            if (!response.ok) {
                throw new Error('Market data request failed');
            }
            return response.json();
        })
        .then(data => {
            if (!data.success) {
                throw new Error(data.error || 'Failed to retrieve market data');
            }
            
            marketPrices = data.prices;
            displayMarketPrices();
        })
        .catch(error => {
            pricesTable.innerHTML = `
                <tr>
                    <td colspan="4" class="text-center">
                        <div class="alert alert-danger" role="alert">
                            <i data-feather="alert-circle"></i>
                            ${error.message || 'An error occurred while fetching market data. Please try again later.'}
                        </div>
                    </td>
                </tr>
            `;
            
            // Initialize feather icons
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        });
}

/**
 * Displays market prices in the table
 */
function displayMarketPrices() {
    const pricesTable = document.getElementById('market-prices-table');
    if (!pricesTable || !marketPrices.length) return;
    
    let tableHtml = '';
    
    marketPrices.forEach(item => {
        const trendIcon = item.trend === 'up' ? 
            '<i data-feather="trending-up" class="price-trend-up"></i>' : 
            '<i data-feather="trending-down" class="price-trend-down"></i>';
        
        const changeClass = item.trend === 'up' ? 'price-trend-up' : 'price-trend-down';
        const changePrefix = item.trend === 'up' ? '+' : '';
        
        tableHtml += `
            <tr>
                <td>${item.crop}</td>
                <td>₹${item.price.toLocaleString('en-IN')}/${item.unit}</td>
                <td class="${changeClass}">
                    ${trendIcon} ${changePrefix}${item.change}%
                </td>
                <td>
                    <button class="btn btn-sm btn-outline-primary view-history-btn" data-crop="${item.crop}">
                        <i data-feather="bar-chart-2"></i> View History
                    </button>
                </td>
            </tr>
        `;
    });
    
    pricesTable.innerHTML = tableHtml;
    
    // Initialize feather icons
    if (typeof feather !== 'undefined') {
        feather.replace();
    }
    
    // Set up history buttons
    document.querySelectorAll('.view-history-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const crop = this.getAttribute('data-crop');
            selectedCrop = crop;
            
            // Update crop selector if it exists
            const cropSelector = document.getElementById('crop-selector');
            if (cropSelector) {
                cropSelector.value = crop;
            }
            
            loadHistoricalData(crop);
            
            // Scroll to chart
            const chartContainer = document.getElementById('market-chart-container');
            if (chartContainer) {
                chartContainer.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
}

/**
 * Loads historical market data for a specific crop
 * 
 * @param {string} crop - The crop to get data for
 */
function loadHistoricalData(crop) {
    const chartContainer = document.getElementById('market-chart-container');
    if (!chartContainer) return;
    
    // Show loading state in chart container
    chartContainer.innerHTML = `
        <div class="text-center my-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Loading historical data for ${crop}...</p>
        </div>
    `;
    
    // Fetch historical data from API
    fetch(`/api/market.php?action=history&crop=${encodeURIComponent(crop)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Historical data request failed');
            }
            return response.json();
        })
        .then(data => {
            if (!data.success) {
                throw new Error(data.error || 'Failed to retrieve historical data');
            }
            
            displayHistoricalData(data.crop, data.data);
        })
        .catch(error => {
            chartContainer.innerHTML = `
                <div class="alert alert-danger" role="alert">
                    <i data-feather="alert-circle"></i>
                    ${error.message || 'An error occurred while fetching historical data. Please try again later.'}
                </div>
            `;
            
            // Initialize feather icons
            if (typeof feather !== 'undefined') {
                feather.replace();
            }
        });
}

/**
 * Displays historical market data in a chart
 * 
 * @param {string} crop - The crop name
 * @param {Object} data - The historical data object
 */
function displayHistoricalData(crop, data) {
    const chartContainer = document.getElementById('market-chart-container');
    if (!chartContainer || !data) return;
    
    // Reset chart container
    chartContainer.innerHTML = `
        <h3 class="mb-4">Historical Prices: ${crop}</h3>
        <div class="market-chart-wrapper" style="position: relative; height: 400px;">
            <canvas id="market-chart"></canvas>
        </div>
        <div class="market-chart-legend mt-4 text-center">
            <p class="text-muted">Showing monthly average prices for the past year (₹ per quintal)</p>
        </div>
    `;
    
    // Get the canvas element
    const ctx = document.getElementById('market-chart').getContext('2d');
    
    // Destroy previous chart if it exists
    if (marketChart) {
        marketChart.destroy();
    }
    
    // Calculate price range for y-axis
    const prices = data.prices;
    const minPrice = Math.min(...prices) * 0.9; // 10% buffer below min
    const maxPrice = Math.max(...prices) * 1.1; // 10% buffer above max
    
    // Create new chart
    marketChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: data.months,
            datasets: [{
                label: `${crop} Price (₹/${getCurrentCropUnit(crop)})`,
                data: prices,
                backgroundColor: 'rgba(62, 137, 20, 0.2)',
                borderColor: 'rgba(62, 137, 20, 1)',
                borderWidth: 2,
                pointBackgroundColor: 'rgba(62, 137, 20, 1)',
                pointRadius: 4,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: false,
                    min: minPrice,
                    max: maxPrice,
                    title: {
                        display: true,
                        text: `Price (₹ per ${getCurrentCropUnit(crop)})`
                    },
                    ticks: {
                        callback: function(value) {
                            return '₹' + value.toLocaleString('en-IN');
                        }
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Month'
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `Price: ₹${context.raw.toLocaleString('en-IN')} per ${getCurrentCropUnit(crop)}`;
                        }
                    }
                },
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        }
    });
    
    // Add price analysis
    addPriceAnalysis(crop, data);
}

/**
 * Gets the current unit for a specific crop
 * 
 * @param {string} crop - The crop name
 * @returns {string} - The unit of measurement
 */
function getCurrentCropUnit(crop) {
    const cropData = marketPrices.find(item => item.crop === crop);
    return cropData ? cropData.unit : 'quintal';
}

/**
 * Adds price analysis below the chart
 * 
 * @param {string} crop - The crop name
 * @param {Object} data - The historical data object
 */
function addPriceAnalysis(crop, data) {
    const analysisContainer = document.getElementById('price-analysis');
    if (!analysisContainer || !data) return;
    
    // Calculate analytics
    const prices = data.prices;
    const currentPrice = prices[prices.length - 1];
    const previousPrice = prices[prices.length - 2];
    const priceChange = currentPrice - previousPrice;
    const priceChangePercent = (priceChange / previousPrice) * 100;
    
    const averagePrice = prices.reduce((sum, price) => sum + price, 0) / prices.length;
    const maxPrice = Math.max(...prices);
    const minPrice = Math.min(...prices);
    const priceVolatility = (maxPrice - minPrice) / averagePrice * 100;
    
    // Determine trend (last 3 months)
    const recentPrices = prices.slice(-3);
    let trend = 'stable';
    if (recentPrices[2] > recentPrices[0] && recentPrices[2] > recentPrices[1]) {
        trend = 'increasing';
    } else if (recentPrices[2] < recentPrices[0] && recentPrices[2] < recentPrices[1]) {
        trend = 'decreasing';
    }
    
    // Get market insights based on trend
    const insights = getMarketInsights(crop, trend, priceVolatility);
    
    // Format the analysis HTML
    const trendClass = trend === 'increasing' ? 'text-success' : (trend === 'decreasing' ? 'text-danger' : 'text-warning');
    const changeClass = priceChange >= 0 ? 'text-success' : 'text-danger';
    const changeSign = priceChange >= 0 ? '+' : '';
    
    let analysisHtml = `
        <div class="card mt-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Market Analysis: ${crop}</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Price Statistics</h6>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Current Price
                                <span class="badge bg-primary rounded-pill">₹${currentPrice.toLocaleString('en-IN')}/${getCurrentCropUnit(crop)}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Monthly Change
                                <span class="badge ${changeClass === 'text-success' ? 'bg-success' : 'bg-danger'} rounded-pill">
                                    ${changeSign}${priceChange.toFixed(2)} (${changeSign}${priceChangePercent.toFixed(2)}%)
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Average Price (12 months)
                                <span class="badge bg-secondary rounded-pill">₹${averagePrice.toFixed(2).toLocaleString('en-IN')}/${getCurrentCropUnit(crop)}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Price Range
                                <span class="badge bg-info rounded-pill">₹${minPrice.toLocaleString('en-IN')} - ₹${maxPrice.toLocaleString('en-IN')}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Price Volatility
                                <span class="badge bg-warning text-dark rounded-pill">${priceVolatility.toFixed(2)}%</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6>Market Insights</h6>
                        <div class="alert alert-info">
                            <h6 class="alert-heading">
                                <span class="${trendClass}">
                                    <i data-feather="${trend === 'increasing' ? 'trending-up' : (trend === 'decreasing' ? 'trending-down' : 'trending-up')}"></i>
                                    ${trend.charAt(0).toUpperCase() + trend.slice(1)} Trend
                                </span>
                            </h6>
                            <p>${insights.summary}</p>
                        </div>
                        <h6>Recommendations</h6>
                        <ul class="list-group">
    `;
    
    insights.recommendations.forEach(rec => {
        analysisHtml += `<li class="list-group-item"><i data-feather="check-circle" class="text-success me-2"></i> ${rec}</li>`;
    });
    
    analysisHtml += `
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    analysisContainer.innerHTML = analysisHtml;
    
    // Initialize feather icons
    if (typeof feather !== 'undefined') {
        feather.replace();
    }
}

/**
 * Gets market insights based on crop and trend
 * 
 * @param {string} crop - The crop name
 * @param {string} trend - The price trend (increasing, decreasing, stable)
 * @param {number} volatility - The price volatility
 * @returns {Object} - Object with summary and recommendations
 */
function getMarketInsights(crop, trend, volatility) {
    const insights = {
        'Rice': {
            'increasing': {
                summary: 'Rice prices are showing an upward trend. This is typically influenced by factors such as reduced production, increased demand, or seasonal variations.',
                recommendations: [
                    'Consider selling stored rice if prices reach your target level',
                    'For farmers planning to plant: Evaluate if increased rice acreage is profitable given input costs',
                    'Monitor government procurement policies which may affect prices',
                    'Stay updated on export regulations that could impact domestic prices'
                ]
            },
            'decreasing': {
                summary: 'Rice prices are trending downward. This could be due to bumper harvests, reduced export demand, or increased imports.',
                recommendations: [
                    'Consider storing harvested rice if storage facilities are available',
                    'Explore value-added rice products to increase profit margins',
                    'Look into crop diversification for the next planting season',
                    'Check if government minimum support price (MSP) procurement is active'
                ]
            },
            'stable': {
                summary: 'Rice prices are relatively stable. This indicates a balance between supply and demand in the current market.',
                recommendations: [
                    'Good time to plan your selling strategy based on your production costs',
                    'Monitor international rice markets for potential changes',
                    'Consider forward contracts with buyers to lock in current prices',
                    'Focus on quality improvement to command premium prices'
                ]
            }
        },
        'Wheat': {
            'increasing': {
                summary: 'Wheat prices are trending upward. This could be due to lower production estimates, increased export demand, or seasonal factors.',
                recommendations: [
                    'Consider selling stored wheat if prices are favorable',
                    'For farmers planning to plant: Evaluate if increased wheat acreage is profitable',
                    'Monitor global wheat production as it significantly affects Indian prices',
                    'Stay informed about government import/export policies'
                ]
            },
            'decreasing': {
                summary: 'Wheat prices are showing a downward trend. This may be due to bumper harvests, reduced export demand, or increased imports.',
                recommendations: [
                    'Consider storing wheat if facilities are available',
                    'Check government procurement at MSP',
                    'Explore value-added wheat products',
                    'Plan for crop diversification in the next season if trends continue'
                ]
            },
            'stable': {
                summary: 'Wheat prices are relatively stable, indicating balanced supply and demand conditions in the market.',
                recommendations: [
                    'Good time to make calculated decisions about selling',
                    'Consider staggered selling to minimize risk',
                    'Monitor government procurement operations',
                    'Stay updated on global wheat market trends'
                ]
            }
        }
    };
    
    // Default insights for crops not specifically covered
    const defaultInsights = {
        'increasing': {
            summary: `${crop} prices are trending upward. This could be due to reduced supply, increased demand, or seasonal factors.`,
            recommendations: [
                'Consider selling if prices reach your target level',
                'Evaluate storage versus immediate selling based on price trends',
                'Monitor government policies that may affect prices',
                'Stay updated on market demand forecasts'
            ]
        },
        'decreasing': {
            summary: `${crop} prices are showing a downward trend. This may be due to oversupply, reduced demand, or seasonal patterns.`,
            recommendations: [
                'Consider storing your harvest if facilities are available',
                'Check if government support programs are available',
                'Explore alternative markets or value-added products',
                'Plan for crop diversification if trends continue'
            ]
        },
        'stable': {
            summary: `${crop} prices are relatively stable, indicating balanced market conditions.`,
            recommendations: [
                'Good time to make calculated selling decisions',
                'Consider forward contracts with buyers',
                'Focus on quality improvement to command better prices',
                'Plan production based on current market stability'
            ]
        }
    };
    
    // Add volatility-based recommendation
    let volatilityRec = '';
    if (volatility > 15) {
        volatilityRec = 'Market shows high volatility. Consider hedging strategies or diversification to reduce risk.';
    } else if (volatility > 8) {
        volatilityRec = 'Market shows moderate volatility. Monitor price movements closely before making major decisions.';
    } else {
        volatilityRec = 'Market shows low volatility. Good conditions for long-term planning.';
    }
    
    // Get the appropriate insights
    let result = insights[crop] ? insights[crop][trend] : defaultInsights[trend];
    
    // Add volatility recommendation
    result.recommendations.push(volatilityRec);
    
    return result;
}
