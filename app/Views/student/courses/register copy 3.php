<?= $this->extend('layouts/student') ?>
<?= $this->section('content') ?>

<div class="space-y-6">

    <!-- === HEADER SUMMARY CARDS === -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <div class="bg-white p-6 rounded-xl shadow-sm border">
            <p class="text-sm text-gray-600">Session</p>
            <p class="text-2xl font-bold primary-text"><?= esc($session) ?></p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border">
            <p class="text-sm text-gray-600">Level</p>
            <p class="text-2xl font-bold primary-text"><?= esc($student['level']) ?></p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border">
            <p class="text-sm text-gray-600">Semester</p>
            <p class="text-2xl font-bold primary-text"><?= esc($student['semester']) ?></p>
        </div>

    </div>

    <!-- === COURSE REGISTRATION CARD === -->
    <div class="bg-white p-6 rounded-xl shadow-sm border">

        <h2 class="text-xl font-semibold mb-4">Course Registration</h2>

        <?php if (empty($courses)): ?>
            <div class="p-4 bg-yellow-100 border-l-4 border-yellow-400 text-yellow-800 rounded">
                No courses found for your department, level, and semester.
            </div>
        <?php else: ?>

            <form id="courseRegForm" class="space-y-4">

                <div class="overflow-auto">
                    <table class="min-w-full border rounded-lg overflow-hidden">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">#</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Code</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Title</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Units</th>
                                <th class="px-4 py-2 text-center text-sm font-medium text-gray-700">Select</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">
                            <?php $i = 1; ?>
                            <?php foreach ($courses as $c): ?>
                                <?php $isReg = in_array($c['id'], $registered ?? []); ?>

                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2"><?= $i++ ?></td>
                                    <td class="px-4 py-2 font-semibold text-gray-800"><?= esc($c['code']) ?></td>

                                    <td class="px-4 py-2">
                                        <p class="font-medium text-gray-800"><?= esc($c['title']) ?></p>
                                        <?php if (!empty($c['applied_course_name'])): ?>
                                            <p class="text-xs text-gray-500">Applied: <?= esc($c['applied_course_name']) ?></p>
                                        <?php endif ?>
                                    </td>

                                    <td class="px-4 py-2"><?= esc($c['units']) ?></td>

                                    <td class="px-4 py-2 text-center">
                                        <input type="checkbox"
                                               name="course_ids[]"
                                               value="<?= $c['id'] ?>"
                                               class="h-5 w-5 text-primary focus:ring-primary course-check"
                                               <?= $isReg ? 'checked disabled' : '' ?>>
                                    </td>
                                </tr>

                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>

                <div class="flex justify-between items-center mt-3">
                    <p class="text-gray-700">
                        <strong>Total Selected Units:</strong>
                        <span id="unitCount" class="font-bold">0</span>
                    </p>
                </div>

               <button type="submit"
        class="w-full primary hover:bg-primary/90 text-white font-medium py-3 rounded-lg transition">
    Submit Registration
</button>


            </form>

        <?php endif; ?>

    </div>

</div>


<!-- ================== JAVASCRIPT ================== -->
<script>
const checkboxes = document.querySelectorAll('.course-check');
const unitCount = document.getElementById("unitCount");

// update total units
function updateUnits() {
    let total = 0;

    checkboxes.forEach((c) => {
        if (c.checked && !c.disabled) {
            total += parseInt(c.closest("tr").children[3].innerText);
        }
    });

    unitCount.textContent = total;
}

checkboxes.forEach(cb => cb.addEventListener("change", updateUnits));
updateUnits();

// submit
document.getElementById("courseRegForm").addEventListener("submit", function(e) {
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
    })
    .catch(() => alert("Error submitting registration."));
});
</script>

<?= $this->endSection() ?>
