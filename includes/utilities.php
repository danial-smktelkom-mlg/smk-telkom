<?php
/**
 * Collection of utility functions for the website
 */

/**
 * Sanitize input to prevent XSS attacks
 * @param string $input Input string to sanitize
 * @return string Sanitized string
 */
function sanitizeInput($input) {
    return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
}

/**
 * Generate page title with consistent format
 * @param string $title Page specific title
 * @return string Full page title
 */
function generatePageTitle($title) {
    return $title . ' - SMK Telkom Malang';
}

/**
 * Check if current page matches given page name
 * @param string $pageName Name of the page to check
 * @return bool True if current page matches
 */
function isCurrentPage($pageName) {
    $currentPage = basename($_SERVER['PHP_SELF'], '.php');
    return $currentPage === $pageName;
}

/**
 * Format date to Indonesian format
 * @param string $date Date string
 * @return string Formatted date
 */
function formatDate($date) {
    $timestamp = strtotime($date);
    $months = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    return date('j ', $timestamp) . $months[date('n', $timestamp) - 1] . date(' Y', $timestamp);
}

/**
 * Handle file upload with validation
 * @param array $file $_FILES array element
 * @param array $allowedTypes Array of allowed MIME types
 * @param int $maxSize Maximum file size in bytes
 * @return array Status and message
 */
function handleFileUpload($file, $allowedTypes, $maxSize) {
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return ['success' => false, 'message' => 'Upload failed'];
    }

    if ($file['size'] > $maxSize) {
        return ['success' => false, 'message' => 'File too large'];
    }

    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if (!in_array($mimeType, $allowedTypes)) {
        return ['success' => false, 'message' => 'Invalid file type'];
    }

    return ['success' => true, 'message' => 'File valid'];
}

/**
 * Generate slug from string
 * @param string $string Input string
 * @return string URL-friendly slug
 */
function generateSlug($string) {
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string), '-'));
}
?>
