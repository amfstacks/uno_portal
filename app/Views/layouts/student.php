<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal | <?= esc($school['name']) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .primary { background-color: <?= $school['primary_color'] ?? '#1e40af' ?>; }
        .primary-text { color: <?= $school['primary_color'] ?? '#1e40af' ?>; }
    </style>
</head>
<body class="h-full bg-gray-50">

<div class="flex h-full">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-900 text-white flex flex-col">
        <div class="p-6 border-b border-gray-800">
            <div class="flex items-center space-x-3">
                <img src="<?= esc($school['logo']) ?>" class="h-10 w-10 rounded">
                <div>
                    <div class="font-bold"><?= esc($school['short_name']) ?></div>
                    <div class="text-xs opacity-75">Student Portal</div>
                </div>
            </div>
        </div>
        <nav class="flex-1 p-4 space-y-2">
            <a href="/student/dashboard" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-800 <?= uri_string() === 'student/dashboard' ? 'bg-gray-800' : '' ?>">
                <i class="fas fa-home"></i><span>Dashboard</span>
            </a>
            <a href="/student/courses/register" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-800">
                <i class="fas fa-book"></i><span>Course Registration</span>
            </a>
            <a href="/student/results" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-800">
                <i class="fas fa-chart-line"></i><span>Results & GPA</span>
            </a>
            <a href="/student/fees" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-800">
                <i class="fas fa-money-bill-wave"></i><span>Fee Breakdown</span>
            </a>
            <a href="/student/payments" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-800">
                <i class="fas fa-history"></i><span>Payment History</span>
            </a>
            <a href="/student/transcript" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-800">
                <i class="fas fa-file-pdf"></i><span>Transcript</span>
            </a>
            <a href="/student/support" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-gray-800">
                <i class="fas fa-headset"></i><span>Support</span>
            </a>
            <a href="/logout" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-red-900/50 text-red-400">
                <i class="fas fa-sign-out-alt"></i><span>Logout</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <header class="bg-white shadow-sm border-b border-gray-200 px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800"><?= $title ?? 'Student Portal' ?></h1>
            <div class="flex items-center space-x-4">
                <div class="text-right">
                    <div class="font-medium"><?= esc($student['full_name']) ?></div>
                    <div class="text-sm text-gray-500"><?= esc($student['matric_no']) ?></div>
                </div>
                <img src="https://ui-avatars.com/api/?name=<?= urlencode($student['full_name']) ?>&background=1e40af&color=fff" class="w-10 h-10 rounded-full">
            </div>
        </header>
        <main class="flex-1 p-6 overflow-y-auto">
            <?= $this->renderSection('content') ?>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({ duration: 600, once: true });
    function toast(msg, type = 'success') {
        const colors = { success: 'bg-green-600', error: 'bg-red-600', info: 'bg-blue-600' };
        const div = document.createElement('div');
        div.className = `fixed bottom-4 right-4 text-white ${colors[type]} px-6 py-3 rounded-lg shadow-lg z-50 animate-pulse`;
        div.innerHTML = `<i class="fas fa-check mr-2"></i>${msg}`;
        document.body.appendChild(div);
        setTimeout(() => div.remove(), 4000);
    }
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</body>
</html>