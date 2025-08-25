<?php
/**
 * Generate the standard head section for all pages
 * @param string $title Page title
 * @param bool $isRoot Whether the page is in root directory
 * @param array $options Additional options (meta description, keywords, etc.)
 */
function generateHead($title, $isRoot = false, $options = []) {
    require_once(__DIR__ . '/../includes/utilities.php');
    
    $prefix = $isRoot ? '' : '../';
    $defaultDescription = 'SMK Telkom Malang - Shaping the future through technology and innovation';
    $description = $options['description'] ?? $defaultDescription;
    $keywords = $options['keywords'] ?? 'SMK Telkom Malang, pendidikan teknologi, sekolah IT';
    ?>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo sanitizeInput($description); ?>">
    <meta name="keywords" content="<?php echo sanitizeInput($keywords); ?>">
    <meta name="author" content="SMK Telkom Malang">
    <meta name="theme-color" content="#E42313">
    
    <!-- Open Graph / Social Media Meta Tags -->
    <meta property="og:title" content="<?php echo sanitizeInput(generatePageTitle($title)); ?>">
    <meta property="og:description" content="<?php echo sanitizeInput($description); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>">
    
    <!-- Title -->
    <title><?php echo sanitizeInput(generatePageTitle($title)); ?></title>
    
    <!-- Preload critical assets -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    
    <!-- Stylesheets -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo $prefix; ?>assets/css/style.css">
    
    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="<?php echo $prefix; ?>assets/js/config.js" defer></script>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo $prefix; ?>assets/images/favicon.ico">
    
    <!-- Critical CSS -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }
        .hover-scale {
            transition: transform 0.3s ease;
        }
        .hover-scale:hover {
            transform: scale(1.05);
        }
    </style>
<?php
}
?>
