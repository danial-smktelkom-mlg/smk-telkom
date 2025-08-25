<?php
/**
 * Database configuration
 * Menggunakan konstanta untuk keamanan
 */

// Database credentials
define('DB_HOST', 'localhost');
define('DB_NAME', 'smktelkom_db');
define('DB_USER', 'root');
define('DB_PASS', '');

// Timezone setting
date_default_timezone_set('Asia/Jakarta');

/**
 * Get database connection
 * @return PDO Database connection
 */
function getDbConnection() {
    try {
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        return new PDO($dsn, DB_USER, DB_PASS, $options);
    } catch (PDOException $e) {
        error_log("Database Connection Error: " . $e->getMessage());
        throw new Exception("Database connection failed");
    }
}

/**
 * Error handling function
 * @param Exception $e Exception object
 * @return string User-friendly error message
 */
function handleDatabaseError($e) {
    error_log("Database Error: " . $e->getMessage());
    return "Terjadi kesalahan pada sistem. Silakan coba lagi nanti.";
}
?>
