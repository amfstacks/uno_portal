<?= $this->extend('layouts/student') ?>
<?= $this->section('content') ?>

<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-sm border" data-aos="fade-up">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Current Level</p>
                    <p class="text-3xl font-bold primary-text"><?= $student['level'] ?></p>
                </div>
                <i class="fas fa-graduation-cap text-4xl opacity-20 primary-text"></i>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border" data-aos="fade-up" data-aos-delay="100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">CGPA</p>
                    <p class="text-3xl font-bold text-green-600"><?= number_format($cgpa, 2) ?></p>
                </div>
                <i class="fas fa-trophy text-4xl opacity-20 text-green-600"></i>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border" data-aos="fade-up" data-aos-delay="200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Fees</p>
                    <p class="text-3xl font-bold">₦<?= number_format($total_fees) ?></p>
                </div>
                <i class="fas fa-money-bill-wave text-4xl opacity-20 text-orange-600"></i>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border" data-aos="fade-up" data-aos-delay="300">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Paid</p>
                    <p class="text-3xl font-bold text-green-600">₦<?= number_format($paid_fees) ?></p>
                </div>
                <i class="fas fa-check-circle text-4xl opacity-20 text-green-600"></i>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-sm border" data-aos="fade-up">
            <h3 class="text-xl font-semibold mb-4">Quick Actions</h3>
            <div class="grid grid-cols-2 gap-4">
                <a href="/student/courses/register" class="bg-blue-50 hover:bg-blue-100 p-6 rounded-lg text-center transition">
                    <i class="fas fa-book text-3xl text-blue-600 mb-2"></i>
                    <p class="font-medium">Register Courses</p>
                </a>
                <a href="/student/fees" class="bg-green-50 hover:bg-green-100 p-6 rounded-lg text-center transition">
                    <i class="fas fa-credit-card text-3xl text-green-600 mb-2"></i>
                    <p class="font-medium">Pay Fees</p>
                </a>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border" data-aos="fade-up">
            <h3 class="text-xl font-semibold mb-4">Recent Results</h3>
            <?php if ($recent_results): ?>
                <ul class="space-y-3">
                    <?php foreach ($recent_results as $r): ?>
                    <li class="flex justify-between">
                        <span><?= esc($r['course_code']) ?> - <?= esc($r['title']) ?></span>
                        <span class="font-bold text-green-600"><?= $r['grade'] ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-gray-500">No results yet.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>