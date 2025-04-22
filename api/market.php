<?php
// Include necessary files
require_once '../includes/functions.php';

// Set content type to JSON
header('Content-Type: application/json');

// Get action parameter
$action = isset($_GET['action']) ? sanitizeInput($_GET['action']) : 'prices';

if ($action === 'prices') {
    // Get market prices
    $prices = getMarketPrices();
    
    // Return response
    echo json_encode([
        'success' => true,
        'prices' => $prices
    ]);
} elseif ($action === 'history') {
    // Get crop parameter
    $crop = isset($_GET['crop']) ? sanitizeInput($_GET['crop']) : 'Rice';
    
    // Get historical market data
    $historicalData = getHistoricalMarketData($crop);
    
    // Return response
    echo json_encode([
        'success' => true,
        'crop' => $crop,
        'data' => $historicalData
    ]);
} else {
    // Return error for invalid action
    echo json_encode([
        'success' => false,
        'error' => 'Invalid action specified'
    ]);
}
?>
