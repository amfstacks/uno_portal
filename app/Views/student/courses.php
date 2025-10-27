<?= $this->extend('layouts/student') ?>
<?= $this->section('content') ?>
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">My Courses</h1>
    <table class="min-w-full bg-white shadow rounded-lg">
        <thead>
            <tr>
                <th class="p-2">Course Code</th>
                <th class="p-2">Session</th>
                <th class="p-2">Semester</th>
                <th class="p-2">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($courses as $course): ?>
                <tr>
                    <td class="p-2"><?= esc($course['course_code']) ?></td>
                    <td class="p-2"><?= esc($course['session']) ?></td>
                    <td class="p-2"><?= esc($course['semester']) ?></td>
                    <td class="p-2"><?= esc($course['status']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>