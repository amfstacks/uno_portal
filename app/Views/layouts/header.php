<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($school['name']) ?> | Student Portal</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> -->
    
    <!-- <link href="https://cdn.jsdelivr.net/npm/@tailwindcss/forms@0.5.3/dist/forms.min.css" rel="stylesheet"> -->
    <link href="/assets/css/custom.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastify-js" ></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <style><?= esc($school['custom_css']) ?></style>
</head>
<body class="bg-gray-50">
    <!-- <?= '<header class="bg-['.$school['primary_color'].'] text-white p-4"><h1>'.esc($school['name']).'</h1></header>' ?> -->
<?= '
<header class="bg-['.$school['primary_color'].'] text-white p-4">
    <div class="flex justify-between items-center">
        <h1>'.esc($school['name']).'</h1>
        <nav class="hidden sm:flex space-x-4 text-sm">
            <a href="/" class="hover:underline">Home</a>
            <a href="#" class="hover:underline">About</a>
            <a href="#" class="hover:underline">Contact</a>
        </nav>
        <!-- Mobile menu button -->
        <button class="sm:hidden" onclick="document.getElementById(`mobile-menu`).classList.toggle(`hidden`)">
            ☰
        </button>
    </div>

    <!-- Mobile dropdown -->
    <nav id="mobile-menu" class="sm:hidden hidden mt-3 flex flex-col space-y-2 text-sm">
        <a href="/" class="hover:underline">Home</a>
        <a href="#" class="hover:underline">About</a>
        <a href="#" class="hover:underline">Contact</a>
    </nav>
</header>
' ?>


    <?= $this->renderSection('content') ?>