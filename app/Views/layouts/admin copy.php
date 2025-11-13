<?= $this->extend('layouts/header') ?>
<?= $this->section('content') ?>
<div class="flex">
    <aside class="w-64 bg-<?= esc($school['secondary_color']) ?> text-white min-h-screen p-4">
        <h2 class="text-xl font-bold mb-4"><?= esc($school['short_name']) ?> Admin</h2>
        <nav>
            <ul>
                <li><a href="/admin/dashboard" class="block p-2 hover:bg-<?= esc($school['primary_color']) ?>">Dashboard</a></li>
                <li><a href="/admin/exam-officers" class="block p-2 hover:bg-<?= esc($school['primary_color']) ?>">Exam Officers</a></li>
                <li><a href="/registration/list" class="block p-2 hover:bg-<?= esc($school['primary_color']) ?>">Registration List</a></li>
                <li><a href="/application/list" class="block p-2 hover:bg-<?= esc($school['primary_color']) ?>">Applications</a></li>
            </ul>
        </nav>
    </aside>
    <main class="flex-1 p-4">
        <?= $this->renderSection('content') ?>
    </main>
</div>
<?= $this->extend('layouts/footer') ?>