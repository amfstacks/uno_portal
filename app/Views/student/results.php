<?= $this->extend('layouts/student') ?>
<?= $this->section('content') ?>
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">My Results</h1>
    <table class="min-w-full bg-white shadow rounded-lg">
        <thead>
            <tr>
                <th class="p-2">Course Code</th>
                <th class="p-2">Session</th>
                <th class="p-2">Semester</th>
                <th class="p-2">Score</th>
                <th class="p-2">Grade</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $result): ?>
                <tr>
                    <td class="p-2"><?= esc($result['course_code']) ?></td>
                    <td class="p-2"><?= esc($result['session']) ?></td>
                    <td class="p-2"><?= esc($result['semester']) ?></td>
                    <td class="p-2"><?= esc($result['score']) ?></td>
                    <td class="p-2"><?= esc($result['grade']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>