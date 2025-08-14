<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelulusan Siswa SMK BOE Malang - User</title>
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
                            SMK BOE Malang
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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-center mb-8" style="color: var(--primary-color)">Daftar Kelulusan Siswa</h2>
                <div class="flex justify-between items-center">
                    <a href="home.php" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition duration-300">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Home
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
                <div class="p-6">
                    <form method="get" class="flex flex-col sm:flex-row gap-4">
                        <input type="text" 
                            name="cari" 
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                            placeholder="Cari NIS atau Nama..." 
                            value="<?php echo isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : ''; ?>">
                        <button type="submit" 
                            class="px-6 py-2 text-white rounded-lg transition duration-300 sm:w-auto w-full" 
                            style="background-color: var(--primary-color)">
                            <i class="fas fa-search mr-2"></i> Cari
                        </button>
                    </form>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-md overflow-hidden overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIS</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Kelulusan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
            <?php
            $keyword = isset($_GET['cari']) ? strtolower(trim($_GET['cari'])) : '';
            if (($file = fopen(KELULUSAN_DATA_PATH, "r")) !== FALSE) {
                $header = fgetcsv($file);
                while (($data = fgetcsv($file)) !== FALSE) {
                    $nis = htmlspecialchars($data[0]);
                    $nama = htmlspecialchars($data[1]);
                    $nilai = (int)$data[2];
                    $status = $nilai >= 75 ? "LULUS" : "TIDAK LULUS";
                    $statusClass = $nilai >= 75 ? "table-success" : "table-danger";
                    if ($keyword == '' || strpos(strtolower($nis), $keyword) !== false || strpos(strtolower($nama), $keyword) !== false) {
                        $statusColor = $nilai >= 75 ? "bg-green-100 text-green-800" : "bg-red-100 text-red-800";
                        echo "<tr class='hover:bg-gray-50'>";
                        echo "<td class='px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900'>$nis</td>";
                        echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-gray-900'>$nama</td>";
                        echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center'>$nilai</td>";
                        echo "<td class='px-6 py-4 whitespace-nowrap text-center'><span class='px-2 inline-flex text-xs leading-5 font-semibold rounded-full $statusColor'>$status</span></td>";
                        echo "</tr>";
                    }
                }
                fclose($file);
            } else {
                echo '<tr><td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-center text-red-500">File data siswa tidak ditemukan.</td></tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
    
    <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-info-circle text-blue-400"></i>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-blue-800">Kriteria Kelulusan</h3>
                <div class="mt-2 text-sm text-blue-700">
                    Nilai minimal <span class="font-semibold">75</span> dinyatakan 
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">LULUS</span>
                </div>
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