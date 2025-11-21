<?= $this->extend('layouts/student') ?>
<?= $this->section('content') ?>

<div class="space-y-8">

    <!-- === TOP SUMMARY CARDS === -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="p-6 bg-white rounded-xl border shadow-sm">
            <p class="text-sm text-gray-600">Session</p>
            <p class="text-2xl font-bold primary-text"><?= esc($session) ?></p>
        </div>
        <div class="p-6 bg-white rounded-xl border shadow-sm">
            <p class="text-sm text-gray-600">Level</p>
            <p class="text-2xl font-bold primary-text"><?= esc($student['level']) ?></p>
        </div>
        <div class="p-6 bg-white rounded-xl border shadow-sm">
            <p class="text-sm text-gray-600">Semester</p>
            <p class="text-2xl font-bold primary-text"><?= esc($student['semester']) ?></p>
        </div>
    </div>

    <!-- ==========================================================
       ========== REGISTERED COURSES (IF ANY) =====================
       ========================================================== -->
    <div class="bg-white p-6 rounded-xl shadow-sm border">

        <h2 class="text-xl font-semibold mb-4 flex justify-between">
            Registered Courses
            <span class="text-sm bg-primary text-white px-3 py-1 rounded-full">
                Total Units: <?= $registered_total_units ?>
            </span>
        </h2>

        <?php if (empty($registered_courses)): ?>
            <p class="text-gray-500">You have not registered any courses yet.</p>

        <?php else: ?>

            <table class="min-w-full border rounded-lg overflow-hidden">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">Code</th>
                        <th class="px-4 py-2">Title</th>
                        <th class="px-4 py-2">Units</th>
                        <th class="px-4 py-2 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    <?php foreach ($registered_courses as $rc): ?>
                        <tr>
                            <td class="px-4 py-2 font-semibold"><?= esc($rc['ccode']) ?></td>
                            <td class="px-4 py-2"><?= esc($rc['ctitle']) ?></td>
                            <td class="px-4 py-2"><?= esc($rc['unit']) ?></td>
                            <td class="px-4 py-2 text-center">

                                <button onclick="dropCourse(<?= $rc['id'] ?>)"
                                    class="text-red-600 hover:text-red-800 font-medium">
                                    Drop
                                </button>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php endif; ?>

    </div>

    <!-- ==========================================================
       ========== ADD NEW COURSES SECTION =========================
       ========================================================== -->
    <div class="bg-white p-6 rounded-xl shadow-sm border">

        <h2 class="text-xl font-semibold mb-4">Add New Courses</h2>

        <?php if (empty($courses)): ?>

            <p class="p-4 bg-yellow-100 border-l-4 border-yellow-400 text-yellow-800 rounded">
                No courses available for selection.
            </p>

        <?php else: ?>

            <form id="courseRegForm" class="space-y-6">

                <div class="overflow-auto max-h-96 border rounded-lg">
                    <table class="min-w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2">#</th>
                                <th class="px-4 py-2">Code</th>
                                <th class="px-4 py-2">Title</th>
                                <th class="px-4 py-2">Units</th>
                                <th class="px-4 py-2 text-center">Select</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            <?php $i = 1; foreach ($courses as $c): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2"><?= $i++ ?></td>
                                    <td class="px-4 py-2 font-semibold"><?= esc($c['code']) ?></td>
                                    <td class="px-4 py-2">
                                        <?= esc($c['title']) ?>
                                    </td>
                                    <td class="px-4 py-2"><?= esc($c['units']) ?></td>
                                    <td class="px-4 py-2 text-center">
                                        <input type="checkbox"
                                            name="course_ids[]"
                                            value="<?= $c['id'] ?>"
                                            data-unit="<?= $c['units'] ?>"
                                            class="course-check h-5 w-5 text-primary focus:ring-primary">
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>

                <!-- TOTAL UNITS DISPLAY -->
                <div class="flex justify-between items-center bg-gray-100 p-4 rounded-lg">
                    <p class="text-gray-700">
                        <strong>Newly Selected Units:</strong>
                        <span id="unitCount" class="font-bold text-primary">0</span>
                    </p>

                    <p class="text-gray-700">
                        <strong>Total After Registration:</strong>
                        <span id="totalAfter" class="font-bold text-primary">
                            <?= $registered_total_units ?>
                        </span>
                    </p>
                </div>

                <button type="submit"
                    class="w-full bg-primary hover:bg-primary/90 text-white font-medium py-3 rounded-lg transition">
                    Submit Registration
                </button>

            </form>

        <?php endif; ?>

    </div>

</div>


<!-- ================== JAVASCRIPT ================== -->
<script>
const registeredUnits = <?= $registered_total_units ?>;
const checkboxes       = document.querySelectorAll('.course-check');
const unitCount        = document.getElementById("unitCount");
const totalAfter       = document.getElementById("totalAfter");

function updateUnits() {
    let total = 0;

    checkboxes.forEach(cb => {
        if (cb.checked) total += parseInt(cb.dataset.unit);
    });

    unitCount.textContent = total;
    totalAfter.textContent = total + registeredUnits;
}

checkboxes.forEach(cb => cb.addEventListener("change", updateUnits));


/* --- SUBMIT NEW COURSES --- */
document.getElementById("courseRegForm")?.addEventListener("submit", function(e) {
    e.preventDefault();

    if (!confirm("Submit selected courses?")) return;

    let submitBtn = this.querySelector("button[type=submit]");
    submitBtn.disabled = true;
    submitBtn.textContent = "Submitting...";

    fetch("<?= site_url('student/submit') ?>", {
        method: "POST",
        body: new FormData(this)
    })
    .then(r => r.json())
    .then(data => {
        alert(data.message);
        if (data.status === "success") location.reload();
    });
});


/* --- DROP COURSE --- */
function dropCourse(id) {
    if (!confirm("Drop this course?")) return;

    fetch("<?= site_url('student/drop') ?>/" + id)
        .then(r => r.json())
        .then(data => {
            alert(data.message);
            if (data.status === "success") location.reload();
        });
}
</script>

<?= $this->endSection() ?>
