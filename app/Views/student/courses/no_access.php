<?= $this->extend('layouts/student') ?>
<?= $this->section('content') ?>

<div class="container mt-5 text-center">
    <div class="alert alert-danger p-4">
        <h4 class="mb-2"><?= esc($title) ?></h4>
        <p><?= esc($message) ?></p>
    </div>

    <a href="<?= site_url('student/dashboard') ?>" class="btn btn-primary mt-3">
        Back to Dashboard
    </a>
</div>

<?= $this->endSection() ?>
