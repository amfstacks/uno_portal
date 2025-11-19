<?= $this->extend('layouts/student') ?>
<?= $this->section('content') ?>

<div class="space-y-8">
    <div class="bg-gradient-to-r from-blue-600 to-primary text-white p-8 rounded-xl text-center">
        <h2 class="text-4xl font-bold">Your CGPA</h2>
        <p class="text-6xl font-bold mt-4"><?= $cgpa ?></p>
    </div>

    <?php foreach ($grouped as $session => $semesters): ?>
    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
        <div class="bg-gray-50 px-6 py-4 font-semibold text-lg">Session: <?= esc($session) ?></div>
        <?php foreach ($semesters as $sem => $courses): ?>
        <div class="p-6 border-t">
            <h3 class="font-medium text-lg mb-4">Semester <?= $sem ?></h3>
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left">Code</th>
                        <th class="px-4 py-2 text-left">Title</th>
                        <th class="px-4 py-2 text-center">Units</th>
                        <th class="px-4 py-2 text-center">Grade</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($courses as $c): ?>
                    <tr>
                        <td class="px-4 py-2"><?= esc($c['code']) ?></td>
                        <td class="px-4 py-2"><?= esc($c['title']) ?></td>
                        <td class="px-4 py-2 text-center"><?= $c['units'] ?></td>
                        <td class="px-4 py-2 text-center font-bold text-green-600"><?= $c['grade'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endforeach; ?>
</div>
<?= $this->endSection() ?>