<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply to <?= esc($school['name']) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .hero-bg { background: linear-gradient(135deg, <?= $school['primary_color'] ?? '#1e40af' ?> 0%, <?= $school['secondary_color'] ?? '#1e293b' ?> 100%); }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

<!-- Navbar -->
<header class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-3">
            <img src="<?= esc($school['logo']) ?>" alt="Logo" class="h-10 w-10 rounded">
            <span class="text-xl font-bold text-gray-900"><?= esc($school['short_name'] ?? $school['name']) ?></span>
        </div>
        <a href="/apply" class="bg-[<?= $school['primary_color'] ?? '#1e40af' ?>] text-white px-6 py-2 rounded-lg hover:shadow-lg transition">
            Apply Now
        </a>
    </div>
</header>

<!-- Hero -->
<section class="hero-bg text-white py-24" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h1 class="text-5xl md:text-6xl font-bold mb-6">Welcome to <br><span class="text-yellow-300"><?= esc($school['name']) ?></span></h1>
        <p class="text-xl mb-8 max-w-3xl mx-auto">Join a community of excellence. Apply today and start your journey toward a brighter future.</p>
        <a href="/apply" class="inline-block bg-white text-[<?= $school['primary_color'] ?? '#1e40af' ?>] font-semibold px-8 py-4 rounded-lg hover:scale-105 transition transform">
            Start Application
        </a>
    </div>
</section>

<!-- About -->
<section class="py-20 bg-white" data-aos="fade-up" data-aos-delay="100">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-4xl font-bold mb-6">Why Choose Us?</h2>
                <ul class="space-y-4 text-lg">
                    <li class="flex items-start"><i class="fas fa-check text-green-600 mt-1 mr-3"></i> World-class faculty and facilities</li>
                    <li class="flex items-start"><i class="fas fa-check text-green-600 mt-1 mr-3"></i> Industry-aligned programs</li>
                    <li class="flex items-start"><i class="fas fa-check text-green-600 mt-1 mr-3"></i> 95% graduate employment rate</li>
                    <li class="flex items-start"><i class="fas fa-check text-green-600 mt-1 mr-3"></i> Scholarships available</li>
                </ul>
            </div>
            <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Campus" class="rounded-xl shadow-lg">
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-20 bg-gray-100" data-aos="fade-up" data-aos-delay="200">
    <div class="max-w-4xl mx-auto text-center px-6">
        <h2 class="text-4xl font-bold mb-6">Ready to Apply?</h2>
        <p class="text-lg mb-8">Secure your spot in the next academic session. Application takes less than 5 minutes.</p>
        <a href="/apply" class="inline-block bg-[<?= $school['primary_color'] ?? '#1e40af' ?>] text-white font-semibold px-10 py-4 rounded-lg hover:shadow-xl transition transform hover:scale-105">
            Apply Now
        </a>
    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-900 text-white py-12">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <p>&copy; <?= date('Y') ?> <?= esc($school['name']) ?>. All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({ duration: 800, once: true });
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</body>
</html>