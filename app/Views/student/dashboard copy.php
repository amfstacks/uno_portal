<?= $this->extend('layouts/student') ?>
<?= $this->section('content') ?>
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Welcome, <?= esc($student['full_name']) ?></h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="/student/courses" class="bg-white p-4 rounded-lg shadow hover:bg-gray-100">
            <h3 class="text-lg font-semibold">My Courses</h3>
            <p>View and manage your registered courses</p>
        </a>
        <a href="/student/results" class="bg-white p-4 rounded-lg shadow hover:bg-gray-100">
            <h3 class="text-lg font-semibold">Check Results</h3>
            <p>View your academic results and GPA</p>
        </a>
        <a href="/student/transcript" class="bg-white p-4 rounded-lg shadow hover:bg-gray-100">
            <h3 class="text-lg font-semibold">Transcript</h3>
            <p>Download your academic transcript</p>
        </a>
    </div>
</div>
<?= $this->endSection() ?>