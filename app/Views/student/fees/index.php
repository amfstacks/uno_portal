<?= $this->extend('layouts/student') ?>
<?= $this->section('content') ?>

<div class="space-y-8">

    <!-- === TOP SUMMARY CARDS === -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="p-6 bg-white rounded-xl border shadow-sm">
            <p class="text-sm text-gray-600">Session</p>
            <p class="text-2xl font-bold primary-text"><?= esc($student['session']) ?></p>
        </div>

        <div class="p-6 bg-white rounded-xl border shadow-sm">
            <p class="text-sm text-gray-600">Level</p>
            <p class="text-2xl font-bold primary-text"><?= esc($student['level']) ?></p>
        </div>

        <div class="p-6 bg-white rounded-xl border shadow-sm">
            <p class="text-sm text-gray-600">Semester</p>
            <p class="text-2xl font-bold primary-text"><?= esc($student['semester']) ?></p>
        </div>
    </div>

    <!-- === FEES CARD === -->
    <div class="bg-white p-6 rounded-xl border shadow-sm">

        <h2 class="text-xl font-semibold mb-6">
            School Fees Breakdown
        </h2>

        <?php if (empty($fees)): ?>

            <div class="p-4 bg-yellow-100 text-yellow-800 border-l-4 border-yellow-400 rounded">
                No fee structure has been configured for your session, level, and semester.
            </div>

        <?php else: ?>

            <!-- FEES TABLE -->
            <div class="overflow-auto rounded-lg border">
                <table class="min-w-full">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">#</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Fee Type</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Category</th>
                            <th class="px-4 py-3 text-right text-sm font-semibold text-gray-600">Amount (₦)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        <?php $i = 1; ?>
                        <?php foreach ($fees as $f): ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3"><?= $i++ ?></td>
                                <td class="px-4 py-3 font-medium"><?= esc($f['fee_type']) ?></td>
                                <td class="px-4 py-3 text-gray-600"><?= esc($f['fee_category']) ?></td>
                                <td class="px-4 py-3 text-right font-semibold">
                                    ₦<?= number_format($f['amount']) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- TOTAL FEES -->
            <div class="mt-6 flex justify-end">
                <div class="text-lg font-bold bg-gray-100 px-6 py-3 rounded-xl text-gray-700">
                    Total Fees: <span class="primary-text">₦<?= number_format($total_fees) ?></span>
                </div>
            </div>

        <?php endif; ?>

    </div>

</div>

<?= $this->endSection() ?>
