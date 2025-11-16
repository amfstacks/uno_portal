<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Form | <?= esc($school['name']) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .form-bg { background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">

<div class="min-h-screen flex items-center justify-center py-12 px-6 form-bg">
    <div class="max-w-2xl w-full bg-white rounded-2xl shadow-xl p-8 md:p-12" data-aos="fade-up">
        
        <div class="text-center mb-10">
            <img src="<?= esc($school['logo']) ?>" alt="Logo" class="h-16 mx-auto mb-4">
            <h1 class="text-3xl font-bold text-gray-900">Application Form</h1>
            <p class="text-gray-600 mt-2">Fill in your details to apply</p>
        </div>

        <?php if (session()->has('errors')): ?>
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                <ul class="list-disc list-inside">
                    <?php foreach (session('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="/apply/submit" method="post" class="space-y-6">
            <?= csrf_field() ?>

            <!-- Name Fields -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                    <input type="text" name="first_name" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[<?= $school['primary_color'] ?? '#1e40af' ?>] focus:border-transparent transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name <span class="text-gray-400">(Optional)</span></label>
                    <input type="text" name="middle_name" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[<?= $school['primary_color'] ?? '#1e40af' ?>]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                    <input type="text" name="last_name" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[<?= $school['primary_color'] ?? '#1e40af' ?>]">
                </div>
            </div>

            <!-- Contact -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input type="email" name="email" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[<?= $school['primary_color'] ?? '#1e40af' ?>]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                    <input type="text" name="phone" required placeholder="+2348012345678"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[<?= $school['primary_color'] ?? '#1e40af' ?>]">
                </div>
            </div>

            <!-- Program & Course -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Program</label>
                    <select name="program" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[<?= $school['primary_color'] ?? '#1e40af' ?>]">
                        <option value="">Select Program</option>
                        <option value="Undergraduate">Undergraduate</option>
                        <option value="Postgraduate">Postgraduate</option>
                        <option value="Diploma">Diploma</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Course of Study</label>
                    <select name="course_id" required 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[<?= $school['primary_color'] ?? '#1e40af' ?>]">
                        <option value="">Select Course</option>
                        <?php foreach ($courses as $course): ?>
                            <option value="<?= $course['id'] ?>"><?= esc($course['title']) ?> (<?= $course['code'] ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Create Password</label>
                <input type="password" name="password" required minlength="6"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[<?= $school['primary_color'] ?? '#1e40af' ?>]">
                <p class="text-xs-600 text-xs mt-1">Minimum 6 characters</p>
            </div>

            <!-- Submit -->
            <div class="pt-6">
                <button type="submit" 
                        class="w-full bg-[<?= $school['primary_color'] ?? '#1e40af' ?>] text-white font-semibold py-4 rounded-lg hover:shadow-xl transition transform hover:scale-105">
                    Submit Application
                </button>
            </div>

            <p class="text-center text-sm text-gray-500 mt-6">
                By submitting, you agree to our <a href="#" class="text-[<?= $school['primary_color'] ?? '#1e40af' ?>] underline">Terms & Privacy Policy</a>.
            </p>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script> AOS.init({ duration: 600 }); </script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</body>
</html>