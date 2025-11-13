<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="space-y-6">

    <!-- Page Title -->
    <div class="flex items-center justify-between">
        <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
        <div class="text-sm text-gray-500">
            <i class="fas fa-calendar-alt mr-1"></i> <?= date('D, d M Y') ?>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 fade-in">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Total Students</p>
                    <p class="text-2xl font-bold text-primary"><?= number_format($total_students ?? 0) ?></p>
                </div>
                <i class="fas fa-users text-3xl text-primary/30"></i>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 fade-in">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Pending Payments</p>
                    <p class="text-2xl font-bold text-orange-600"><?= $pending_payments ?? 0 ?></p>
                </div>
                <i class="fas fa-money-bill-wave text-3xl text-orange-600/30"></i>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 fade-in">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Active Session</p>
                    <p class="text-lg font-semibold">
                        <?= $active_session ? $active_session['session_name'] . ' | Sem ' . $active_session['semester'] : '<span class="text-red-500">None</span>' ?>
                    </p>
                </div>
                <i class="fas fa-calendar-check text-3xl text-green-600/30"></i>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 fade-in">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600">Exam Officers</p>
                    <p class="text-2xl font-bold text-secondary"><?= count($exam_officers ?? []) ?></p>
                </div>
                <i class="fas fa-user-shield text-3xl text-secondary/30"></i>
            </div>
        </div>
    </div>

    <!-- Session Control -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
        <h2 class="text-xl font-semibold mb-4 flex items-center">
            <i class="fas fa-cogs mr-2 text-primary"></i> Session & Window Controls
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Set Session -->
            <div>
                <h3 class="font-medium mb-3">Set Academic Session</h3>
                <form action="setSession" method="post" class="flex flex-col sm:flex-row gap-2">
                    <?= csrf_field() ?>
                    <input type="text" name="session" placeholder="2025/2026" required
                           class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    <select name="semester" required class="px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="1">First Semester</option>
                        <option value="2">Second Semester</option>
                    </select>
                    <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition">
                        Set
                    </button>
                </form>
            </div>

            <!-- Window Toggles -->
            <div>
                <h3 class="font-medium mb-3">Portal Windows</h3>
                <div class="grid grid-cols-3 gap-2 text-center">
                    <div>
                        <p class="text-xs text-gray-600">Application</p>
                        <div class="flex justify-center space-x-1 mt-1">
                            <a href="toggle/application/1" class="text-green-600 hover:underline text-sm">Open</a>
                            <span>|</span>
                            <a href="/admin/toggle/application?status=0" class="text-red-600 hover:underline text-sm">Close</a>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600">Registration</p>
                        <div class="flex justify-center space-x-1 mt-1">
                            <a href="/admin/toggle/registration?status=1" class="text-green-600 hover:underline text-sm">Open</a>
                            <span>|</span>
                            <a href="/admin/toggle/registration?status=0" class="text-red-600 hover:underline text-sm">Close</a>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-gray-600">Results Entry</p>
                        <div class="flex justify-center space-x-1 mt-1">
                            <a href="/admin/toggle/results_entry?status=1" class="text-green-600 hover:underline text-sm">Open</a>
                            <span>|</span>
                            <a href="/admin/toggle/results_entry?status=0" class="text-red-600 hover:underline text-sm">Close</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Exam Officers -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold flex items-center">
                <i class="fas fa-user-shield mr-2 text-secondary"></i> Exam Officers
            </h2>
            <button onclick="document.getElementById('createOfficerModal').showModal()" 
                    class="px-4 py-2 bg-green-600 text-white text-sm rounded-lg hover:bg-green-700 transition">
                <i class="fas fa-plus mr-1"></i> Add Officer
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Staff ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($exam_officers ?? [] as $officer): ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm"><?= esc($officer['email']) ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm"><?= esc($officer['matric_no']) ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $officer['is_active'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                <?= $officer['is_active'] ? 'Active' : 'Inactive' ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <?php if ($officer['is_active']): ?>
                                <a href="/admin/toggle-officer/<?= $officer['id'] ?>/0" class="text-red-600 hover:text-red-900">Deactivate</a>
                            <?php else: ?>
                                <a href="/admin/toggle-officer/<?= $officer['id'] ?>/1" class="text-green-600 hover:text-green-900">Activate</a>
                            <?php endif; ?>
                            <a href="/admin/reset-password/<?= $officer['id'] ?>" class="text-blue-600 hover:text-blue-900">Reset PW</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="flex flex-wrap gap-4">
        <a href="/admin/registration-list" class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition flex items-center">
            <i class="fas fa-list-ul mr-2"></i> Registration List
        </a>
        <a href="/admin/activate-results" class="px-6 py-3 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition flex items-center">
            <i class="fas fa-check-circle mr-2"></i> Activate Results
        </a>
        <a href="/admin/settings" class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition flex items-center">
            <i class="fas fa-cog mr-2"></i> Portal Settings
        </a>
    </div>
</div>

<!-- Create Officer Modal -->
<dialog id="createOfficerModal" class="p-6 bg-white rounded-xl shadow-xl max-w-md w-full">
    <h3 class="text-lg font-semibold mb-4">Create Exam Officer</h3>
    <form action="/admin/create-officer" method="post">
        <?= csrf_field() ?>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Staff ID</label>
            <input type="text" name="matric_no" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary">
        </div>
        <div class="flex justify-end space-x-2">
            <button type="button" onclick="this.closest('dialog').close()" class="px-4 py-2 border rounded-lg hover:bg-gray-100">Cancel</button>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Create</button>
        </div>
    </form>
</dialog>

<?= $this->endSection() ?>