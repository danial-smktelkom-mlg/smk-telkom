<?php
session_start();
session_destroy();
header('Location: login.php');
exit;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
        :root {
            --primary-color: #001BB7;
            --primary-dark: #001694;
        }
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-900 to-blue-800">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md p-8 text-center">
        <div class="mb-6">
            <i class="fas fa-check-circle text-5xl" style="color: var(--primary-color)"></i>
        </div>
        <h3 class="text-2xl font-bold mb-4" style="color: var(--primary-color)">Terima Kasih</h3>
        <p class="text-gray-600 mb-6">Anda telah berhasil logout dari sistem</p>
        <a href="login.php" 
           class="inline-flex items-center justify-center px-6 py-3 text-base font-medium text-white rounded-lg transition duration-300"
           style="background-color: var(--primary-color)">
            <i class="fas fa-sign-in-alt mr-2"></i> Kembali ke Login
        </a>
    </div>
</body>
</html>