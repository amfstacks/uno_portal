<?= $this->extend('layouts/student') ?>
<?= $this->section('content') ?>

<div class="max-w-5xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border p-6">
        <h2 class="text-2xl font-bold mb-2">Course Registration</h2>
        <p class="text-gray-600 mb-6">Session: <strong><?= esc($session) ?></strong> | Level: <strong><?= session()->get('student')['level'] ?></strong></p>

        <form action="/student/courses/register/save" method="post">
            <?= csrf_field() ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <?php foreach ($courses as $course): ?>
                <label class="flex items-center p-4 border rounded-lg hover:bg-gray-50 cursor-pointer transition">
                    <input type="checkbox" name="courses[]" value="<?= $course['id'] ?>"
                           <?= in_array($course['id'], $registered) ? 'checked' : '' ?>
                           class="mr-3 h-5 w-5 text-primary rounded">
                    <div>
                        <div class="font-medium"><?= esc($course['code']) ?> - <?= esc($course['title']) ?></div>
                        <div class="text-sm text-gray-500"><?= $course['units'] ?> Units | <?= $course['level'] ?> Level</div>
                    </div>
                </label>
                <?php endforeach; ?>
            </div>

            <div class="mt-8 flex justify-end">
                <button type="submit" class="px-8 py-3 bg-primary text-white rounded-lg hover:shadow-lg transition">
                    Save Registration
                </button>
            </div>
        </ity>
    </div>
</div>
<?= $this->endSection() ?>