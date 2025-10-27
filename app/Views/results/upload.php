<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Upload Results</h1>
    <form action="/results/upload" method="post" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow">
        <?= csrf_field() ?>
        <div class="mb-4">
            <label for="excel" class="block text-sm font-medium text-gray-700">Upload Excel File</label>
            <input type="file" name="excel" id="excel" accept=".xlsx,.xls" class="mt-1 block w-full p-2 border rounded-md" required>
        </div>
        <button type="submit" class="w-full bg-<?= esc($school['primary_color']) ?> text-white p-2 rounded-md hover:bg-<?= esc($school['secondary_color']) ?>">Upload</button>
    </form>
</div>
<?= $this->endSection() ?>