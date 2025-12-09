<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
     body {
            font-family: 'Montserrat', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif;
        }
/* Page fade + slide animation */
.login-wrapper {
    animation: slideIn 0.8s ease forwards;
    opacity: 0;
    transform: translateY(30px);
}

@keyframes slideIn {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Smooth logo fade */
.logo-animate {
    animation: fadeIn 1s ease forwards;
    opacity: 0;
}

@keyframes fadeIn {
    to { opacity: 1; }
}

/* Glass effect */
.glass-card {
    backdrop-filter: blur(15px);
    /* background: rgba(255, 255, 255, 1); */
    box-shadow: 0 8px 32px rgba(0,0,0,0.25);
    border: 1px solid rgba(255,255,255,0.3);
}
/* Make all text inside the login card white */
.glass-card,
.glass-card * {
    color: white !important;
}

/* Keep inputs readable */
.glass-card input {
    color: black !important;
    border-color: rgba(255,255,255,0.5) !important;
}

.glass-card label {
    color: white !important;
}

.glass-card input::placeholder {
    color: rgba(255,255,255,0.7) !important;
}


/* Better mobile spacing */
@media (max-width: 480px) {
    .glass-card {
        /* padding: 1.8rem !important; */
        border-radius: 1rem !important;
    }
    h2 {
        font-size: 1.6rem !important;
    }
    .login-wrapper {
        transform: translateY(15px);
    }
}
</style>

<!-- BACKGROUND IMAGE + OVERLAY -->
<div class="relative min-h-screen w-full flex items-center justify-center">

    <!-- Background Image -->
    <div class="absolute inset-0 bg-cover bg-center"
         style="background-image: url('/assets/uploads/logos/bg.jpeg');">
    </div>

    <!-- Color Overlay -->
    <div class="absolute inset-0"
         style="background: <?= esc($school['primary_color']) ?>; opacity: 0.55;">
    </div>

    <!-- LOGIN CARD -->
    <div class="relative login-wrapper glass-card p-2 md:p-10 rounded-2xl w-[98%] max-w-lg">

        <!-- LOGO -->
        <div class="flex justify-center mb-6">
            <img src="<?= esc($school['logo']) ?>" alt="Logo"
                 class="h-2a0 w-a20 object-contain rouanded-full drop-shadow-xl logo-animate h-a10 w-14 lg:h-1a2 lg:w-20 rounded-lg shadow-md object-contain bg-white p-1">
        </div>

        <h2 class="text-3xl font-bold text-center mb-6 text-gray-800 leading-tight">
            
            <span class="uppercase" style="color: <?= esc($school['secondary_color']) ?>;">
                <?= esc($school['name']) ?>
            </span>
             <br>
            <small>Student Login</small>
        </h2>

        <!-- ERROR POPUP -->
        <?php if (session()->getFlashdata('error')): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login Failed',
                text: '<?= session()->getFlashdata('error') ?>',
                confirmButtonColor: '<?= esc($school['primary_color']) ?>'
            });
        </script>
        <?php endif; ?>

        <!-- FORM -->
        <form action="/login" method="post" class="space-y-5">
            <?= csrf_field() ?>

            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email"
                       class="mt-1 block w-full p-3 border rounded-lg focus:ring-2 focus:ring-[<?= esc($school['primary_color']) ?>]"
                       value="<?= old('email') ?>" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password"
                       class="mt-1 block w-full p-3 border rounded-lg focus:ring-2 focus:ring-[<?= esc($school['primary_color']) ?>]"
                       required>
            </div>

            <button type="submit"
                class="w-full py-3 rounded-lg text-white text-lg font-semibold shadow-lg transition transform hover:scale-[1.03]"
                style="background: <?= esc($school['primary_color']) ?>;">
                Login
            </button>
        </form>

        <p class="text-center text-xs text-gray-700 mt-6 drop-shadow">
            © <?= date('Y') ?> <?= esc($school['name']) ?> <br> All Rights Reserved
        </p>

    </div>
</div>

<?= $this->endSection() ?>
