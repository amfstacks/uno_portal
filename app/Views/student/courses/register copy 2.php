<?= $this->extend('layouts/student') ?>
<?= $this->section('content') ?>

<div class="container mt-4">

    <h3 class="mb-1">Course Registration</h3>
    <p class="text-muted">
        Session: <strong><?= esc($session) ?></strong> |
        Level: <strong><?= esc($student['level']) ?></strong> |
        Semester: <strong><?= esc($student['semester']) ?></strong>
    </p>

    <div class="card shadow-sm mt-3">
        <div class="card-body">

            <?php if (empty($courses)): ?>
                <div class="alert alert-warning">
                    No courses found for your department, level, and semester.
                </div>
            <?php else: ?>

               <form id="courseRegForm">

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Title</th>
                <th>Units</th>
                <th>Select</th>
            </tr>
        </thead>

        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($courses as $c): ?>

                <?php 
                    $isReg = in_array($c['id'], $registered ?? []);
                ?>

                <tr>
                    <td><?= $i++ ?></td>

                    <td><?= esc($c['code']) ?></td>

                    <td>
                        <?= esc($c['title']) ?>
                        <?php if (!empty($c['applied_course_name'])): ?>
                            <br>
                            <small class="text-muted">Applied: <?= esc($c['applied_course_name']) ?></small>
                        <?php endif; ?>
                    </td>

                    <td><?= esc($c['units']) ?></td>

                    <td>
                        <input type="checkbox"
                            name="course_ids[]"
                            value="<?= $c['id'] ?>"
                            class="course-check"
                            <?= $isReg ? 'checked disabled' : '' ?>>
                    </td>
                </tr>

            <?php endforeach; ?>
        </tbody>
    </table>

    <p class="mt-2">
        <strong>Total Selected Units:</strong>
        <span id="unitCount">0</span>
    </p>

    <button type="submit" class="btn btn-primary mt-3 w-100">
        Submit Registration
    </button>

</form>

            <?php endif; ?>

        </div>
    </div>

</div>


<script>
const checkboxes = document.querySelectorAll('.course-check');
const unitCount = document.getElementById("unitCount");

// update total units
function updateUnits() {
    let total = 0;

    checkboxes.forEach((c, idx) => {
        if (c.checked && !c.disabled) {
            total += parseInt(c.closest("tr").children[3].innerText);
        }
    });

    unitCount.innerText = total;
}

checkboxes.forEach(cb => cb.addEventListener("change", updateUnits));
updateUnits();

// submit
document.getElementById("courseRegForm").addEventListener("submit", function(e) {
    e.preventDefault();

    if (!confirm("Submit selected courses?")) return;

    let submitBtn = this.querySelector("button[type=submit]");
    submitBtn.disabled = true;
    submitBtn.innerText = "Submitting...";

    fetch("<?= site_url('student/submit') ?>", {
        method: "POST",
        body: new FormData(this)
    })
    .then(r => r.json())
    .then(data => {
        alert(data.message);
        if (data.status === "success") {
            location.reload();
        }
    })
    .catch(() => alert("Error submitting registration."));
});
</script>

<?= $this->endSection() ?>
