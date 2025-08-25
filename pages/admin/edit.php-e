<?php
session_start();
require_once '../../includes/csv_handler.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

$csv_handler = new CSVHandler("../../assets/data/pendaftaran-ekskul.csv");

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $nama = $_POST['nama'] ?? '';
    $kelas = $_POST['kelas'] ?? '';
    $eskul = $_POST['eskul'] ?? '';
    $registration_date = $_POST['registration_date'] ?? date('Y-m-d H:i:s');

    if ($id !== null && $nama && $kelas && $eskul) {
        if ($csv_handler->update($id, [$nama, $kelas, $eskul, $registration_date])) {
            $success = "Registration updated successfully";
            header('Location: dashboard.php');
            exit;
        } else {
            $error = "Failed to update registration";
        }
    }
}

// Get registration data
$id = $_GET['id'] ?? null;
if ($id === null) {
    header('Location: dashboard.php');
    exit;
}

$registration = $csv_handler->getById($id);
if (!$registration) {
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Registration - SMK BOE Malang</title>
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
                    <div class="flex items-center space-x-4">
                        <a href="dashboard.php" class="text-gray-600 hover:text-gray-900">Back to Dashboard</a>
                        <a href="logout.php" class="text-gray-600 hover:text-gray-900">Logout</a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="py-10">
            <header>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold leading-tight text-gray-900">
                        Edit Registration
                    </h1>
                </div>
            </header>
            <main>
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="px-4 py-8 sm:px-0">
                        <?php if (isset($error)): ?>
                            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                                <?php echo htmlspecialchars($error); ?>
                            </div>
                        <?php endif; ?>

                        <div class="bg-white shadow rounded-lg p-6">
                            <form method="post" class="space-y-6">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                                <input type="hidden" name="registration_date" value="<?php echo htmlspecialchars($registration[3]); ?>">
                                
                                <div>
                                    <label for="nama" class="block text-sm font-medium text-gray-700">Full Name</label>
                                    <input type="text" name="nama" id="nama" required
                                        value="<?php echo htmlspecialchars($registration[0]); ?>"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                                </div>
                                
                                <div>
                                    <label for="kelas" class="block text-sm font-medium text-gray-700">Class</label>
                                    <input type="text" name="kelas" id="kelas" required
                                        value="<?php echo htmlspecialchars($registration[1]); ?>"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                                </div>
                                
                                <div>
                                    <label for="eskul" class="block text-sm font-medium text-gray-700">Activity</label>
                                    <select name="eskul" id="eskul" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                                        <?php
                                        $activities = ['Basketball', 'Volleyball', 'Futsal', 'Band', 'Dance', 'Photography', 'Robotics', 'Coding Club'];
                                        foreach ($activities as $activity) {
                                            $selected = ($activity === $registration[2]) ? 'selected' : '';
                                            echo "<option value=\"$activity\" $selected>$activity</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="flex space-x-4">
                                    <button type="submit"
                                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                        Update Registration
                                    </button>
                                    <a href="dashboard.php"
                                        class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                        Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>
