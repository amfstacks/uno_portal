<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($school['name']) ?> | Admin</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '<?= $school['primary_color'] ?? "#1e40af" ?>',
                        secondary: '<?= $school['secondary_color'] ?? "#1e293b" ?>',
                    },
                    fontFamily: {
                        sans: ['Montserrat', 'ui-sans-serif', 'system-ui']
                    }
                }
            }
        }
    </script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Alpine.js for interactivity -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js" ></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Custom CSS -->
    <style>
        <?= $school['custom_css'] ?? '' ?>
         body {
            font-family: 'Montserrat', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif;
        }
        .sidebar-open { transform: translateX(0); }
        .sidebar-closed { transform: translateX(-100%); }
        .fade-in { animation: fadeIn 0.3s ease-in; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    </style>
</head>
<body class="h-full bg-gray-50 text-gray-800 antialiased">

<div x-data="{ sidebarOpen: true }" class="flex h-full">

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
           class="fixed inset-y-0 left-0 z-50 w-64 bg-secondary text-white transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0">
        <div class="flex items-center justify-between p-4 border-b border-white/10">
            <div class="flex items-center space-x-2">
                <img src="<?= esc($school['logo']) ?>" alt="Logo" class="h-10 w-10 rounded">
                <span class="text-lg font-bold"><?= esc($school['short_name'] ?? $school['name']) ?></span>
            </div>
            <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <nav class="p-4 space-y-1">
            <a href="/admin/dashboard" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-primary/20 transition <?= uri_string() === 'admin/dashboard' ? 'bg-primary/30' : '' ?>">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="/admin/users" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-primary/20 transition <?= uri_string() === 'admin/users' ? 'bg-primary/30' : '' ?>">
    <i class="fas fa-users-cog"></i>
    <span>User Management</span>
</a>
<a href="/admin/academic/faculties" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-primary/20 transition <?= uri_string() === 'admin/academic/faculties' ? 'bg-primary/30' : '' ?>">
    <i class="fas fa-university"></i>
    <span>Academic Structure</span>
</a>
<a href="/admin/academic/departments" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-primary/20 transition">
    <i class="fas fa-layer-group"></i>
    <span>Departments</span>
</a>
<a href="/admin/fees" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-primary/20 transition <?= uri_string() === 'admin/fees' ? 'bg-primary/30' : '' ?>">
    <i class="fas fa-money-bill-wave"></i>
    <span>Fee Structure</span>
</a>
            <a href="/admin/registration-list" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-primary/20 transition">
                <i class="fas fa-users"></i>
                <span>Registration List</span>
            </a>
            <a href="/admin/settings" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-primary/20 transition">
                <i class="fas fa-cog"></i>
                <span>Portal Settings</span>
            </a>
            <a href="/logout" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-red-600/20 transition">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Navbar -->
        <header class="bg-white shadow-sm border-b border-gray-200">
            <div class="flex items-center justify-between px-6 py-4">
                <button @click="sidebarOpen = true" class="lg:hidden">
                    <i class="fas fa-bars text-xl text-gray-600"></i>
                </button>

                <div class="flex items-center space-x-4">
                    <!-- School Switcher (Admin only) -->
                  

                    <!-- User Dropdown -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center space-x-2 text-sm">
                            <i class="fas fa-user-circle text-2xl"></i>
                            <span class="hidden sm:inline"><?= esc(session()->get('email') ?? 'Admin') ?></span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        <div x-show="open" @click.away="open = false" 
                             class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50">
                            <a href="/admin/settings" class="block px-4 py-2 text-sm hover:bg-gray-100">Settings</a>
                            <a href="/logout" class="block px-4 py-2 text-sm hover:bg-gray-100 text-red-600">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 p-6 overflow-y-auto">
            <div class="max-w-7xl mx-auto">
                <?= $this->renderSection('content') ?>
            </div>
        </main>
    </div>
</div>

<!-- Footer (optional) -->
<footer class="bg-white border-t border-gray-200 py-3 text-center text-xs text-gray-500">
    &copy; <?= date('Y') ?> <?= esc($school['name']) ?>. All rights reserved.
</footer>

<!-- Toast Container -->
<div id="toast-container" class="fixed bottom-4 right-4 space-y-2 z-50"></div>
<?php
  $types = ['error', 'warning', 'success'];
  $flashType = null;
  $flashMessage = null;

  foreach ($types as $type) {
      if (session()->getFlashdata($type)) {
          $flashType = $type;
          $flashMessage = session()->getFlashdata($type);
          break;
      }
  }
?>

<?php if ($flashType): ?>
  <script>
    const icons = {
      error: { icon: 'error', title: 'Oops...', color: '#4A90E2' },
      warning: { icon: 'warning', title: 'Warning', color: '#F39C12' },
      success: { icon: 'success', title: 'Success!', color: '#28A745' }
    };
// showToast(flash.title, '', flashType);
    const flash = icons['<?= $flashType ?>'];

    Swal.fire({
      icon: flash.icon,
      title: flash.flash,
      text: '<?= esc($flashMessage) ?>',
      confirmButtonColor: flash.color
    });
  </script>
<?php endif; ?>

<!-- <script>

    
    // Toast function
    function toast(message, type = 'success') {
        const bg = type === 'success' ? 'bg-green-600' : type === 'error' ? 'bg-red-600' : 'bg-blue-600';
        const toast = document.createElement('div');
        toast.className = `text-white ${bg} px-6 py-3 rounded-lg shadow-lg fade-in transform transition-all duration-300`;
        toast.innerHTML = `<i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-triangle'} mr-2"></i>${message}`;
        document.getElementById('toast-container').appendChild(toast);
        setTimeout(() => toast.remove(), 4000);
    }

    // Auto-show Laravel-style session messages
    @if (session()->has('toast'))
        toast("{{ session('toast') }}", "success");
    @endif
</script> -->
<?php if (session()->getFlashdata('toast')): ?>
    <!-- <script>
        const flashToast = <?= json_encode(session()->getFlashdata('toast')) ?>;
        showToast(flashToast.message, '', flashToast.type);
    </script> -->
<?php endif; ?>


<?= $this->include('layouts/footer') ?>
</body>
</html>