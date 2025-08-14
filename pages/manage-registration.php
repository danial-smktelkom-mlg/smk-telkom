<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

$message = '';
$registrationData = null;

// Function to find registration by name and class
function findRegistration($nama, $kelas) {
    $csv_file = '../assets/data/pendaftaran-ekskul.csv';
    if (file_exists($csv_file) && ($handle = fopen($csv_file, "r")) !== FALSE) {
        // Skip header
        fgetcsv($handle);
        
        while (($data = fgetcsv($handle)) !== FALSE) {
            if ($data[0] === $nama && $data[1] === $kelas) {
                fclose($handle);
                return $data;
            }
        }
        fclose($handle);
    }
    return null;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'search') {
            $nama = $_POST['nama'] ?? '';
            $kelas = $_POST['kelas'] ?? '';
            
            if ($nama && $kelas) {
                $registrationData = findRegistration($nama, $kelas);
                if (!$registrationData) {
                    $message = '<div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg border border-red-200">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium">Pendaftaran tidak ditemukan untuk nama dan kelas tersebut.</p>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                $message = '<div class="mb-4 p-4 bg-yellow-100 text-yellow-700 rounded-lg border border-yellow-200">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium">Mohon isi nama dan kelas untuk mencari pendaftaran.</p>
                        </div>
                    </div>
                </div>';
            }
        }
        elseif ($_POST['action'] === 'delete' && isset($_POST['nama']) && isset($_POST['kelas'])) {
            $nama = $_POST['nama'];
            $kelas = $_POST['kelas'];
            $csv_file = '../assets/data/pendaftaran-ekskul.csv';
            $temp_file = '../assets/data/temp.csv';
            $deleted = false;

            if (file_exists($csv_file)) {
                $input = fopen($csv_file, 'r');
                $output = fopen($temp_file, 'w');

                // Copy header
                $header = fgetcsv($input);
                fputcsv($output, $header);

                // Copy all rows except the one to delete
                while (($data = fgetcsv($input)) !== FALSE) {
                    if ($data[0] !== $nama || $data[1] !== $kelas) {
                        fputcsv($output, $data);
                    } else {
                        $deleted = true;
                    }
                }

                fclose($input);
                fclose($output);

                // Replace original file with new file
                if ($deleted) {
                    unlink($csv_file);
                    rename($temp_file, $csv_file);
                    chmod($csv_file, 0666); // Make file writable
                    $message = '<div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg border border-green-200">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium">Pendaftaran berhasil dihapus.</p>
                            </div>
                        </div>
                    </div>';
                    $registrationData = null; // Clear the displayed data
                } else {
                    unlink($temp_file);
                    $message = '<div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg border border-red-200">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium">Pendaftaran tidak ditemukan.</p>
                            </div>
                        </div>
                    </div>';
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pendaftaran Ekstrakurikuler - SMK BOE Malang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .form-input:focus, .form-select:focus {
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
                        SMK BOE Malang
                    </a>
                </div>
                <div class="flex items-center space-x-6">
                    <a href="extracurricular.html" class="text-gray-600 hover:text-gray-900 font-medium transition">
                        Daftar Ekstrakurikuler
                    </a>
                    <a href="extracurricular-registration.php" 
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-[#001BB7] hover:bg-[#001BB7]/90 transition duration-150 ease-in-out shadow-sm">
                        Form Pendaftaran
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-[#001BB7]/5 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Kelola Pendaftaran Ekstrakurikuler</h2>
                <p class="mt-1 text-sm text-gray-600">Cari dan kelola pendaftaran ekstrakurikuler Anda</p>
            </div>
            
            <div class="p-6">
                <?php echo $message; ?>

                <!-- Search Form -->
                <form method="post" class="mb-8 space-y-6">
                    <input type="hidden" name="action" value="search">
                    
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-blue-700">
                                    Masukkan nama lengkap dan kelas Anda untuk melihat atau menghapus pendaftaran ekstrakurikuler.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
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

                    <div>
                        <button type="submit" 
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-[#001BB7] hover:bg-[#001BB7]/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#001BB7] transition duration-150 ease-in-out">
                            Cari Pendaftaran
                        </button>
                    </div>
                </form>

                <?php if ($registrationData): ?>
                <!-- Registration Details -->
                <div class="border rounded-lg p-6 bg-gray-50 space-y-6">
                    <h3 class="text-lg font-medium text-gray-900">Detail Pendaftaran</h3>
                    
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Nama</dt>
                            <dd class="mt-1 text-sm text-gray-900"><?php echo htmlspecialchars($registrationData[0]); ?></dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Kelas</dt>
                            <dd class="mt-1 text-sm text-gray-900"><?php echo htmlspecialchars($registrationData[1]); ?></dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-500">NISN</dt>
                            <dd class="mt-1 text-sm text-gray-900"><?php echo htmlspecialchars($registrationData[2]); ?></dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Ekstrakurikuler</dt>
                            <dd class="mt-1 text-sm text-gray-900"><?php echo htmlspecialchars($registrationData[3]); ?></dd>
                        </div>
                        
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Alasan</dt>
                            <dd class="mt-1 text-sm text-gray-900"><?php echo htmlspecialchars($registrationData[4]); ?></dd>
                        </div>
                        
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Tanggal Daftar</dt>
                            <dd class="mt-1 text-sm text-gray-900"><?php echo htmlspecialchars($registrationData[5]); ?></dd>
                        </div>
                    </dl>

                    <!-- Delete Form -->
                    <form method="post" class="mt-6">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="nama" value="<?php echo htmlspecialchars($registrationData[0]); ?>">
                        <input type="hidden" name="kelas" value="<?php echo htmlspecialchars($registrationData[1]); ?>">
                        
                        <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-150 ease-in-out"
                            onclick="return confirm('Apakah Anda yakin ingin menghapus pendaftaran ini?')">
                            <svg class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            Hapus Pendaftaran
                        </button>
                    </form>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <footer class="bg-white mt-8 border-t border-gray-200">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <p class="text-center text-sm text-gray-500">
                &copy; 2025 SMK BOE Malang. All rights reserved.
            </p>
        </div>
    </footer>
</body>
</html>
