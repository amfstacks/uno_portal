<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<h1 class="text-2xl font-bold mb-4">All Departments</h1>

<div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left text-sm font-medium">Department</th>
                <th class="px-4 py-2 text-left text-sm font-medium">Code</th>
                <th class="px-4 py-2 text-left text-sm font-medium">Faculty</th>
                <th class="px-4 py-2 text-sm">Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($departments as $d): ?>
            <tr class="border-b">
                <td class="px-4 py-2"><?= esc($d['name']) ?></td>
                <td class="px-4 py-2"><?= esc($d['code']) ?></td>
                <td class="px-4 py-2"><?= esc($d['faculty_name']) ?></td>
                <td class="px-4 py-2 space-x-2">
                    <a href="/admin/academic/courses/<?= $d['id'] ?>" class="text-blue-600">View Courses</a>
                    <a href="/admin/academic/departments/delete/<?= $d['id'] ?>" class="text-red-600">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
