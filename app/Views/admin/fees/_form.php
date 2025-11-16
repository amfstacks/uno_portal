<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Program</label>
        <input type="text" name="program" value="{{program}}" required 
               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Department</label>
        <select name="department_id" class="w-full px-4 py-2 border rounded-lg">
            <option value="">None (School-wide)</option>
            <?php foreach ($departments as $dept): ?>
                <option value="<?= $dept['id'] ?>" {{department_id == '<?= $dept['id'] ?>' ? 'selected' : ''}}>
                    <?= esc($dept['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Session</label>
        <input type="text" name="session" value="{{session}}" placeholder="2025/2026" required 
               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary">
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Level</label>
        <select name="level" required class="w-full px-4 py-2 border rounded-lg">
            <?php foreach (['100','200','300','400'] as $l): ?>
                <option value="<?= $l ?>" {{level == '<?= $l ?>' ? 'selected' : ''}}><?= $l ?> Level</option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Semester</label>
        <select name="semester" required class="w-full px-4 py-2 border rounded-lg">
            <option value="1" {{semester == '1' ? 'selected' : ''}}>First</option>
            <option value="2" {{semester == '2' ? 'selected' : ''}}>Second</option>
        </select>
    </div>
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Fee Type</label>
        <select name="fee_type" required class="w-full px-4 py-2 border rounded-lg">
            <?php foreach ($feeTypes as $type): ?>
                <option value="<?= $type ?>" {{fee_type == '<?= $type ?>' ? 'selected' : ''}}>
                    <?= ucfirst($type) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Amount (₦)</label>
        <input type="number" step="0.01" name="amount" value="{{amount}}" required 
               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary">
    </div>
    <div class="flex items-end">
        <label class="flex items-center space-x-2">
            <input type="checkbox" name="is_mandatory" value="1" {{is_mandatory ? 'checked' : ''}} class="rounded">
            <span class="text-sm">Mandatory Fee</span>
        </label>
    </div>
</div>

<div class="flex justify-end space-x-3">
    <button type="button" onclick="this.closest('dialog').close()" 
            class="px-4 py-2 border rounded-lg hover:bg-gray-50">Cancel</button>
    <button type="submit" 
            class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90">
        {{id ? 'Update' : 'Create'}} Fee
    </button>
</div>