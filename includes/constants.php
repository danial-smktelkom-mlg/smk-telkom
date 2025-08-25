<?php
/**
 * Application constants
 */

// Application settings
define('APP_NAME', 'SMK Telkom Malang');
define('APP_VERSION', '1.0.0');
define('APP_URL', 'https://smktelkom-mlg.sch.id');

// File upload settings
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_IMAGE_TYPES', [
    'image/jpeg',
    'image/png',
    'image/webp'
]);
define('UPLOAD_PATH', __DIR__ . '/../uploads');

// Session settings
define('SESSION_LIFETIME', 7200); // 2 hours
define('COOKIE_LIFETIME', 604800); // 1 week

// Contact information
define('SCHOOL_ADDRESS', 'Jl. Danau Ranau, Sawojajar, Kec. Kedungkandang, Kota Malang, Jawa Timur 65139');
define('SCHOOL_EMAIL', 'info@smktelkom-mlg.sch.id');
define('SCHOOL_PHONE', '0812-2348-8999');

// Social media
define('SOCIAL_MEDIA', [
    'facebook' => 'https://facebook.com/smktelkommalang',
    'instagram' => 'https://instagram.com/smktelkommalang',
    'twitter' => 'https://twitter.com/smktelkommalang',
    'youtube' => 'https://youtube.com/smktelkommalang'
]);

// Department information
define('DEPARTMENTS', [
    'rpl' => 'Software Engineering',
    'tkj' => 'Computer Networking',
    'pg' => 'Game Development'
]);

// Error messages
define('ERROR_MESSAGES', [
    'db_connection' => 'Koneksi database gagal',
    'invalid_input' => 'Input tidak valid',
    'file_upload' => 'Upload file gagal',
    'not_found' => 'Data tidak ditemukan',
    'unauthorized' => 'Akses ditolak'
]);

// Success messages
define('SUCCESS_MESSAGES', [
    'data_saved' => 'Data berhasil disimpan',
    'data_updated' => 'Data berhasil diperbarui',
    'data_deleted' => 'Data berhasil dihapus',
    'login_success' => 'Login berhasil'
]);
?>
