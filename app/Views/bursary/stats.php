<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Bursary Dashboard - Payment Statistics</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="text-lg font-semibold">Total Paid</h3>
            <p class="text-2xl">$<?= number_format($stats['total_paid'], 2) ?></p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <h3 class="text-lg font-semibold">Total Students</h3>
            <p class="text-2xl"><?= $stats['total_students'] ?></p>
        </div>
    </div>
    <a href="/bursary/payments" class="mt-4 inline-block bg-<?= esc($school['primary_color']) ?> text-white p-2 rounded hover:bg-<?= esc($school['secondary_color']) ?>">View All Payments</a>
</div>
<?= $this->endSection() ?>