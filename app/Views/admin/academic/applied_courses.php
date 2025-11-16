<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<h1 class="text-2xl font-bold mb-4">
    Courses for <?= esc($department['name']) ?>
</h1>

<div class="mb-4">
    <button onclick="openAddModal()" 
        class="bg-blue-600 text-white px-4 py-2 rounded">
        + Add New Course
    </button>
</div>

<!-- COURSES TABLE -->
<div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="min-w-full">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left text-sm font-medium">Course</th>
                <th class="px-4 py-2 text-left text-sm font-medium">Code</th>
                <th class="px-4 py-2 text-left text-sm font-medium">Duration</th>
                <th class="px-4 py-2 text-sm">Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($courses as $c): ?>
            <tr class="border-b">
                <td class="px-4 py-2"><?= esc($c['name']) ?></td>
                <td class="px-4 py-2"><?= esc($c['code']) ?></td>
                <td class="px-4 py-2"><?= esc($c['duration']) ?> years</td>

                <td class="px-4 py-2 space-x-2">

                    <button onclick="openEditModal(<?= $c['id'] ?>,'<?= esc($c['name']) ?>','<?= esc($c['code']) ?>','<?= esc($c['duration']) ?>')"
                        class="text-blue-600">
                        Edit
                    </button>

                    <a href="/admin/academic/applied_courses/delete/<?= $c['id'] ?>"
                        class="text-red-600"
                        onclick="return confirm('Delete this course?')">
                        Delete
                    </a>

                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>



<!-- ADD COURSE MODAL -->
<div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white w-96 p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-3">Add New Course</h2>

        <form action="create" method="POST">

            <input type="hidden" name="department_id" value="<?= $department['id'] ?>">

            <label class="block mb-1">Course Name</label>
            <input name="name" required class="border w-full px-3 py-2 rounded mb-3">

            <label class="block mb-1">Course Code</label>
            <input name="code" required class="border w-full px-3 py-2 rounded mb-3">

            <label class="block mb-1">Duration (years)</label>
            <input name="duration" type="number" min="1" required class="border w-full px-3 py-2 rounded mb-3">

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeAddModal()" 
                    class="px-4 py-2 rounded border">Cancel</button>
                <button class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
            </div>
        </form>
    </div>
</div>



<!-- EDIT MODAL -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white w-96 p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-3">Edit Course</h2>

        <form id="editForm" action="" method="POST">

            <label class="block mb-1">Course Name</label>
            <input id="editName" name="name" required class="border w-full px-3 py-2 rounded mb-3">

            <label class="block mb-1">Course Code</label>
            <input id="editCode" name="code" required class="border w-full px-3 py-2 rounded mb-3">

            <label class="block mb-1">Duration (years)</label>
            <input id="editDuration" name="duration" type="number" min="1" required class="border w-full px-3 py-2 rounded mb-3">

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeEditModal()" 
                    class="px-4 py-2 rounded border">Cancel</button>
                <button class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
            </div>

        </form>
    </div>
</div>



<script>
function openAddModal() {
    document.getElementById('addModal').classList.remove('hidden');
}
function closeAddModal() {
    document.getElementById('addModal').classList.add('hidden');
}

function openEditModal(id, name, code, duration) {
    document.getElementById('editName').value = name;
    document.getElementById('editCode').value = code;
    document.getElementById('editDuration').value = duration;

    document.getElementById('editForm').action = "/admin/academic/applied_courses/update/" + id;

    document.getElementById('editModal').classList.remove('hidden');
}
function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}
</script>

<?= $this->endSection() ?>
