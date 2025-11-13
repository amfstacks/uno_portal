<?= $this->extend('layouts/admin') ?>
<?= $this->section('content') ?>

<div class="p-6">
    <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>

    <!-- Active Session -->
    <div class="bg-white p-4 rounded-lg shadow mb-6">
        <h2 class="text-xl font-semibold">Active Session</h2>
        <?php if ($active_session): ?>
            <p class="text-lg"><?= $active_session['session_name'] ?> | Semester <?= $active_session['semester'] ?></p>
        <?php else: ?>
            <p class="text-red-500">No active session</p>
        <?php endif; ?>
    </div>

    <!-- Set Session -->
    <div class="bg-white p-4 rounded-lg shadow mb-6">
        <h2 class="text-xl font-semibold mb-3">Set Academic Session</h2>
        <form action="/admin/set-session" method="post" class="flex gap-2">
            <?= csrf_field() ?>
            <input type="text" name="session" placeholder="2025/2026" class="p-2 border rounded" required>
            <select name="semester" class="p-2 border rounded" required>
                <option value="1">First Semester</option>
                <option value="2">Second Semester</option>
            </select>
            <button type="submit" class="bg-blue-600 text-white p-2 rounded hover:bg-blue-700">Set Session</button>
        </form>
    </div>

    <!-- Control Windows -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white p-4 rounded-lg shadow text-center">
            <h3 class="font-semibold">Application</h3>
            <a href="/admin/toggle/application?status=1" class="text-green-600">Open</a> |
            <a href="/admin/toggle/application?status=0" class="text-red-600">Close</a>
        </div>
        <div class="bg-white p-4 rounded-lg shadow text-center">
            <h3 class="font-semibold">Registration</h3>
            <a href="/admin/toggle/registration?status=1" class="text-green-600">Open</a> |
            <a href="/admin/toggle/registration?status=0" class="text-red-600">Close</a>
        </div>
        <div class="bg-white p-4 rounded-lg shadow text-center">
            <h3 class="font-semibold">Results Entry</h3>
            <a href="/admin/toggle/results_entry?status=1" class="text-green-600">Open</a> |
            <a href="/admin/toggle/results_entry?status=0" class="text-red-600">Close</a>
        </div>
    </div>

    <!-- Exam Officers -->
    <div class="bg-white p-4 rounded-lg shadow mb-6">
        <h2 class="text-xl font-semibold mb-3">Exam Officers</h2>
        <form action="/admin/create-officer" method="post" class="flex gap-2 mb-4">
            <?= csrf_field() ?>
            <input type="email" name="email" placeholder="Email" class="p-2 border rounded" required>
            <input type="text" name="matric_no" placeholder="Staff ID" class="p-2 border rounded" required>
            <button type="submit" class="bg-green-600 text-white p-2 rounded">Create</button>
        </form>
        <table class="min-w-full">
            <thead>
                <tr><th>Email</th><th>Status</th><th>Action</th></tr>
            </thead>
            
        </table>
    </div>

    <!-- Quick Actions -->
    <div class="flex gap-4">
        <a href="/admin/registration-list" class="bg-purple-600 text-white p-3 rounded">Registration List</a>
        <a href="/admin/activate-results" class="bg-orange-600 text-white p-3 rounded">Activate Results</a>
        <a href="/admin/settings" class="bg-gray-600 text-white p-3 rounded">Portal Settings</a>
    </div>
</div>

<?= $this->endSection() ?>