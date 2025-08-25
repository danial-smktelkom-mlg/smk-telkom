<?php
session_start();
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'] ?? '';
    $pass = $_POST['password'] ?? '';
    if ($user === 'admin' && $pass === '1234') {
        $_SESSION['is_admin'] = true;
        header('Location: admin-dashboard.php');
        exit;
    } else {
        $error = 'Username atau password salah!';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Kelulusan Siswa SMK Telkom Malang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md p-6 space-y-8">
        <div class="text-center">
            <h2 class="text-3xl font-bold" style="color: var(--primary-color)">Login Admin</h2>
        </div>
        
        <?php if ($error) echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">'.$error.'</div>'; ?>
        
        <form method="post" class="space-y-6">
            <div>
                <input type="text" 
                    name="username" 
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                    placeholder="Username" 
                    required 
                    autofocus>
            </div>
            <div>
                <input type="password" 
                    name="password" 
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                    placeholder="Password" 
                    required>
            </div>
            <button type="submit" 
                class="w-full py-3 px-4 rounded-lg text-white font-medium transition duration-300" 
                style="background-color: var(--primary-color)">
                Login
            </button>
            <div class="text-center">
                <a href="home.php" class="text-sm text-gray-600 hover:text-blue-500">Kembali ke Home</a>
            </div>
        </form>
    </div>
</body>
</html>