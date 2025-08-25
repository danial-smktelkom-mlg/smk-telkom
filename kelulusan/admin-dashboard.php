<?php
session_start();
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header('Location: login.php');
    exit;
}

require_once 'config.php';

$hapus_success = '';
if (isset($_GET['hapus']) && $_GET['hapus']) {
    $hapus_nis = $_GET['hapus'];
    $rows = [];
    if (($file = fopen(KELULUSAN_DATA_PATH, "r")) !== FALSE) {
        while (($data = fgetcsv($file)) !== FALSE) {
            if ($data[0] !== $hapus_nis) $rows[] = $data;
        }
        fclose($file);
    }
    $file = fopen(KELULUSAN_DATA_PATH, "w");
    foreach ($rows as $row) fputcsv($file, $row);
    fclose($file);
    $hapus_success = 'Data siswa dengan NIS ' . $hapus_nis . ' berhasil dihapus!';
}

$edit_nis = isset($_GET['edit']) ? $_GET['edit'] : '';
$edit_data = [];
if ($edit_nis) {
    if (($file = fopen(KELULUSAN_DATA_PATH, "r")) !== FALSE) {
        while (($data = fgetcsv($file)) !== FALSE) {
            if ($data[0] == $edit_nis) {
                $edit_data = $data;
                break;
            }
        }
        fclose($file);
    }
}
$edit_success = '';
if (isset($_POST['edit_nis'])) {
    $old_nis = $_POST['old_nis'];
    $new_nis = $_POST['edit_nis'];
    $new_nama = $_POST['edit_nama'];
    $new_nilai = $_POST['edit_nilai'];
    $rows = [];
    if (($file = fopen(KELULUSAN_DATA_PATH, "r")) !== FALSE) {
        while (($data = fgetcsv($file)) !== FALSE) {
            if ($data[0] == $old_nis) $rows[] = [$new_nis, $new_nama, $new_nilai];
            else $rows[] = $data;
        }
        fclose($file);
    }
    $file = fopen(KELULUSAN_DATA_PATH, "w");
    foreach ($rows as $row) fputcsv($file, $row);
    fclose($file);
    $edit_success = "Data siswa berhasil diubah!";
    header("Location: admin-dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelulusan Siswa SMK Telkom Malang - Admin Dashboard</title>
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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-center mb-8" style="color: var(--primary-color)">Panel Admin Kelulusan</h2>
                <div class="flex flex-wrap justify-between items-center gap-4">
                    <div>
                        <a href="admin-input.php" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white rounded-lg transition duration-300" style="background-color: var(--primary-color)">
                            <i class="fas fa-plus mr-2"></i> Tambah Data
                        </a>
                    </div>
                    <div class="flex gap-2">
                        <a href="export-pdf.php" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-lg transition duration-300">
                            <i class="fas fa-file-pdf mr-2"></i> Export PDF
                        </a>
                        <a href="logout.php" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg transition duration-300">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
            <?php if ($hapus_success): ?>
            <div class="mb-4 rounded-md bg-green-50 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800"><?php echo $hapus_success; ?></p>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
            <?php if ($edit_success): ?>
            <div class="mb-4 rounded-md bg-green-50 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-check-circle text-green-400"></i>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800"><?php echo $edit_success; ?></p>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <?php if ($edit_nis && !empty($edit_data)): ?>
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
                <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        <i class="fas fa-edit mr-2"></i> Edit Data Siswa
                    </h3>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <form method="post" class="grid grid-cols-1 gap-4 sm:grid-cols-4 sm:gap-6">
                        <input type="hidden" name="old_nis" value="<?php echo htmlspecialchars($edit_data[0]); ?>">
                        <div>
                            <label for="edit_nis" class="block text-sm font-medium text-gray-700 mb-1">NIS</label>
                            <input type="text" 
                                id="edit_nis"
                                name="edit_nis" 
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                                value="<?php echo htmlspecialchars($edit_data[0]); ?>" 
                                required>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="edit_nama" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                            <input type="text" 
                                id="edit_nama"
                                name="edit_nama" 
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                                value="<?php echo htmlspecialchars($edit_data[1]); ?>" 
                                required>
                        </div>
                        <div>
                            <label for="edit_nilai" class="block text-sm font-medium text-gray-700 mb-1">Nilai</label>
                            <input type="number" 
                                id="edit_nilai"
                                name="edit_nilai" 
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" 
                                value="<?php echo htmlspecialchars($edit_data[2]); ?>" 
                                min="0" 
                                max="100" 
                                required>
                            <div class="mt-4">
                                <button type="submit" 
                                    class="w-full inline-flex justify-center items-center px-4 py-2 text-sm font-medium text-white bg-yellow-600 hover:bg-yellow-700 rounded-lg transition duration-300">
                                    <i class="fas fa-save mr-2"></i> Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php endif; ?>
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
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
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
                        echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-gray-500'>
                                <a href='admin-dashboard.php?edit=$nis' class='text-yellow-600 hover:text-yellow-900 mr-3'><i class='fas fa-edit'></i> Edit</a>
                                <a href='admin-dashboard.php?hapus=$nis' class='text-red-600 hover:text-red-900' onclick=\"return confirm('Yakin ingin menghapus?')\"><i class='fas fa-trash'></i> Hapus</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                }
                fclose($file);
            } else {
                echo '<tr><td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-center text-red-500">File data siswa tidak ditemukan.</td></tr>';
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