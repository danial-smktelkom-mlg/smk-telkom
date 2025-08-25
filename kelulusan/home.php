<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - Kelulusan Siswa SMK Telkom Malang</title>
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
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-6" style="color: var(--primary-color)">Aplikasi Kelulusan Siswa</h1>
                <p class="text-xl text-gray-600 mb-8">
                    Selamat datang di sistem informasi kelulusan siswa.<br>
                    Silakan klik tombol di bawah untuk melihat daftar kelulusan.
                </p>
                <div class="space-y-4">
                    <a href="user-view.php" class="inline-block px-8 py-3 text-white rounded-lg transition duration-300 text-lg font-medium w-full sm:w-auto" style="background-color: var(--primary-color)">Lihat Daftar Kelulusan</a>
                    <div class="mt-4">
                        <a href="login.php" class="text-sm text-gray-600 hover:text-blue-600 transition-colors">Login Admin</a>
                    </div>
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