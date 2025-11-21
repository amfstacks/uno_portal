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
                                <th style="width:5%">#</th>
                                <th>Code</th>
                                <th>Title</th>
                                <th style="width:8%">Units</th>
                                <th style="width:10%">Select</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($courses as $c): ?>
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
                                        <input 
                                            type="checkbox"
                                            name="course_ids[]"
                                            value="<?= esc($c['id']) ?>"
                                            class="form-check-input"
                                        >
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <button type="submit" class="btn btn-primary mt-3 w-100">
                        Submit Registration
                    </button>

                </form>

            <?php endif; ?>

        </div>
    </div>

</div>

<script>
document.getElementById("courseRegForm").addEventListener("submit", function(e) {
    e.preventDefault();

    let formData = new FormData(this);

    fetch("<?= site_url('student/course-registration/submit') ?>", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
        if (data.status === "success") {
            location.reload();
        }
    })
    .catch(err => alert("Error submitting registration."));
});
</script>

<?= $this->endSection() ?>
