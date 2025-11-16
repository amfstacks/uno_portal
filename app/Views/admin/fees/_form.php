<?php 
// Only pass variables if they exist
$program = $program ?? '';
$department_id = $department_id ?? '';
$session = $session ?? '';
$level = $level ?? '';
$semester = $semester ?? '';
$fee_type = $fee_type ?? '';
$amount = $amount ?? '';
$is_mandatory = $is_mandatory ?? 1;
$fee_category = $fee_category ?? 'registration';
$id = $id ?? null;
?>

<div class="space-y-5">

    <!-- Fee Category -->
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Fee Category</label>
        <div class="flex gap-6">
            <label class="flex items-center">
                <input type="radio" name="fee_category" value="application" 
                       <?= $fee_category === 'application' ? 'checked' : '' ?> 
                       class="mr-2" onchange="toggleLevelField()">
                <span>Application Fee</span>
            </label>
            <label class="flex items-center">
                <input type="radio" name="fee_category" value="registration" 
                       <?= $fee_category === 'registration' ? 'checked' : '' ?> 
                       class="mr-2" onchange="toggleLevelField()">
                <span>Registration Fee</span>
            </label>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Program</label>
            <input type="text" name="program" value="<?= esc($program) ?>" required 
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Department</label>
            <select name="department_id" class="w-full px-4 py-2 border rounded-lg">
                <option value="">None (School-wide)</option>
                <?php foreach ($departments as $dept): ?>
                    <option value="<?= $dept['id'] ?>" <?= $department_id == $dept['id'] ? 'selected' : '' ?>>
                        <?= esc($dept['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Department</label>
            <select name="department_id" class="w-full px-4 py-2 border rounded-lg">
                <option value="">Select</option>
                <?php foreach ($programs as $pro): ?>
                    <option value="<?= $pro['id'] ?>" <?= $department_id == $pro['id'] ? 'selected' : '' ?>>
                        <?= esc($pro['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Session</label>
            <input type="text" name="session" value="<?= esc($session) ?>" placeholder="2025/2026" required 
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary">
        </div>

        <!-- Level – hidden for application fees -->
        <div id="levelField" style="<?= $fee_category === 'application' ? 'display:none' : '' ?>">
            <label class="block text-sm font-medium text-gray-700 mb-1">Level</label>
            <select name="level" class="w-full px-4 py-2 border rounded-lg">
                <option value="">Select Level</option>
                <?php foreach (['100','200','300','400'] as $l): ?>
                    <option value="<?= $l ?>" <?= $level == $l ? 'selected' : '' ?>><?= $l ?> Level</option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Semester</label>
            <select name="semester" required class="w-full px-4 py-2 border rounded-lg">
                <option value="1" <?= $semester == '1' ? 'selected' : '' ?>>First</option>
                <option value="2" <?= $semester == '2' ? 'selected' : '' ?>>Second</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Fee Type</label>
            <select name="fee_type" required class="w-full px-4 py-2 border rounded-lg">
                <?php foreach ($feeTypes as $t): ?>
    <option value="<?= $t['name'] ?>"><?= ucfirst($t['name']) ?></option>
<?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Amount (₦)</label>
            <input type="number" step="0.01" name="amount" value="<?= esc($amount) ?>" required 
                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary">
        </div>
        <div class="flex items-end">
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="is_mandatory" value="1" 
                       <?= $is_mandatory ? 'checked' : '' ?> class="rounded">
                <span class="text-sm">Mandatory</span>
            </label>
        </div>
    </div>

    <div class="flex justify-end space-x-3 pt-4 border-t">
        <button type="button" onclick="this.closest('dialog').close()" 
                class="px-4 py-2 border rounded-lg hover:bg-gray-50">Cancel</button>
        <button type="submit" 
                class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90">
            <?= $id ? 'Update' : 'Create' ?> Fee
        </button>
    </div>
</div>

<script>
function toggleLevelField() {
    const isApp = document.querySelector('input[name="fee_category"]:checked').value === 'application';
    document.getElementById('levelField').style.display = isApp ? 'none' : 'block';
    if (isApp) {
        document.querySelector('select[name="level"]').removeAttribute('required');
    } else {
        document.querySelector('select[name="level"]').setAttribute('required', 'required');
    }
}
</script>