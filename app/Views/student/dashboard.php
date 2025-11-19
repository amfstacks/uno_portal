<?= $this->extend('layouts/student') ?>
<?= $this->section('content') ?>

<div class="space-y-6">

    <!-- === TOP CARDS (4 GRID) === -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <!-- First Name -->
        <div class="bg-white p-6 rounded-xl shadow-sm border" data-aos="fade-up">
            <p class="text-sm text-gray-600">First Name</p>
            <p class="text-2xl font-bold primary-text"><?= esc($student['first_name']) ?></p>
        </div>

        <!-- Last Name -->
        <div class="bg-white p-6 rounded-xl shadow-sm border" data-aos="fade-up" data-aos-delay="100">
            <p class="text-sm text-gray-600">Last Name</p>
            <p class="text-2xl font-bold primary-text"><?= esc($student['last_name']) ?></p>
        </div>

        <!-- Matric Number -->
        <div class="bg-white p-6 rounded-xl shadow-sm border" data-aos="fade-up" data-aos-delay="200">
            <p class="text-sm text-gray-600">Matric No</p>
            <p class="text-2xl font-bold primary-text"><?= esc($student['matric_no']) ?></p>
        </div>

        <!-- Current Level -->
        <div class="bg-white p-6 rounded-xl shadow-sm border" data-aos="fade-up" data-aos-delay="300">
            <p class="text-sm text-gray-600">Level</p>
            <p class="text-2xl font-bold primary-text"><?= esc($student['level']) ?></p>
        </div>

    </div>


    <!-- === SECOND GRID (PROFILE + DETAILS) === -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- PROFILE CARD -->
        <div class="bg-white p-6 rounded-xl shadow-sm border" data-aos="fade-up">
            <h3 class="text-xl font-semibold mb-4">Profile Details</h3>

            <div class="flex items-center space-x-4 mb-6">
                <img src="<?= $student['profile_pic'] ? base_url('uploads/' . $student['profile_pic']) : 'https://via.placeholder.com/100' ?>"
                     class="w-24 h-24 rounded-full object-cover border">
                <div>
                    <p class="text-lg font-bold"><?= esc($student['full_name']) ?></p>
                    <p class="text-gray-500 text-sm"><?= esc($student['email']) ?></p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <p class="text-gray-500">Middle Name</p>
                    <p class="font-medium"><?= esc($student['middle_name']) ?></p>
                </div>
                <div>
                    <p class="text-gray-500">Department</p>
                    <p class="font-medium"><?= esc($student['department_name']) ?></p>
                </div>
                <div>
                    <p class="text-gray-500">Faculty</p>
                    <p class="font-medium"><?= esc($student['faculty_name']) ?></p>
                </div>
                <div>
                    <p class="text-gray-500">Course of Study</p>
                    <p class="font-medium"><?= esc($student['course_name']) ?></p>
                </div>
                <div>
                    <p class="text-gray-500">State of Origin</p>
                    <p class="font-medium"><?= esc($student['state_of_origin']) ?></p>
                </div>
                <div>
                    <p class="text-gray-500">Religion</p>
                    <p class="font-medium"><?= esc($student['religion']) ?></p>
                </div>
                <div>
                    <p class="text-gray-500">Blood Group</p>
                    <p class="font-medium"><?= esc($student['blood_group']) ?></p>
                </div>
                <div>
                    <p class="text-gray-500">Date of Birth</p>
                    <p class="font-medium"><?= esc($student['dob']) ?></p>
                </div>
                <div>
                    <p class="text-gray-500">Admission Session</p>
                    <p class="font-medium"><?= esc($student['session_admit']) ?></p>
                </div>
                <div>
                    <p class="text-gray-500">Current Session</p>
                    <p class="font-medium"><?= esc($student['session']) ?></p>
                </div>
                <div>
                    <p class="text-gray-500">Current Semester</p>
                    <p class="font-medium"><?= esc($student['semester']) ?></p>
                </div>
                <div>
                    <p class="text-gray-500">Status</p>
                    <p class="font-medium"><?= esc($student['status']) ?></p>
                </div>
            </div>
        </div>


        <!-- BIO / SIGNATURE CARD -->
        <div class="bg-white p-6 rounded-xl shadow-sm border" data-aos="fade-up" data-aos-delay="100">
            <h3 class="text-xl font-semibold mb-4">Bio</h3>

            <p class="text-gray-700 whitespace-pre-line">
                <?= $student['bio'] ? esc($student['bio']) : 'No bio provided yet.' ?>
            </p>

            <div class="mt-6">
                <h4 class="font-semibold mb-2">Signature</h4>
                <?php if ($student['signature']): ?>
                    <img src="<?= base_url('uploads/' . $student['signature']) ?>"
                         class="w-40 border rounded">
                <?php else: ?>
                    <p class="text-gray-500">No signature uploaded.</p>
                <?php endif; ?>
            </div>

        </div>

    </div>
</div>

<?= $this->endSection() ?>
