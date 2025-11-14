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





<!-- Set Session per Programme -->
<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
    <h3 class="font-medium mb-3 flex items-center">
        <i class="fas fa-calendar-alt mr-2 text-primary"></i> Set Current Academic Session
    </h3>

    <form action="setSession" method="post" class="flex flex-col sm:flex-row gap-2">
        <?= csrf_field() ?>

        <!-- Programme Selector -->
        <select name="programme_id" required class="px-4 py-2 border border-gray-300 rounded-lg">
            <option value="">Select Programme</option>
            <?php foreach ($programmes as $prog): ?>
                <option value="<?= $prog['id'] ?>"><?= esc($prog['name']) ?></option>
            <?php endforeach; ?>
        </select>

        <!-- Session Input -->
        <!-- <input type="text" name="session" placeholder="2025/2026" required
               class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"> -->
<?= sessionDropdown('session', '2025/2026') ?>

        <!-- Semester Selector -->
        <select name="semester" required class="px-4 py-2 border border-gray-300 rounded-lg">
            <option value="1">First Semester</option>
            <option value="2">Second Semester</option>
        </select>
 <select name="session_type" required class="px-4 py-2 border border-gray-300 rounded-lg">
                        <option value="application">Application</option>
                        <option value="registration">Registration</option>
                    </select>
        <button type="submit" class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition">
            Set Session
        </button>
    </form>
</div>


<!-- Active Sessions & Programmes -->
<div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 mt-6">
    <h2 class="text-xl font-semibold mb-4 flex items-center">
        <i class="fas fa-list-alt mr-2 text-primary"></i> Active Sessions & Programmes
    </h2>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Programme</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Session</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Semester</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                    <!-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Application</th> -->
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Results Entry</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($programmes as $prog): ?>
                    <?php 
                        // ALL active sessions for this programme
                        $programmeSessions = $sessionsByProgramme[$prog['id']] ?? [];
                        
                        // If none, show 1 row saying none
                        if (empty($programmeSessions)):
                    ?>
                        <tr>
                            <td class="px-6 py-4 text-sm font-medium"><?= esc($prog['name']) ?></td>
                            <td class="px-6 py-4 text-sm text-red-500">No Active Session</td>
                            <td class="px-6 py-4 text-sm">-</td>
                            <td class="px-6 py-4 text-sm">-</td>
                            <td class="px-6 py-4 text-sm">-</td>
                            <td class="px-6 py-4 text-sm">-</td>
                        </tr>

                    <?php 
                        else:
                            // Loop each session type
                            foreach ($programmeSessions as $type => $session):
                    ?>

                        <tr>
                            <!-- Programme name (only show on first row) -->
                            <td class="px-6 py-4 text-sm font-medium">
                                <?= esc($prog['name']) ?>
                            </td>

                            <!-- Session name -->
                            <td class="px-6 py-4 text-sm">
                                <?= esc($session['session_name']) ?>
                            </td>

                            <!-- Semester -->
                            <td class="px-6 py-4 text-sm">
                                <!-- <?= esc($session['semester']) ?> -->
                                <select 
        class="border rounded px-2 py-1 text-xs bg-white"
        onchange="updateSemester(<?= $session['id'] ?>, this.value)"
    >
        <option value="1" <?= $session['semester'] == 1 ? 'selected' : '' ?>>1</option>
        <option value="2" <?= $session['semester'] == 2 ? 'selected' : '' ?>>2</option>
    </select>
                            </td>

                            <!-- Session Type + Status -->
                            <td class="px-6 py-4 text-sm">
                                <?php 
                                    if ($type === 'application') {
                                        $isOpen = $session['application_open'] ? 'Open' : 'Closed';
                                    } elseif ($type === 'registration') {
                                        $isOpen = $session['registration_open'] ? 'Open' : 'Closed';
                                    } else {
                                        $isOpen = 'N/A';
                                    }

                                    $class = ($isOpen === 'Open') 
                                        ? 'bg-green-100 text-green-700' 
                                        : 'bg-red-100 text-red-700';
                                ?>

                                <span class="font-medium"><?= ucfirst($type) ?></span>

                                <?php if ($type !== 'general'): ?>
                                    <span class="ml-2 px-2 py-1 text-xs rounded <?= $class ?>">
                                      <select 
    class="border rounded px-2 py-1 text-xs bg-white"
    onchange="updateSessionStatus(<?= $session['id'] ?>, '<?= $type ?>', this.value)"
>
    <option value="1" <?= $isOpen === 'Open' ? 'selected' : '' ?>>Open</option>
    <option value="0" <?= $isOpen === 'Closed' ? 'selected' : '' ?>>Closed</option>
</select>

                                    </span>
                                <?php endif; ?>
                            </td>

                            <!-- Application Open -->
                           

                            <!-- Results Entry -->
                            <td class="px-6 py-4 text-sm">
                                <span class="px-2 py-1 rounded text-xs <?= $session['results_entry_open'] ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' ?>">
                                    <?= $session['results_entry_open'] ? 'Open' : 'Closed' ?>
                                </span>
                            </td>
                        </tr>

                    <?php 
                            endforeach;
                        endif;
                    ?>

                <?php endforeach; ?>
            </tbody>
        </table>
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
<script>
function updateSessionStatus(sessionId, type, value) {
    // alert('here');
    fetch('<?= base_url("admin/update-session-status") ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({
            session_id: sessionId,
            type: type,
            value: value
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            // alert('Updated successfully!');
            //  toast('Status updated successfully!');
            showToast('Status updated successfully!');
            //   toastr.success('Status updated successfully!');
            
        } else {
            alert('Error updating!');
        }
    })
    .catch(err => console.error(err));
}

function updateSemester(sessionId, value) {
    fetch('<?= base_url("admin/update-session-semester") ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({
            session_id: sessionId,
            semester: value
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
                       showToast('Status updated successfully!');

        } else {
            toastr.error('Error updating semester!');
        }
    })
    .catch(err => console.error(err));
}

</script>


<?= $this->endSection() ?>