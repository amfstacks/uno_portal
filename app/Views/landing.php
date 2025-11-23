<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shettima College of Health Science | Excellence in Healthcare Education</title>
    <meta name="description" content="Leading institution for Nursing, Medical Laboratory Science & Public Health in Nigeria. Fully accredited. 100% licensure success.">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                        display: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- AOS + Icons -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
         body {
            font-family: 'Montserrat', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif;
        }
        .hero-gradient {
            background: linear-gradient(135deg, 
                <?= $school['primary_color'] ?? '#0d9488' ?> 0%, 
                <?= $school['secondary_color'] ?? '#115e59' ?> 100%
            );
        }
        .text-gradient {
            background: linear-gradient(to right, #ffffff, #ccfbf1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

<!-- PROFESSIONAL RESPONSIVE NAVBAR -->
<header class="fixed top-0 left-0 right-0 bg-white/95 backdrop-blur-lg shadow-sm z-50 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 lg:h-20">

            <!-- Logo + Name -->
            <div class="flex items-center space-x-3">
                <img src="<?= esc($school['logo']) ?>" alt="Logo" class="h-10 w-10 lg:h-12 lg:w-12 rounded-lg shadow-md object-contain bg-white p-1">
                <div class="leading-tight">
                    <h1 class="text-lg lg:text-xl font-bold text-teal-700 uppercase">Shettima College of Health Science</h1>
                    <!-- <p class="text-xs lg:text-sm text-gray-500">of Health Science</p> -->
                </div>
            </div>

            <!-- Desktop Menu -->
            <nav class="hidden lg:flex items-center space-x-8">
                <a href="#" class="text-gray-700 hover:text-teal-600 font-medium transition">Home</a>
                <a href="#programs" class="text-gray-700 hover:text-teal-600 font-medium transition">Programs</a>
                <a href="#about" class="text-gray-700 hover:text-teal-600 font-medium transition">About</a>
                <a href="#facilities" class="text-gray-700 hover:text-teal-600 font-medium transition">Facilities</a>
                <a href="#contact" class="text-gray-700 hover:text-teal-600 font-medium transition">Contact</a>
                <a href="/apply" class="bg-teal-600 hover:bg-teal-700 text-white font-bold px-7 py-3 rounded-full shadow-lg hover:shadow-xl transition">
                    Apply Now
                </a>
            </nav>

            <!-- Mobile Hamburger -->
            <button id="menu-btn" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition">
                <i class="fas fa-bars text-2xl text-gray-700"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Menu Dropdown -->
    <div id="mobile-menu" class="lg:hidden hidden bg-white border-t border-gray-200 shadow-xl">
        <div class="px-6 py-5 space-y-1">
            <a href="#" class="block py-3 px-4 text-lg font-medium text-gray-800 hover:bg-teal-50 hover:text-teal-600 rounded-lg transition">Home</a>
            <a href="#programs" class="block py-3 px-4 text-lg font-medium text-gray-800 hover:bg-teal-50 hover:text-teal-600 rounded-lg transition">Programs</a>
            <a href="#about" class="block py-3 px-4 text-lg font-medium text-gray-800 hover:bg-teal-50 hover:text-teal-600 rounded-lg transition">About Us</a>
            <a href="#facilities" class="block py-3 px-4 text-lg font-medium text-gray-800 hover:bg-teal-50 hover:text-teal-600 rounded-lg transition">Facilities</a>
            <a href="#contact" class="block py-3 px-4 text-lg font-medium text-gray-800 hover:bg-teal-50 hover:text-teal-600 rounded-lg transition">Contact</a>
            <a href="/apply" class="block text-center mt-4 bg-teal-600 hover:bg-teal-700 text-white font-bold py-4 rounded-full shadow-lg">
                Apply Now
            </a>
        </div>
    </div>
</header>

<!-- HERO - Mobile Optimized -->
<section class="hero-gradient text-white pt-24 lg:pt-32 pb-16 lg:pb-24 relative overflow-hidden">
    <div class="absolute inset-0 bg-black opacity-25"></div>
    <div class="max-w-7xl mx-auto px-5 lg:px-8 relative z-10">
        <div class="grid lg:grid-cols-2 gap-10 lg:gap-16 items-center">
            <div data-aos="fade-up">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight mb-5">
                    Shaping Tomorrow's <br>
                    <span class="text-gradient text-5xl sm:text-6xl lg:text-7xl">Healthcare Leaders</span>
                </h1>
                <p class="text-lg sm:text-xl lg:text-2xl opacity-95 mb-8 leading-relaxed">
                    Welcome to <strong>Shettima College of Health Science</strong> — Nigeria's trusted institution for world-class healthcare training.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="/apply" class="inline-flex items-center justify-center bg-white text-teal-700 font-bold px-8 py-5 rounded-full text-lg shadow-xl hover:scale-105 transition">
                        <i class="fas fa-user-graduate mr-3"></i> Start Application
                    </a>
                    <a href="/login" class="inline-flex items-center justify-center border-2 border-white text-white font-semibold px-8 py-5 rounded-full hover:bg-white/10 transition">
                        Student Login <i class="fas fa-lock ml-2"></i>
                    </a>
                </div>
            </div>
            <div data-aos="fade-up" data-aos-delay="200">
                <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&w=1350&q=80" 
                     alt="Healthcare students in training" 
                     class="rounded-2xl shadow-2xl w-full object-cover border-8 border-white/30">
            </div>
        </div>
    </div>
</section>

<!-- WHY CHOOSE US - Mobile First -->
<section id="about" class="py-16 lg:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900">Why Choose Shettima College?</h2>
            <p class="text-lg lg:text-xl text-gray-600 mt-3">Trusted. Accredited. Proven Results.</p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                <div class="w-16 h-16 lg:w-20 lg:h-20 mx-auto mb-5 bg-teal-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-stethoscope text-2xl lg:text-3xl text-teal-700"></i>
                </div>
                <h3 class="font-bold text-lg lg:text-xl mb-2">Clinical Excellence</h3>
                <p class="text-gray-600 text-sm lg:text-base">Hands-on training in modern labs & teaching hospitals</p>
            </div>
            <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                <div class="w-16 h-16 lg:w-20 lg:h-20 mx-auto mb-5 bg-emerald-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-certificate text-2xl lg:text-3xl text-emerald-700"></i>
                </div>
                <h3 class="font-bold text-lg lg:text-xl mb-2">Fully Accredited</h3>
                <p class="text-gray-600 text-sm lg:text-base">Approved by NMCN, MLSCN & regulatory bodies</p>
            </div>
            <div class="text-center" data-aos="fade-up" data-aos-delay="300">
                <div class="w-16 h-16 lg:w-20 lg:h-20 mx-auto mb-5 bg-cyan-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-user-md text-2xl lg:text-3xl text-cyan-700"></i>
                </div>
                <h3 class="font-bold text-lg lg:text-xl mb-2">Expert Faculty</h3>
                <p class="text-gray-600 text-sm lg:text-base">Taught by experienced doctors & specialists</p>
            </div>
            <div class="text-center" data-aos="fade-up" data-aos-delay="400">
                <div class="w-16 h-16 lg:w-20 lg:h-20 mx-auto mb-5 bg-teal-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-graduation-cap text-2xl lg:text-3xl text-teal-700"></i>
                </div>
                <h3 class="font-bold text-lg lg:text-xl mb-2">100% Licensure Success</h3>
                <p class="text-gray-600 text-sm lg:text-base">Outstanding pass rate in professional exams</p>
            </div>
        </div>
    </div>
</section>

<!-- PROGRAMS -->
<section id="programs" class="py-16 lg:py-24 bg-gray-50">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900">Our Programs</h2>
            <p class="text-lg lg:text-xl text-gray-600 mt-3">Professional Pathways to Healthcare Excellence</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
                <div class="bg-teal-600 text-white p-8 text-center">
                    <i class="fas fa-heartbeat text-5xl mb-4"></i>
                    <h3 class="text-2xl font-bold">Nursing Science</h3>
                </div>
                <div class="p-7">
                    <p class="text-gray-700 mb-6">Become a Registered Nurse (RN) with comprehensive clinical training.</p>
                    <a href="/apply" class="text-teal-600 font-bold hover:underline">Apply Now →</a>
                </div>
            </div>
            <!-- Repeat for other programs -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
                <div class="bg-emerald-600 text-white p-8 text-center">
                    <i class="fas fa-microscope text-5xl mb-4"></i>
                    <h3 class="text-2xl font-bold">Medical Laboratory Science</h3>
                </div>
                <div class="p-7">
                    <p class="text-gray-700 mb-6">Advanced diagnostic training for certified MLS professionals.</p>
                    <a href="/apply" class="text-emerald-600 font-bold hover:underline">Apply Now →</a>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="300">
                <div class="bg-cyan-600 text-white p-8 text-center">
                    <i咒="fas fa-globe text-5xl mb-4"></i>
                    <h3 class="text-2xl font-bold">Public Health</h3>
                </div>
                <div class="p-7">
                    <p class="text-gray-700 mb-6">Lead community health & disease prevention initiatives.</p>
                    <a href="/apply" class="text-cyan-600 font-bold hover:underline">Apply Now →</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FINAL CTA -->
<section class="py-24 lg:py-28 bg-gradient-to-r from-teal-700 to-emerald-700 text-white">
    <div class="max-w-5xl mx-auto text-center px-5" data-aos="zoom-in">
        <h2 class="text-4xl sm:text-5xl font-extrabold mb-6">Begin Your Journey Today</h2>
        <p class="text-xl lg:text-2xl mb-10 opacity-90">Secure your future in healthcare. Application is free and takes just 5 minutes.</p>
        <div class="flex flex-col sm:flex-row gap-5 justify-center">
            <a href="/apply" class="bg-white text-teal-700 font-bold px-10 py-5 rounded-full text-lg shadow-2xl hover:scale-110 transition">
                Apply Now – Free Application
            </a>
            <a href="tel:+2348012345678" class="border-2 border-white font-semibold px-10 py-5 rounded-full hover:bg-white/10 transition">
                <i class="fas fa-phone mr-2"></i> Call Admissions
            </a>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="bg-gray-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-5 text-center">
        <img src="<?= esc($school['logo']) ?>" alt="Logo" class="h-16 mx-auto mb-4 rounded-lg">
        <h3 class="text-2xl font-bold mb-3">Shettima College of Health Science</h3>
        <p class="text-gray-400 max-w-2xl mx-auto mb-6">
            Training compassionate, competent, and ethical healthcare professionals for Nigeria and beyond.
        </p>
        <p class="text-sm opacity-70">&copy; <?= date('Y') ?> Shettima College of Health Science — All Rights Reserved.</p>
    </div>
</footer>

<!-- Scripts -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 900, once: true, offset: 80 });

    // Mobile menu toggle
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
        const icon = menuBtn.querySelector('i');
        icon.classList.toggle('fa-bars');
        icon.classList.toggle('fa-xmark');
    });

    // Close menu on link click
    document.querySelectorAll('#mobile-menu a').forEach(link => {
        link.addEventListener('click', () => {
            mobileMenu.classList.add('hidden');
            menuBtn.querySelector('i').classList.add('fa-bars');
            menuBtn.querySelector('i').classList.remove('fa-xmark');
        });
    });
</script>
</body>
</html>