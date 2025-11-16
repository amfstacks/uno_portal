<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">
            <?= $page === 'courses' ? 'Course Title' : ucfirst($page === 'faculties' ? 'Faculty' : 'Department') . ' Name' ?>
        </label>
        <input type="text" 
               name="<?= $page === 'courses' ? 'title' : 'name' ?>" 
               value="" 
               required 
               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Code</label>
        <input type="text" name="code" value="" 
               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary">
    </div>

    <?php if ($page === 'courses'): ?>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Level</label>
            <select name="level" class="w-full px-4 py-2 border rounded-lg">
                <?php foreach (['100','200','300','400'] as $lvl): ?>
                    <option value="<?= $lvl ?>"><?= $lvl ?> Level</option>
                <?php endforeach; ?>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Units</label>
            <input type="number" name="units" value="" min="1" max="6" 
                   class="w-full px-4 py-2 border rounded-lg">
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Session</label>
            <input type="text" name="session" value="" placeholder="2025/2026" 
                   class="w-full px-4 py-2 border rounded-lg">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Semester</label>
            <select name="semester" class="w-full px-4 py-2 border rounded-lg">
                <option value="1">First</option>
                <option value="2">Second</option>
            </select>
        </div>
    </div>
    <?php endif; ?>

    <div class="flex justify-end space-x-3 mt-6">
        <button type="button" onclick="this.closest('dialog').close()" 
                class="px-4 py-2 border rounded-lg hover:bg-gray-50">Cancel</button>
        <button type="submit" 
                class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90">
            <?= isset($item) ? 'Update' : 'Create' ?>
        </button>
    </div>
</div>
