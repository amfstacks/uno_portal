<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply to <?= esc($school['name']) ?></title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Beautiful fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- AOS Animations -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
        }
        .hero-bg { 
            background: linear-gradient(
                140deg, 
                <?= $school['primary_color'] ?? '#2563eb' ?> 0%, 
                <?= $school['secondary_color'] ?? '#1e293b' ?> 100%
            ); 
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

<!-- Navbar -->
<header class="bg-white/90 backdrop-blur-sm shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-3">
            <img src="<?= esc($school['logo']) ?>" alt="Logo" class="h-10 w-10 rounded shadow-md object-cover">
            <span class="text-xl font-semibold text-gray-900"><?= esc($school['short_name'] ?? $school['name']) ?></span>
        </div>
        <a href="/apply" class="bg-[<?= $school['primary_color'] ?? '#2563eb' ?>] text-white px-6 py-2 rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition">
            Apply Now
        </a>
    </div>
</header>

<!-- Hero Section -->
<section class="hero-bg text-white py-28" data-aos="fade-up">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
            Welcome to <br>
            <span class="text-yellow-300 drop-shadow-md"><?= esc($school['name']) ?></span>
        </h1>
        <p class="text-xl mb-10 max-w-2xl mx-auto opacity-90">
            Join a community of excellence. Apply today and begin your journey toward a brighter future.
        </p>
        <a href="/apply" class="inline-block bg-white text-[<?= $school['primary_color'] ?? '#2563eb' ?>] font-semibold px-10 py-4 rounded-xl shadow-lg hover:scale-105 transition">
            Start Application
        </a>
    </div>
</section>

<!-- About -->
<section class="py-24 bg-white" data-aos="fade-up" data-aos-delay="100">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-4xl font-bold mb-6 text-gray-900">Why Choose Us?</h2>

                <div class="space-y-5 text-lg text-gray-700">
                    <div class="flex">
                        <i class="fas fa-check text-green-600 text-xl mr-3 mt-1"></i>
                        <span>World-class faculty and facilities</span>
                    </div>
                    <div class="flex">
                        <i class="fas fa-check text-green-600 text-xl mr-3 mt-1"></i>
                        <span>Industry-aligned academic programs</span>
                    </div>
                    <div class="flex">
                        <i class="fas fa-check text-green-600 text-xl mr-3 mt-1"></i>
                        <span>95% graduate employment rate</span>
                    </div>
                    <div class="flex">
                        <i class="fas fa-check text-green-600 text-xl mr-3 mt-1"></i>
                        <span>Scholarships and financial support available</span>
                    </div>
                </div>
            </div>

            <!-- Higher-quality placeholder -->
            <img src="https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?auto=format&fit=crop&w=900&q=80" 
                 alt="Campus"
                 class="rounded-xl shadow-xl hover:scale-[1.02] transition object-cover">
        </div>
    </div>
</section>

<!-- Programs or Highlights -->
<section class="py-20 bg-gray-100" data-aos="fade-up">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-4xl font-bold text-center mb-14">What We Offer</h2>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10">
            <!-- Card -->
            <div class="bg-white p-8 rounded-xl shadow hover:shadow-xl transition">
                <img src="https://via.placeholder.com/800x500?text=Program+Overview" class="rounded-md mb-5 w-full" />
                <h3 class="text-xl font-semibold mb-2">Quality Education</h3>
                <p class="opacity-80">Learn with highly qualified educators who bring real industry experience.</p>
            </div>

            <div class="bg-white p-8 rounded-xl shadow hover:shadow-xl transition">
                <img src="https://via.placeholder.com/800x500?text=Campus+Life" class="rounded-md mb-5 w-full" />
                <h3 class="text-xl font-semibold mb-2">Vibrant Campus Life</h3>
                <p class="opacity-80">Enjoy sports, clubs, events & opportunities for personal development.</p>
            </div>

            <div class="bg-white p-8 rounded-xl shadow hover:shadow-xl transition">
                <img src="https://via.placeholder.com/800x500?text=Success+Support" class="rounded-md mb-5 w-full" />
                <h3 class="text-xl font-semibold mb-2">Career Support</h3>
                <p class="opacity-80">Benefit from career guidance and internship placement programs.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-24 bg-white" data-aos="fade-up" data-aos-delay="150">
    <div class="max-w-4xl mx-auto text-center px-6">
        <h2 class="text-4xl font-bold mb-6">Ready to Apply?</h2>
        <p class="text-lg mb-10 text-gray-700">Secure your spot in the next academic session. It takes less than 5 minutes.</p>
        <a href="/apply" class="inline-block bg-[<?= $school['primary_color'] ?? '#2563eb' ?>] text-white font-semibold px-12 py-4 rounded-xl shadow-lg hover:scale-105 transition">
            Apply Now
        </a>
    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-900 text-white py-14">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <p class="text-sm opacity-70">&copy; <?= date('Y') ?> <?= esc($school['name']) ?> — All Rights Reserved.</p>
    </div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({ duration: 900, once: true });
</script>

<!-- Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</body>
</html>
