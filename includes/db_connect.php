<?php
// Database connection configuration
$host = getenv('DB_HOST') ?: 'localhost';
$db_name = getenv('DB_NAME') ?: 'agroinnovate';
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') ?: '';
$conn = null;

// Establish database connection
try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    error_log("Connection failed: " . $e->getMessage());
    // Continue even if database connection fails
}
try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Set default fetch mode to associative array
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    // Set charset to UTF-8
    $conn->exec("SET NAMES 'utf8'");
} catch(PDOException $e) {
    // If we can't connect to the database, continue but log the error
    error_log("Database Connection Error: " . $e->getMessage());
}

// Function to safely execute SQL queries
function executeQuery($sql, $params = []) {
    global $conn;
    
    if (!$conn) {
        return false;
    }
    
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    } catch(PDOException $e) {
        error_log("Database Query Error: " . $e->getMessage());
        return false;
    }
}

// Function to get a single row
function fetchOne($sql, $params = []) {
    $stmt = executeQuery($sql, $params);
    return $stmt ? $stmt->fetch() : false;
}

// Function to get multiple rows
function fetchAll($sql, $params = []) {
    $stmt = executeQuery($sql, $params);
    return $stmt ? $stmt->fetchAll() : [];
}

// Function to insert data
function insertData($table, $data) {
    global $conn;
    
    if (!$conn) {
        return false;
    }
    
    try {
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute(array_values($data));
        
        return $conn->lastInsertId();
    } catch(PDOException $e) {
        error_log("Database Insert Error: " . $e->getMessage());
        return false;
    }
}

// Function to update data
function updateData($table, $data, $where, $whereParams = []) {
    global $conn;
    
    if (!$conn) {
        return false;
    }
    
    try {
        $setClauses = [];
        $params = [];
        
        foreach ($data as $column => $value) {
            $setClauses[] = "$column = ?";
            $params[] = $value;
        }
        
        $setClause = implode(', ', $setClauses);
        
        $sql = "UPDATE $table SET $setClause WHERE $where";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute(array_merge($params, $whereParams));
        
        return $stmt->rowCount();
    } catch(PDOException $e) {
        error_log("Database Update Error: " . $e->getMessage());
        return false;
    }
}

// Function to delete data
function deleteData($table, $where, $params = []) {
    global $conn;
    
    if (!$conn) {
        return false;
    }
    
    try {
        $sql = "DELETE FROM $table WHERE $where";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        
        return $stmt->rowCount();
    } catch(PDOException $e) {
        error_log("Database Delete Error: " . $e->getMessage());
        return false;
    }
}
?>
