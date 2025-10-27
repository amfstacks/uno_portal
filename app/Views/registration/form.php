<?= $this->extend('layouts/student') ?>
<?= $this->section('content') ?>
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Course Registration</h1>
    <form action="/registration/submit" method="post" class="bg-white p-6 rounded-lg shadow">
        <?= csrf_field() ?>
        <div class="mb-4">
            <label for="matric_no" class="block text-sm font-medium text-gray-700">Matric Number</label>
            <input type="text" name="matric_no" id="matric_no" class="mt-1 block w-full p-2 border rounded-md" required>
        </div>
        <div class="mb-4">
            <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
            <input type="text" name="full_name" id="full_name" class="mt-1 block w-full p-2 border rounded-md" required>
        </div>
        <div class="mb-4">
            <label for="course_of_study" class="block text-sm font-medium text-gray-700">Course of Study</label>
            <input type="text" name="course_of_study" id="course_of_study" class="mt-1 block w-full p-2 border rounded-md" required>
        </div>
        <div class="mb-4">
            <label for="level" class="block text-sm font-medium text-gray-700">Level</label>
            <select name="level" id="level" class="mt-1 block w-full p-2 border rounded-md" required>
                <option value="100">100 Level</option>
                <option value="200">200 Level</option>
                <option value="300">300 Level</option>
                <option value="400">400 Level</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="session" class="block text-sm font-medium text-gray-700">Session</label>
            <input type="text" name="session" id="session" class="mt-1 block w-full p-2 border rounded-md" value="2025/2026" required>
        </div>
        <div class="mb-4">
            <label for="semester" class="block text-sm font-medium text-gray-700">Semester</label>
            <select name="semester" id="semester" class="mt-1 block w-full p-2 border rounded-md" required>
                <option value="1">First Semester</option>
                <option value="2">Second Semester</option>
            </select>
        </div>
        <button type="submit" class="w-full bg-<?= esc($school['primary_color']) ?> text-white p-2 rounded-md hover:bg-<?= esc($school['secondary_color']) ?>">Register</button>
    </form>
</div>
<?= $this->endSection() ?>