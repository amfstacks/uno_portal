<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Admin Dashboard - <?= esc($school['name']) ?></h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="text-lg font-semibold">Total Students</h3>
            <p class="text-2xl"><?= $total_students ?></p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="text-lg font-semibold">Pending Payments</h3>
            <p class="text-2xl"><?= $pending_payments ?></p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="text-lg font-semibold">Active Session</h3>
            <p><?= $active_session['session_name'] ?? 'None' ?> (<?= $active_session['semester'] ?? '' ?>)</p>
        </div>
    </div>
    <div class="mt-6">
        <h2 class="text-xl font-bold">Actions</h2>
        <div class="flex space-x-4">
            <a href="/admin/toggle-application/1" class="bg-green-500 text-white p-2 rounded hover:bg-green-600">Open Applications</a>
            <a href="/admin/toggle-application/0" class="bg-red-500 text-white p-2 rounded hover:bg-red-600">Close Applications</a>
            <a href="/admin/exam-officers" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Manage Exam Officers</a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>