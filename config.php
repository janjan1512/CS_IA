<?php



if (file_exists(__DIR__ . '/.env')) {
    $lines = file(__DIR__ . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
            list($key, $value) = explode('=', $line, 2);
            $_ENV[trim($key)] = trim($value);
        }
    }
}

/**
 * Get database connection
 * @return mysqli Database connection object
 */
function getDBConnection() {
    static $conn = null;
    
    if ($conn === null) {
        $host = $_ENV['DB_HOST'] ?? 'localhost';
        $user = $_ENV['DB_USER'] ?? 'root';
        $pass = $_ENV['DB_PASS'] ?? '';
        $dbname = $_ENV['DB_NAME'] ?? 'CS_IA';
        
        $conn = new mysqli($host, $user, $pass, $dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    }
    
    return $conn;
}


$conn = getDBConnection();
?>