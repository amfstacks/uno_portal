<?= $this->extend('layouts/header') ?>
<?= $this->section('content') ?>
<div class="flex">
    <aside class="w-64 bg-<?= esc($school['secondary_color']) ?> text-white min-h-screen p-4">
        <h2 class="text-xl font-bold mb-4"><?= esc($school['short_name']) ?> Student</h2>
        <nav>
            <ul>
                <li><a href="/student/dashboard" class="block p-2 hover:bg-<?= esc($school['primary_color']) ?>">Dashboard</a></li>
                <li><a href="/student/courses" class="block p-2 hover:bg-<?= esc($school['primary_color']) ?>">My Courses</a></li>
                <li><a href="/student/results" class="block p-2 hover:bg-<?= esc($school['primary_color']) ?>">Results</a></li>
                <li><a href="/student/documents" class="block p-2 hover:bg-<?= esc($school['primary_color']) ?>">Documents</a></li>
                <li><a href="/student/support" class="block p-2 hover:bg-<?= esc($school['primary_color']) ?>">Support</a></li>
            </ul>
        </nav>
    </aside>
    <main class="flex-1 p-4">
        <?= $this->renderSection('content') ?>
    </main>
</div>
<?= $this->extend('layouts/footer') ?>