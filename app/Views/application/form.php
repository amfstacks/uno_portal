<?= $this->extend('layouts/header') ?>
<?= $this->section('content') ?>
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Admission Application - <?= esc($school['name']) ?></h1>
    <form action="/application/submit" method="post" class="bg-white p-6 rounded-lg shadow">
        <?= csrf_field() ?>
        <div class="mb-4">
            <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
            <input type="text" name="full_name" id="full_name" class="mt-1 block w-full p-2 border rounded-md" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="mt-1 block w-full p-2 border rounded-md" required>
        </div>
        <div class="mb-4">
            <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
            <input type="text" name="phone" id="phone" class="mt-1 block w-full p-2 border rounded-md" required>
        </div>
        <div class="mb-4">
            <label for="course_applied" class="block text-sm font-medium text-gray-700">Course Applied</label>
            <input type="text" name="course_applied" id="course_applied" class="mt-1 block w-full p-2 border rounded-md" required>
        </div>
        <button type="submit" class="w-full bg-<?= esc($school['primary_color']) ?> text-white p-2 rounded-md hover:bg-<?= esc($school['secondary_color']) ?>">Apply</button>
    </form>
</div>
<?= $this->endSection() ?>