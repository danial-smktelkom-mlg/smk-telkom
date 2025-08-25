<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Process form submission
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? '';
    $kelas = $_POST['kelas'] ?? '';
    $nisn = $_POST['nisn'] ?? '';
    $eskul = $_POST['eskul'] ?? '';
    $alasan = $_POST['alasan'] ?? '';
    
    if ($nama && $kelas && $nisn && $eskul && $alasan) {
        $csv_file = '../assets/data/pendaftaran-ekskur.csv';
        $isDuplicate = false;

        // Check for duplicate registration
        if (file_exists($csv_file) && ($handle = fopen($csv_file, "r")) !== FALSE) {
            while (($row = fgetcsv($handle)) !== FALSE) {
                if ($row[0] === $nama && $row[1] === $kelas) {
                    $isDuplicate = true;
                    break;
                }
            }
            fclose($handle);
        }

        if ($isDuplicate) {
            $message = '<div class="mb-4 p-4 bg-yellow-100 text-yellow-700 rounded-lg border border-yellow-200">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium">
                            Anda sudah terdaftar di ekstrakurikuler. Silakan hubungi admin untuk mengubah pendaftaran.
                        </p>
                    </div>
                </div>
            </div>';
        } else {
            // Create file with header if it doesn't exist
            if (!file_exists($csv_file)) {
                $fp = fopen($csv_file, 'w');
                fputcsv($fp, array('Nama', 'Kelas', 'NISN', 'Ekstrakurikuler', 'Alasan', 'Tanggal Daftar'));
                fclose($fp);
            }

            // Add new registration
            $data = array($nama, $kelas, $nisn, $eskul, $alasan, date('Y-m-d'));
            $fp = fopen($csv_file, 'a');
            
            if (fputcsv($fp, $data)) {
                fclose($fp);
                $message = '<div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg border border-green-200">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium">Pendaftaran berhasil!</p>
                            <p class="mt-2 text-sm">
                                Anda dapat mengelola pendaftaran Anda kapan saja dengan mengklik 
                                <a href="manage-registration.php" class="font-medium underline hover:text-green-800">di sini</a>.
                            </p>
                        </div>
                    </div>
                </div>';
            } else {
                fclose($fp);
                $message = '<div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg border border-red-200">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium">Gagal menyimpan pendaftaran.</p>
                        </div>
                    </div>
                </div>';
            }
        }
    } else {
        $message = '<div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg border border-red-200">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium">Semua field harus diisi.</p>
                </div>
            </div>
        </div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Ekstrakurikuler - SMK Telkom Malang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .form-input:focus, .form-select:focus, .form-textarea:focus {
            border-color: #001BB7;
            box-shadow: 0 0 0 1px #001BB7;
        }
    </style>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="../index.html" class="text-2xl font-bold text-[#001BB7] hover:text-[#001BB7]/90 transition">
                        SMK Telkom Malang
                    </a>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="extracurricular.html" class="text-gray-600 hover:text-gray-900 font-medium transition">
                        Daftar Ekstrakurikuler
                    </a>
                    <a href="manage-registration.php" 
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-[#001BB7] hover:bg-[#001BB7]/90 transition duration-150 ease-in-out shadow-sm">
                        Kelola Pendaftaran
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-[#001BB7]/5 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Form Pendaftaran Ekstrakurikuler</h2>
                <p class="mt-1 text-sm text-gray-600">Silakan isi form di bawah ini untuk mendaftar ekstrakurikuler</p>
            </div>
            
            <div class="p-6">
                <?php echo $message; ?>

                <form method="post" class="space-y-6">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama" required 
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#001BB7] focus:ring-[#001BB7] sm:text-sm transition duration-150 ease-in-out">
                        </div>

                        <div>
                            <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
                            <input type="text" name="kelas" id="kelas" required 
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#001BB7] focus:ring-[#001BB7] sm:text-sm transition duration-150 ease-in-out"
                                placeholder="Contoh: X RPL 1">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label for="nisn" class="block text-sm font-medium text-gray-700">NISN</label>
                            <input type="text" name="nisn" id="nisn" required 
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#001BB7] focus:ring-[#001BB7] sm:text-sm transition duration-150 ease-in-out"
                                placeholder="Masukkan NISN Anda">
                        </div>

                        <div>
                            <label for="eskul" class="block text-sm font-medium text-gray-700">Ekstrakurikuler</label>
                            <select name="eskul" id="eskul" required 
                                class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#001BB7] focus:ring-[#001BB7] sm:text-sm transition duration-150 ease-in-out">
                                <option value="">Pilih Ekstrakurikuler</option>
                                <option value="Basketball">Basketball</option>
                                <option value="Volleyball">Volleyball</option>
                                <option value="Futsal">Futsal</option>
                                <option value="Band">Band Musik</option>
                                <option value="Dance">Modern Dance</option>
                                <option value="Photography">Photography</option>
                                <option value="Robotics">Robotics</option>
                                <option value="Coding">Coding Club</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="alasan" class="block text-sm font-medium text-gray-700">Alasan Mengikuti</label>
                        <textarea name="alasan" id="alasan" required 
                            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-[#001BB7] focus:ring-[#001BB7] sm:text-sm transition duration-150 ease-in-out"
                            rows="4"
                            placeholder="Mengapa Anda ingin mengikuti ekstrakurikuler ini?"></textarea>
                        <p class="mt-2 text-sm text-gray-500">Jelaskan mengapa Anda tertarik dengan ekstrakurikuler ini dan apa yang ingin Anda capai.</p>
                    </div>

                    <div>
                        <button type="submit" 
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-[#001BB7] hover:bg-[#001BB7]/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#001BB7] transition duration-150 ease-in-out">
                            Daftar Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Daftar Pendaftaran -->
        <div class="mt-8 bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-[#001BB7]/5 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Daftar Pendaftaran Ekstrakurikuler</h2>
                <p class="mt-1 text-sm text-gray-600">Berikut adalah daftar siswa yang telah mendaftar ekstrakurikuler</p>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kelas</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NISN</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ekstrakurikuler</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alasan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php
                        $csv_file = '../assets/data/pendaftaran-ekskur.csv';
                        if (file_exists($csv_file)) {
                            if (($handle = fopen($csv_file, "r")) !== FALSE) {
                                // Skip header
                                fgetcsv($handle);
                                
                                // Read and display data
                                while (($data = fgetcsv($handle)) !== FALSE) {
                                    echo '<tr class="hover:bg-gray-50">';
                                    foreach ($data as $cell) {
                                        echo '<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">' . htmlspecialchars($cell) . '</td>';
                                    }
                                    echo '</tr>';
                                }
                                fclose($handle);
                            }
                        } else {
                            echo '<tr><td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada pendaftaran</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Table Footer with Stats -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <?php
                $total_pendaftar = 0;
                $ekstrakurikuler_count = [];
                
                if (file_exists($csv_file)) {
                    if (($handle = fopen($csv_file, "r")) !== FALSE) {
                        // Skip header
                        fgetcsv($handle);
                        
                        while (($data = fgetcsv($handle)) !== FALSE) {
                            $total_pendaftar++;
                            $ekstrakurikuler = $data[3];
                            $ekstrakurikuler_count[$ekstrakurikuler] = ($ekstrakurikuler_count[$ekstrakurikuler] ?? 0) + 1;
                        }
                        fclose($handle);
                    }
                }
                ?>
                <div class="text-sm text-gray-600">
                    <p>Total Pendaftar: <span class="font-medium"><?php echo $total_pendaftar; ?></span></p>
                    <?php if (!empty($ekstrakurikuler_count)): ?>
                        <div class="mt-2">
                            <p class="font-medium mb-1">Distribusi per Ekstrakurikuler:</p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2">
                                <?php foreach ($ekstrakurikuler_count as $eskul => $count): ?>
                                    <div class="flex items-center space-x-2">
                                        <div class="w-2 h-2 rounded-full bg-[#001BB7]"></div>
                                        <span><?php echo htmlspecialchars($eskul); ?>: <?php echo $count; ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-white mt-8 border-t border-gray-200">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-sm text-gray-500">
                &copy; 2025 SMK Telkom Malang. All rights reserved.
            </p>
        </div>
    </footer>
</body>
</html>