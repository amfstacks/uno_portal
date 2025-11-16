<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="space-y-6">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">User Management</h1>
            <p class="text-sm text-gray-600 mt-1">Manage all portal users across roles and schools</p>
        </div>
        <button onclick="document.getElementById('createUserModal').showModal()"
                class="px-5 py-2.5 bg-primary text-white rounded-lg hover:bg-primary/90 transition flex items-center text-sm font-medium">
            <i class="fas fa-user-plus mr-2"></i> Create User
        </button>
    </div>

    <!-- Filters -->
    <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-200">
        <form method="get" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                <input type="text" name="search" value="<?= esc($search ?? '') ?>" 
                       placeholder="Email, Matric No, Name..." 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                <select name="role" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary">
                    <option value="all">All Roles</option>
                    <?php foreach ($roles as $r): ?>
                        <option value="<?= $r ?>" <?= ($selected_role ?? '') === $r ? 'selected' : '' ?>>
                            <?= ucfirst(str_replace('_', ' ', $r)) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full px-4 py-2 bg-secondary text-white rounded-lg hover:bg-secondary/90 transition">
                    <i class="fas fa-search mr-1"></i> Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">School</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                            <i class="fas fa-users-slash text-3xl mb-2 block"></i>
                            No users found.
                        </td>
                    </tr>
                    <?php else: ?>
                    <?php foreach ($users as $user): ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="bg-gray-200 border-2 border-dashed rounded-full w-10 h-10 mr-3"></div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900"><?= esc($user['email']) ?></div>
                                    <div class="text-xs text-gray-500"><?= esc($user['matric_no'] ?? '—') ?></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                <?= $user['role'] === 'admin' ? 'bg-purple-100 text-purple-800' : 
                                    ($user['role'] === 'exam_officer' ? 'bg-blue-100 text-blue-800' : 
                                    ($user['role'] === 'bursary' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800')) ?>">
                                <?= ucfirst(str_replace('_', ' ', $user['role'])) ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <?= esc($user['school_name']) ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                <?= $user['is_active'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                <?= $user['is_active'] ? 'Active' : 'Inactive' ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-3">
                            <?php if ($user['is_active']): ?>
                                <a href="/admin/users/toggle/<?= $user['id'] ?>" 
                                   class="text-red-600 hover:text-red-900" title="Deactivate">
                                    <i class="fas fa-ban"></i>
                                </a>
                            <?php else: ?>
                                <a href="/admin/users/toggle/<?= $user['id'] ?>" 
                                   class="text-green-600 hover:text-green-900" title="Activate">
                                    <i class="fas fa-check"></i>
                                </a>
                            <?php endif; ?>
                            <a href="/admin/users/reset-password/<?= $user['id'] ?>" 
                               class="text-blue-600 hover:text-blue-900" title="Reset Password">
                                <i class="fas fa-key"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create User Modal -->
<dialog id="createUserModal" class="p-6 bg-white rounded-xl shadow-xl max-w-md w-full">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold">Create New User</h3>
        <button type="button" onclick="this.closest('dialog').close()" class="text-gray-400 hover:text-gray-600">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <form action="/admin/users/create" method="post">
        <?= csrf_field() ?>
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" required 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Matric / Staff ID</label>
                <input type="text" name="matric_no" required 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                <select name="role" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary">
                    <option value="">Select Role</option>
                    <?php foreach ($roles as $r): ?>
                        <option value="<?= $r ?>"><?= ucfirst(str_replace('_', ' ', $r)) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="mt-6 flex justify-end space-x-3">
            <button type="button" onclick="this.closest('dialog').close()" 
                    class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                Cancel
            </button>
            <button type="submit" 
                    class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition">
                Create User
            </button>
        </div>
    </form>
</dialog>

<?= $this->endSection() ?>