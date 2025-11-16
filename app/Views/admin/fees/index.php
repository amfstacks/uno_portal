<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="space-y-6">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Fee Structure</h1>
            <p class="text-sm text-gray-600 mt-1">Manage school fees per program, level, session</p>
        </div>
        <div class="flex gap-2">
            <button onclick="openModal('createModal')" 
                    class="px-5 py-2.5 bg-primary text-white rounded-lg hover:bg-primary/90 transition flex items-center text-sm font-medium">
                <i class="fas fa-plus mr-2"></i> Add Fee
            </button>
            <a href="/admin/fees/export" class="px-5 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition flex items-center text-sm font-medium">
                <i class="fas fa-download mr-2"></i> Export CSV
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200">
        <form method="get" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Department</label>
                <select name="department" class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-primary">
                    <option value="">All Departments</option>
                    <?php foreach ($departments as $dept): ?>
                        <option value="<?= $dept['id'] ?>" <?= ($filters['department_id'] ?? '') == $dept['id'] ? 'selected' : '' ?>>
                            <?= esc($dept['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Session</label>
                <select name="session" class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-primary">
                    <option value="">All Sessions</option>
                    <?php foreach ($sessions as $s): ?>
                        <option value="<?= $s ?>" <?= ($filters['session'] ?? '') == $s ? 'selected' : '' ?>><?= $s ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Level</label>
                <select name="level" class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-primary">
                    <option value="">All Levels</option>
                    <?php foreach ($levels as $l): ?>
                        <option value="<?= $l ?>" <?= ($filters['level'] ?? '') == $l ? 'selected' : '' ?>><?= $l ?> Level</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Semester</label>
                <select name="semester" class="w-full px-3 py-2 text-sm border rounded-lg focus:ring-2 focus:ring-primary">
                    <option value="">Both</option>
                    <option value="1" <?= ($filters['semester'] ?? '') == '1' ? 'selected' : '' ?>>First</option>
                    <option value="2" <?= ($filters['semester'] ?? '') == '2' ? 'selected' : '' ?>>Second</option>
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full px-4 py-2 bg-secondary text-white rounded-lg hover:bg-secondary/90 text-sm">
                    <i class="fas fa-filter mr-1"></i> Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Fee Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Program</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Session</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Level</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sem</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fee Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mand.</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php 
                    $current = '';
                    foreach ($fees as $i => $fee):
                        $key = $fee['program'] . $fee['session'] . $fee['level'] . $fee['semester'];
                        $isNewGroup = $key !== $current;
                        if ($isNewGroup) $current = $key;
                    ?>
                    <tr class="<?= $isNewGroup && $i > 0 ? 'border-t-2 border-gray-300' : '' ?>">
                        <td class="px-6 py-3 text-sm <?= $isNewGroup ? 'font-medium' : '' ?>">
                            <?= $isNewGroup ? esc($fee['program']) : '' ?>
                        </td>
                        <td class="px-6 py-3 text-sm"><?= $isNewGroup ? $fee['session'] : '' ?></td>
                        <td class="px-6 py-3 text-sm"><?= $isNewGroup ? $fee['level'] : '' ?></td>
                        <td class="px-6 py-3 text-sm"><?= $fee['semester'] ?></td>
                        <td class="px-6 py-3 text-sm">
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                <?= ucfirst($fee['fee_type']) ?>
                            </span>
                            <span class="text-xs text-gray-500 mt-1">
            <?= $fee['fee_category'] === 'application' ? 'Application' : 'Registration' ?>
        </span>
                        </td>
                        <td class="px-6 py-3 text-sm font-medium">
                            ₦<?= number_format($fee['amount'], 2) ?>
                        </td>
                        <td class="px-6 py-3 text-sm">
                            <input type="checkbox" <?= $fee['is_mandatory'] ? 'checked' : '' ?> disabled class="rounded">
                        </td>
                        <td class="px-6 py-3 text-sm space-x-2">
                            <button onclick="editFee(<?= json_encode($fee) ?>)" class="text-blue-600 hover:text-blue-900">
                                <i class="fas fa-edit"></i>
                            </button>
                            <a href="/admin/fees/delete/<?= $fee['id'] ?>" 
                               onclick="return confirm('Delete this fee?')" 
                               class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php 
                    if ($isNewGroup && $i < count($fees) - 1):
                        $total = $this->feeModel->getTotalByProgram($fee['program'], $fee['session'], $fee['level'], $fee['semester']);
                    ?>
                    <tr class="bg-gray-50 font-semibold">
                        <td colspan="5" class="px-6 py-2 text-right">Total:</td>
                        <td class="px-6 py-2">₦<?= number_format($total, 2) ?></td>
                        <td colspan="2"></td>
                    </tr>
                    <?php endif; endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create Modal -->
<dialog id="createModal" class="p-6 bg-white rounded-xl shadow-xl max-w-2xl w-full">
    <form action="/admin/fees/create" method="post">
        <?= csrf_field() ?>
        <?= $this->include('admin/fees/_form') ?>
    </form>
</dialog>

<!-- Edit Modal -->
<dialog id="editModal" class="p-6 bg-white rounded-xl shadow-xl max-w-md w-full">
    <form id="editForm" method="post">
        <?= csrf_field() ?>
        <!-- Filled by JS -->
    </form>
</dialog>

<script>
function openModal(id) { 
    document.getElementById(id).showModal(); 
}

function editFee(fee) {
    const modal = document.getElementById('editModal');
    const form = document.getElementById('editForm');

    // Clone real PHP-rendered form
    const template = document.getElementById('editTemplate').innerHTML;

    form.innerHTML = template;
    form.action = `/admin/fees/update/${fee.id}`;

    // Fill inputs
    form.querySelector('[name="program"]').value = fee.program;
    form.querySelector('[name="department_id"]').value = fee.department_id;
    form.querySelector('[name="session"]').value = fee.session;
    form.querySelector('[name="level"]').value = fee.level;
    form.querySelector('[name="semester"]').value = fee.semester;
    form.querySelector('[name="fee_type"]').value = fee.fee_type;
    form.querySelector('[name="amount"]').value = fee.amount;
    form.querySelector('[name="fee_category"]').value = fee.fee_category;
    form.querySelector('[name="is_mandatory"]').checked = fee.is_mandatory == 1;

    modal.showModal();
}

</script>

<?= $this->endSection() ?>