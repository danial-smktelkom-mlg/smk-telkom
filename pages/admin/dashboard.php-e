<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Handle deletion
if (isset($_POST['delete']) && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $registrations = [];
    
    if (($handle = fopen("../../assets/data/pendaftaran-ekskul.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle)) !== FALSE) {
            $registrations[] = $data;
        }
        fclose($handle);
        
        if (isset($registrations[$id])) {
            unset($registrations[$id]);
            
            $fp = fopen("../../assets/data/pendaftaran-ekskul.csv", "w");
            foreach ($registrations as $registration) {
                fputcsv($fp, $registration);
            }
            fclose($fp);
            
            $success = "Registration deleted successfully";
        }
    }
}

// Handle export
if (isset($_POST['export'])) {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="registrations.csv"');
    
    $fp = fopen('php://output', 'w');
    
    // Add headers
    fputcsv($fp, ['Name', 'Class', 'Activity', 'Registration Date']);
    
    if (($handle = fopen("../../assets/data/pendaftaran_eskul.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle)) !== FALSE) {
            fputcsv($fp, $data);
        }
        fclose($handle);
    }
    
    fclose($fp);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - SMK BOE Malang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="../../assets/js/config.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <span class="text-xl font-bold text-primary">Admin Dashboard</span>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <a href="logout.php" class="text-gray-600 hover:text-gray-900">Logout</a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="py-10">
            <header>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold leading-tight text-gray-900">
                        Extracurricular Registrations
                    </h1>
                </div>
            </header>
            <main>
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="px-4 py-8 sm:px-0">
                        <?php if (isset($success)): ?>
                            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                                <?php echo htmlspecialchars($success); ?>
                            </div>
                        <?php endif; ?>

                        <div class="mb-4">
                            <form method="post" class="inline-block">
                                <button type="submit" name="export" class="bg-primary text-white px-4 py-2 rounded hover:bg-primary/90">
                                    Export to CSV
                                </button>
                            </form>
                        </div>

                        <div class="bg-white shadow rounded-lg overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Class</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Activity</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registration Date</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php
                                    if (file_exists("../../assets/data/pendaftaran-ekskul.csv")) {
                                        $row = 0;
                                        if (($handle = fopen("../../assets/data/pendaftaran-ekskul.csv", "r")) !== FALSE) {
                                            while (($data = fgetcsv($handle)) !== FALSE) {
                                                echo '<tr>';
                                                foreach ($data as $cell) {
                                                    echo '<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">' . htmlspecialchars($cell) . '</td>';
                                                }
                                                echo '<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">';
                                                echo '<form method="post" class="inline-block">';
                                                echo '<input type="hidden" name="id" value="' . $row . '">';
                                                echo '<button type="submit" name="delete" class="text-red-600 hover:text-red-900" onclick="return confirm(\'Are you sure you want to delete this registration?\')">';
                                                echo 'Delete';
                                                echo '</button>';
                                                echo '</form>';
                                                echo '</td>';
                                                echo '</tr>';
                                                $row++;
                                            }
                                            fclose($handle);
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
