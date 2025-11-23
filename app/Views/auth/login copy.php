<?= $this->extend('layouts/main') ?>
<?='ABC'?>
<?= $this->section('content') ?>
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <div class="flex justify-center mb-4">
            <img src="<?= esc($school['logo']) ?>" alt="Logo" class="h-16">
        </div>
        <h2 class="text-2xl font-bold text-center mb-6">Login to <?= esc($school['name']) ?></h2>
        <?php if (session()->getFlashdata('error')): ?>
            <script>
                // Toastify({
                //     text: "<?= session('error') ?>",
                //     duration: 3000,
                //     backgroundColor: "red",
                //     position: "right",
                //     gravity: "top"
                // }).showToast();
            </script>
             <script>
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: '<?= session()->getFlashdata('error') ?>',
          confirmButtonColor: '#4A90E2'
        });
      </script>
        <?php endif; ?>
        <form action="/login" method="post">
            <?= csrf_field() ?>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="mt-1 block w-full p-2 border rounded-md" value="<?= old('email') ?>" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="mt-1 block w-full p-2 border rounded-md" required>
            </div>
            <button type="submit" class="w-full bg-<?= esc($school['primary_color']) ?> text-white p-2 rounded-md hover:bg-<?= esc($school['secondary_color']) ?>" style="background: <?= esc($school['secondary_color']) ?>;">Login</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
<!-- //login page -->