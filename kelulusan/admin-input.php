<?php
session_start();
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: login.php');
    exit;
}

require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Data Siswa - Admin</title>
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
<body class="bg-gray-50">
    <header class="fixed w-full z-50">
        <nav class="bg-white/90 backdrop-blur-md shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="../index.html" class="text-2xl font-bold" style="color: var(--primary-color)">
                            SMK Telkom Malang
                        </a>
                    </div>
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="../index.html" class="text-gray-600 hover:text-primary px-3 py-2 text-sm font-medium transition duration-300">Home</a>
                        <a href="../pages/about.html" class="text-gray-600 hover:text-primary px-3 py-2 text-sm font-medium transition duration-300">About</a>
                        <a href="../pages/academic.html" class="text-gray-600 hover:text-primary px-3 py-2 text-sm font-medium transition duration-300">Academic</a>
                        <a href="../pages/admission.html" class="text-gray-600 hover:text-primary px-3 py-2 text-sm font-medium transition duration-300">Admission</a>
                        <a href="../pages/contact.html" class="text-gray-600 hover:text-primary px-3 py-2 text-sm font-medium transition duration-300">Contact</a>
                        <a href="../pages/extracurricular.html" class="text-gray-600 hover:text-primary px-3 py-2 text-sm font-medium transition duration-300">Extracurricular</a>
                        <a href="../pages/facilities.html" class="text-gray-600 hover:text-primary px-3 py-2 text-sm font-medium transition duration-300">Facilities</a>
                        <a href="../pages/news.html" class="text-gray-600 hover:text-primary px-3 py-2 text-sm font-medium transition duration-300">News</a>
                        <a href="../pages/ai-chat.html" class="text-white px-3 py-2 text-sm font-medium rounded-md transition duration-300" style="background-color: var(--primary-color);">AI Chat</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="pt-24 pb-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-center mb-8" style="color: var(--primary-color)">Input Data Siswa</h2>
                <div class="flex justify-start">
                    <a href="admin-dashboard.php" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition duration-300">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        <i class="fas fa-user-plus mr-2"></i> Tambah Data Siswa Baru
                    </h3>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $nis = $_POST['nis'] ?? '';
                        $nama = $_POST['nama'] ?? '';
                        $nilai = $_POST['nilai'] ?? '';
                        if ($nis && $nama && is_numeric($nilai)) {
                            $fp = fopen(KELULUSAN_DATA_PATH, 'a');
                            fputcsv($fp, [$nis, $nama, $nilai]);
                            fclose($fp);
                            echo '<div class="mb-4 rounded-md bg-green-50 p-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-check-circle text-green-400"></i>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-green-800">Data siswa berhasil ditambahkan!</p>
                                        </div>
                                    </div>
                                </div>';
                        } else {
                            echo '<div class="mb-4 rounded-md bg-red-50 p-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-exclamation-circle text-red-400"></i>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-red-800">Semua kolom wajib diisi dan nilai harus angka!</p>
                                        </div>
                                    </div>
                                </div>';
                        }
                    }
                    ?>
                    <form method="post" class="grid grid-cols-1 gap-4 sm:grid-cols-4 sm:gap-6">
                        <div>
                            <label for="nis" class="block text-sm font-medium text-gray-700 mb-1">NIS</label>
                            <input type="text" 
                                id="nis"
                                name="nis" 
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                                placeholder="NIS" 
                                required>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                            <input type="text" 
                                id="nama"
                                name="nama" 
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                                placeholder="Nama Lengkap" 
                                required>
                        </div>
                        <div>
                            <label for="nilai" class="block text-sm font-medium text-gray-700 mb-1">Nilai</label>
                            <input type="number" 
                                id="nilai"
                                name="nilai" 
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                                placeholder="0-100" 
                                min="0" 
                                max="100" 
                                required>
                            <div class="mt-4">
                                <button type="submit" 
                                    class="w-full inline-flex justify-center items-center px-4 py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-lg transition duration-300">
                                    <i class="fas fa-plus mr-2"></i> Tambah Data
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Add scroll behavior for header
        window.addEventListener('scroll', function() {
            const header = document.querySelector('header');
            header.classList.toggle('shadow-lg', window.scrollY > 0);
        });
    </script>
</body>
</html>