<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="space-y-6">

    <!-- Breadcrumbs -->
    <nav class="flex text-sm text-gray-600">
        <a href="/admin/academic/faculties" class="hover:text-primary">Faculties</a>
        <?php if (isset($faculty)): ?>
            <span class="mx-2">/</span>
            <a href="/admin/academic/departments/<?= $faculty['id'] ?>" class="hover:text-primary"><?= esc($faculty['name']) ?></a>
        <?php endif; ?>
        <?php if (isset($department)): ?>
            <span class="mx-2">/</span>
            <span class="text-primary"><?= esc($department['name']) ?></span>
        <?php endif; ?>
    </nav>

    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                <?= $page === 'faculties' ? 'Faculties' : ($page === 'departments' ? 'Departments' : 'Courses') ?>
            </h1>
            <p class="text-sm text-gray-600 mt-1">
                <? var_dump($page)?>
                <?= $page === 'faculties' ? 'Manage faculties in your institution' : 
                    ($page === 'departments' ? "Departments under <strong>" . esc($faculty['name']) . "</strong>" : 
                    "Courses in <strong>" . esc($department['name']) . "</strong>") ?>
            </p>
        </div>
        <button onclick="openModal('createModal')" 
                class="px-5 py-2.5 bg-primary text-white rounded-lg hover:bg-primary/90 transition flex items-center text-sm font-medium">
            <i class="fas fa-plus mr-2"></i> 
            <?= $page === 'faculties' ? 'Add Faculty' : ($page === 'departments' ? 'Add Department' : 'Add Course') ?>
        </button>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Code</th>
                        <?php if ($page !== 'courses'): ?>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Count</th>
                        <?php else: ?>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Level</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Units</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Session</th>
                        <?php endif; ?>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php 
                    $items = $page === 'faculties' ? $faculties : ($page === 'departments' ? $departments : $courses);
                    if (empty($items)): ?>
                        <tr><td colspan="5" class="text-center py-12 text-gray-500">No records found.</td></tr>
                    <?php else: foreach ($items as $item): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">
                            <?php if ($page === 'faculties'): ?>
                                <a href="/admin/academic/departments/<?= $item['id'] ?>" class="hover:text-primary">
                                    <?= esc($item['name']) ?>
                                </a>
                            <?php elseif ($page === 'departments'): ?>
                                <a href="/admin/academic/courses/<?= $item['id'] ?>" class="hover:text-primary">
                                    <?= esc($item['name']) ?>
                                </a>
                            <?php else: ?>
                                <?= esc($item['title']) ?>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500"><?= esc($item['code'] ?? '—') ?></td>
                        <?php if ($page !== 'courses'): ?>
                            <td class="px-6 py-4 text-sm">
                                <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                    <?= $page === 'faculties' ? ($item['dept_count'] ?? 0) . ' depts' : ($item['course_count'] ?? 0) . ' courses' ?>
                                </span>
                            </td>
                        <?php else: ?>
                            <td class="px-6 py-4 text-sm"><?= $item['level'] ?> Level</td>
                            <td class="px-6 py-4 text-sm"><?= $item['units'] ?></td>
                            <td class="px-6 py-4 text-sm"><?= $item['session'] ?> / Sem <?= $item['semester'] ?></td>
                        <?php endif; ?>
                        <td class="px-6 py-4 text-sm space-x-2">
                            <button onclick="editItem(<?= json_encode($item) ?>)" class="text-blue-600 hover:text-blue-900">
                                <i class="fas fa-edit"></i>
                            </button>
                            <a href="/admin/academic/<?= $page ?>/delete/<?= $item['id'] ?>" 
                               onclick="return confirm('Delete this <?= $page === 'courses' ? 'course' : $page ?>?')" 
                               class="text-red-600 hover:text-red-900">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create Modal -->
<dialog id="createModal" class="p-6 bg-white rounded-xl shadow-xl max-w-md w-full">
    <form action="/admin/academic/<?= $page ?>/create" method="post">
        <?= csrf_field() ?>
        <?php if ($page !== 'faculties'): ?>
            <input type="hidden" name="<?= $page === 'departments' ? 'faculty_id' : 'department_id' ?>" 
                   value="<?= $page === 'departments' ? $faculty['id'] : $department['id'] ?>">
        <?php endif; ?>
        <!-- Reusable fields -->
        <?= $this->include('admin/academic/_form') ?>
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
function openModal(id) { document.getElementById(id).showModal(); }
function editItem(item) {
    alert('aa');
    const form = document.getElementById('editForm');
    form.innerHTML = '<?= csrf_field() ?>' + 
        `<input type="hidden" name="id" value="${item.id}">` +
        `<?= $this->include('admin/academic/_form') ?>`.replace(/{{(.*?)}}/g, (m, key) => item[key] || '');
    form.action = `/admin/academic/<?= $page ?>/update/${item.id}`;
    document.getElementById('editModal').showModal();
}
</script>

<?= $this->endSection() ?>