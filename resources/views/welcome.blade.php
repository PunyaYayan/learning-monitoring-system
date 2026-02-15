<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Concept English Course</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;600;700;900&family=DM+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <style>
        :root {
            --primary: #0F5D3B;
            --primary-medium: #2F7F5F;
            --accent: #FBCB0A;
            --cream: #FAFAF8;
            --light-green: #A8CBBE;
            --light-yellow: #FFF1B8;
            --text: #1F2937;
            --gradient-1: linear-gradient(135deg, #0F5D3B 0%, #2F7F5F 100%);
            --gradient-2: linear-gradient(135deg, #2F7F5F 0%, #A8CBBE 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            overflow-x: hidden;
            background-color: #FAFAF8;
            color: #1F2937;
        }

        h1,
        h2,
        h3,
        h4 {
            font-family: 'Archivo', sans-serif;
        }

        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Animated Gradient Background */
        .hero-gradient {
            background: linear-gradient(-45deg, #0F5D3B, #2F7F5F, #A8CBBE, #FBCB0A);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }

        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* Floating Animation */
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .float-animation {
            animation: float 6s ease-in-out infinite;
        }

        /* Fade In Up Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
        }

        .delay-100 {
            animation-delay: 0.1s;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }

        .delay-300 {
            animation-delay: 0.3s;
        }

        .delay-400 {
            animation-delay: 0.4s;
        }

        .delay-500 {
            animation-delay: 0.5s;
        }

        .delay-600 {
            animation-delay: 0.6s;
        }

        /* Card Hover Effects */
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        /* Glowing Button */
        .btn-glow {
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .btn-glow::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s;
        }

        .btn-glow:hover::before {
            left: 100%;
        }

        .btn-glow:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 30px rgba(15, 93, 59, 0.4);
        }

        /* Stat Counter Animation */
        @keyframes countUp {
            from {
                opacity: 0;
                transform: scale(0.5);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .stat-number {
            animation: countUp 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }

        /* Particle Background */
        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            top: 0;
            left: 0;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            animation: particleFloat 20s infinite;
        }

        @keyframes particleFloat {
            0% {
                transform: translateY(100vh) translateX(0);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                transform: translateY(-100px) translateX(100px);
                opacity: 0;
            }
        }

        /* Level Card Special Effect */
        .level-card {
            position: relative;
            background: linear-gradient(135deg, #ffffff 0%, #f9fafb 100%);
            border: 2px solid transparent;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .level-card::before {
            content: '';
            position: absolute;
            inset: -2px;
            background: linear-gradient(135deg, #0F5D3B, #2F7F5F);
            border-radius: inherit;
            opacity: 0;
            transition: opacity 0.4s;
            z-index: -1;
        }

        .level-card:hover::before {
            opacity: 1;
        }

        .level-card:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 15px 35px rgba(15, 93, 59, 0.3);
            color: white;
        }

        /* Testimonial Carousel */
        .testimonial-card {
            background: linear-gradient(135deg, #0F5D3B 0%, #2F7F5F 100%);
            border-radius: 20px;
            padding: 2rem;
            color: white;
            min-height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            transition: all 0.5s ease;
        }

        .carousel-item {
            transition: all 0.5s ease;
        }

        .carousel-item.hidden {
            opacity: 0;
            transform: scale(0.9);
        }

        .carousel-item.block {
            opacity: 1;
            transform: scale(1);
        }

        /* Progress Indicator Dots */
        .carousel-dots {
            display: flex;
            gap: 8px;
            justify-content: center;
            margin-top: 20px;
        }

        .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #d1d5db;
            transition: all 0.3s;
            cursor: pointer;
        }

        .dot.active {
            background: #0F5D3B;
            width: 30px;
            border-radius: 5px;
        }

        /* Icon Styles */
        .feature-icon {
            width: 60px;
            height: 60px;
            color: #0F5D3B;
            stroke-width: 1.5;
        }

        /* Navbar */
        .navbar {
            backdrop-filter: blur(10px);
            background: rgba(250, 250, 248, 0.95);
            transition: all 0.3s;
        }

        .navbar.scrolled {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-white text-gray-800">

    <!-- NAVBAR -->
    <nav class="navbar fixed w-full top-0 z-50 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div
                    class="w-10 h-10 bg-gradient-to-br from-green-800 to-green-600 rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-xl">NC</span>
                </div>
                <span class="font-bold text-xl text-green-900">New Concept</span>
            </div>

            <div class="hidden md:flex gap-8 items-center">
                <a href="#tentang" class="text-gray-600 hover:text-green-700 transition">Tentang</a>
                <a href="#program" class="text-gray-600 hover:text-green-700 transition">Program</a>
                <a href="#keunggulan" class="text-gray-600 hover:text-green-700 transition">Keunggulan</a>
                <a href="#testimoni" class="text-gray-600 hover:text-green-700 transition">Testimoni</a>
                <a href="{{ route('ppdb.create') }}"
                    class="bg-gradient-to-r from-green-800 to-green-600 text-white px-6 py-2 rounded-full font-semibold hover:shadow-lg transition">
                    Daftar
                </a>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section class="hero-gradient text-white relative overflow-hidden pt-24">
        <!-- Particles Background -->
        <div class="particles">
            <div class="particle" style="left: 10%; animation-delay: 0s;"></div>
            <div class="particle" style="left: 20%; animation-delay: 2s;"></div>
            <div class="particle" style="left: 30%; animation-delay: 4s;"></div>
            <div class="particle" style="left: 40%; animation-delay: 1s;"></div>
            <div class="particle" style="left: 50%; animation-delay: 3s;"></div>
            <div class="particle" style="left: 60%; animation-delay: 5s;"></div>
            <div class="particle" style="left: 70%; animation-delay: 2.5s;"></div>
            <div class="particle" style="left: 80%; animation-delay: 4.5s;"></div>
            <div class="particle" style="left: 90%; animation-delay: 1.5s;"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 py-32 grid md:grid-cols-2 gap-12 items-center relative z-10">
            <div class="fade-in-up">
                <div
                    class="inline-block bg-yellow-400/90 backdrop-blur-sm px-4 py-2 rounded-full text-sm mb-6 fade-in-up delay-100 text-green-900 font-semibold">
                    ✨ #1 English Course di Indonesia
                </div>

                <h1 class="text-5xl md:text-7xl font-black mb-6 leading-tight fade-in-up delay-200">
                    Master English,<br>
                    <span class="bg-gradient-to-r from-yellow-300 to-yellow-500 bg-clip-text text-transparent">
                        Master Your Future
                    </span>
                </h1>

                <p class="text-xl mb-10 opacity-90 leading-relaxed fade-in-up delay-300">
                    Pembelajaran terstruktur dengan sistem monitoring digital yang memastikan progress Anda terukur dan
                    berkelanjutan.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 fade-in-up delay-400">
                    <a href="{{ route('ppdb.create') }}"
                        class="btn-glow bg-yellow-400 text-green-900 font-bold px-10 py-4 rounded-full shadow-2xl inline-block text-center hover:bg-yellow-300">
                        Daftar Sekarang
                    </a>
                    <a href="#tentang"
                        class="border-2 border-white text-white font-semibold px-10 py-4 rounded-full hover:bg-white hover:text-green-800 transition inline-block text-center">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>

            <div class="hidden md:block relative fade-in-up delay-500">
                <div class="float-animation">
                    <div class="relative">
                        <div
                            class="absolute -inset-4 bg-gradient-to-r from-green-400 to-yellow-400 rounded-3xl blur-2xl opacity-50">
                        </div>
                        <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800"
                            class="relative rounded-3xl shadow-2xl" alt="Students Learning">
                    </div>
                </div>
            </div>
        </div>

        <!-- Wave Divider -->
        <div class="absolute bottom-0 left-0 w-full">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M0 0L60 10C120 20 240 40 360 46.7C480 53 600 47 720 43.3C840 40 960 40 1080 46.7C1200 53 1320 67 1380 73.3L1440 80V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0V0Z"
                    fill="white" />
            </svg>
        </div>
    </section>

    <!-- STATISTIK -->
    <section class="py-20 bg-white relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">

                <div class="text-center fade-in-up">
                    <div class="mb-4 inline-block p-4 bg-gradient-to-br from-green-100 to-green-200 rounded-2xl">
                        <i data-feather="users" class="text-green-800" style="width: 40px; height: 40px;"></i>
                    </div>
                    <h3
                        class="text-5xl font-black mb-2 bg-gradient-to-r from-green-800 to-green-600 bg-clip-text text-transparent stat-number">
                        40+
                    </h3>
                    <p class="text-gray-600 font-medium">Siswa Aktif</p>
                </div>

                <div class="text-center fade-in-up delay-100">
                    <div class="mb-4 inline-block p-4 bg-gradient-to-br from-teal-100 to-teal-200 rounded-2xl">
                        <i data-feather="layers" class="text-teal-700" style="width: 40px; height: 40px;"></i>
                    </div>
                    <h3
                        class="text-5xl font-black mb-2 bg-gradient-to-r from-teal-700 to-teal-600 bg-clip-text text-transparent stat-number delay-100">
                        12
                    </h3>
                    <p class="text-gray-600 font-medium">Level Program</p>
                </div>

                <div class="text-center fade-in-up delay-200">
                    <div class="mb-4 inline-block p-4 bg-gradient-to-br from-emerald-100 to-emerald-200 rounded-2xl">
                        <i data-feather="user-check" class="text-emerald-700" style="width: 40px; height: 40px;"></i>
                    </div>
                    <h3
                        class="text-5xl font-black mb-2 bg-gradient-to-r from-emerald-700 to-emerald-600 bg-clip-text text-transparent stat-number delay-200">
                        10+
                    </h3>
                    <p class="text-gray-600 font-medium">Guru Profesional</p>
                </div>

                <div class="text-center fade-in-up delay-300">
                    <div class="mb-4 inline-block p-4 bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-2xl">
                        <i data-feather="calendar" class="text-yellow-700" style="width: 40px; height: 40px;"></i>
                    </div>
                    <h3
                        class="text-5xl font-black mb-2 bg-gradient-to-r from-yellow-600 to-yellow-500 bg-clip-text text-transparent stat-number delay-300">
                        30+
                    </h3>
                    <p class="text-gray-600 font-medium">Level Modul</p>
                </div>

            </div>
        </div>
    </section>

    <!-- TENTANG -->
    <section id="tentang" class="py-24 bg-gradient-to-br from-green-50 to-yellow-50">
        <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-16 items-center">

            <div class="relative fade-in-up">
                <div
                    class="absolute -inset-8 bg-gradient-to-r from-green-200 to-yellow-200 rounded-3xl blur-3xl opacity-30">
                </div>
                <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=800"
                    class="relative rounded-3xl shadow-2xl" alt="Students Studying">
            </div>

            <div class="fade-in-up delay-200">
                <div class="inline-block bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                    Tentang Kami
                </div>

                <h2 class="text-4xl md:text-5xl font-black mb-6 leading-tight">
                    Belajar Bahasa Inggris dengan
                    <span class="bg-gradient-to-r from-green-800 to-green-600 bg-clip-text text-transparent">
                        Metode Terpadu
                    </span>
                </h2>

                <p class="text-gray-600 text-lg leading-relaxed mb-6">
                    New Concept English Course menghadirkan inovasi pembelajaran yang memadukan metode konvensional
                    dengan teknologi digital modern.
                </p>

                <p class="text-gray-600 text-lg leading-relaxed mb-8">
                    Kami memastikan setiap siswa mendapatkan pemantauan progress yang objektif, terstruktur, dan terukur
                    untuk hasil maksimal.
                </p>

                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-green-800 to-green-600 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i data-feather="check" class="text-white" style="width: 20px; height: 20px;"></i>
                        </div>
                        <span class="text-gray-700 font-medium">Sistem pembelajaran terstruktur & teruji</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-green-800 to-green-600 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i data-feather="check" class="text-white" style="width: 20px; height: 20px;"></i>
                        </div>
                        <span class="text-gray-700 font-medium">Monitoring digital real-time</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-green-800 to-green-600 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i data-feather="check" class="text-white" style="width: 20px; height: 20px;"></i>
                        </div>
                        <span class="text-gray-700 font-medium">Pengajar berpengalaman & tersertifikasi</span>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- PROGRAM / LEVEL -->
    <section id="program" class="py-24 bg-cream relative overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-green-200 rounded-full filter blur-3xl opacity-20"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-yellow-200 rounded-full filter blur-3xl opacity-20"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">

            <div class="text-center mb-16 fade-in-up">
                <div class="inline-block bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                    Program Kami
                </div>
                <h2 class="text-4xl md:text-5xl font-black mb-4">
                    Pilih <span
                        class="bg-gradient-to-r from-green-800 to-green-600 bg-clip-text text-transparent">Level</span>
                    Anda
                </h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                    Dari pemula hingga mahir, kami punya program yang tepat untuk Anda
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

                <div class="level-card rounded-2xl p-6 text-center shadow-lg card-hover fade-in-up">
                    <div class="mb-4">
                        <i data-feather="book-open" class="mx-auto text-green-700"
                            style="width: 48px; height: 48px;"></i>
                    </div>
                    <h4 class="font-bold text-lg mb-2">Starter</h4>
                    <p class="text-sm text-gray-600">Level pemula</p>
                </div>

                <div class="level-card rounded-2xl p-6 text-center shadow-lg card-hover fade-in-up delay-100">
                    <div class="mb-4">
                        <i data-feather="book" class="mx-auto text-green-700" style="width: 48px; height: 48px;"></i>
                    </div>
                    <h4 class="font-bold text-lg mb-2">Basic 1-3</h4>
                    <p class="text-sm text-gray-600">Dasar bahasa</p>
                </div>

                <div class="level-card rounded-2xl p-6 text-center shadow-lg card-hover fade-in-up delay-200">
                    <div class="mb-4">
                        <i data-feather="award" class="mx-auto text-green-700" style="width: 48px; height: 48px;"></i>
                    </div>
                    <h4 class="font-bold text-lg mb-2">Intermediate 1-3</h4>
                    <p class="text-sm text-gray-600">Tingkat menengah</p>
                </div>

                <div class="level-card rounded-2xl p-6 text-center shadow-lg card-hover fade-in-up delay-300">
                    <div class="mb-4">
                        <i data-feather="star" class="mx-auto text-green-700" style="width: 48px; height: 48px;"></i>
                    </div>
                    <h4 class="font-bold text-lg mb-2">Advanced 1-5</h4>
                    <p class="text-sm text-gray-600">Level mahir</p>
                </div>

            </div>

        </div>
    </section>

    <!-- KEUNGGULAN -->
    <section id="keunggulan"
        class="py-24 bg-gradient-to-br from-green-800 to-green-600 text-white relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-64 h-64 bg-yellow-400 rounded-full filter blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-96 h-96 bg-white rounded-full filter blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">

            <div class="text-center mb-16 fade-in-up">
                <div
                    class="inline-block bg-yellow-400/20 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-semibold mb-4 text-yellow-200">
                    Mengapa Kami?
                </div>
                <h2 class="text-4xl md:text-5xl font-black mb-4">
                    Keunggulan yang Membedakan Kami
                </h2>
                <p class="text-white/90 text-lg max-w-2xl mx-auto">
                    Komitmen kami adalah kesuksesan Anda dalam menguasai bahasa Inggris
                </p>
            </div>

            <div class="grid md:grid-cols-4 gap-8">

                <div class="bg-white/10 backdrop-blur-lg p-8 rounded-2xl border border-white/20 card-hover fade-in-up">
                    <div class="mb-6">
                        <i data-feather="award" class="text-yellow-300" style="width: 56px; height: 56px;"></i>
                    </div>
                    <h4 class="font-bold text-xl mb-3">Pengajar Profesional</h4>
                    <p class="text-white/80 leading-relaxed">
                        Tim pengajar tersertifikasi dengan pengalaman mengajar lebih dari 5 tahun
                    </p>
                </div>

                <div
                    class="bg-white/10 backdrop-blur-lg p-8 rounded-2xl border border-white/20 card-hover fade-in-up delay-100">
                    <div class="mb-6">
                        <i data-feather="monitor" class="text-green-200" style="width: 56px; height: 56px;"></i>
                    </div>
                    <h4 class="font-bold text-xl mb-3">Monitoring Digital</h4>
                    <p class="text-white/80 leading-relaxed">
                        Pantau progress belajar secara real-time melalui dashboard digital
                    </p>
                </div>

                <div
                    class="bg-white/10 backdrop-blur-lg p-8 rounded-2xl border border-white/20 card-hover fade-in-up delay-200">
                    <div class="mb-6">
                        <i data-feather="file-text" class="text-yellow-200" style="width: 56px; height: 56px;"></i>
                    </div>
                    <h4 class="font-bold text-xl mb-3">Rapor Online</h4>
                    <p class="text-white/80 leading-relaxed">
                        Evaluasi terstruktur dengan laporan kemajuan yang detail dan transparan
                    </p>
                </div>

                <div
                    class="bg-white/10 backdrop-blur-lg p-8 rounded-2xl border border-white/20 card-hover fade-in-up delay-300">
                    <div class="mb-6">
                        <i data-feather="play-circle" class="text-green-200" style="width: 56px; height: 56px;"></i>
                    </div>
                    <h4 class="font-bold text-xl mb-3">Trial Class</h4>
                    <p class="text-white/80 leading-relaxed">
                        Coba kelas gratis sebelum memutuskan untuk bergabung dengan kami
                    </p>
                </div>

            </div>

        </div>
    </section>

    <!-- ALUR PENDAFTARAN -->
    <section class="py-24 bg-gradient-to-br from-green-50 to-yellow-50">
        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-16 fade-in-up">
                <div class="inline-block bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                    Cara Bergabung
                </div>
                <h2 class="text-4xl md:text-5xl font-black mb-4">
                    Mudah & <span
                        class="bg-gradient-to-r from-green-800 to-green-600 bg-clip-text text-transparent">Cepat</span>
                </h2>
                <p class="text-gray-600 text-lg">Hanya 4 langkah untuk memulai perjalanan belajar Anda</p>
            </div>

            <div class="grid md:grid-cols-4 gap-8 relative">

                <!-- Connecting Line -->
                <div
                    class="hidden md:block absolute top-24 left-0 right-0 h-1 bg-gradient-to-r from-green-200 via-yellow-200 to-green-300 mx-24">
                </div>

                <div class="relative bg-white p-8 rounded-2xl shadow-lg card-hover fade-in-up text-center">
                    <div
                        class="absolute -top-6 left-1/2 transform -translate-x-1/2 w-12 h-12 bg-gradient-to-br from-green-700 to-green-600 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg">
                        1
                    </div>
                    <div class="mt-8 mb-4">
                        <i data-feather="edit" class="mx-auto text-green-700" style="width: 48px; height: 48px;"></i>
                    </div>
                    <h4 class="font-bold text-lg mb-2">Daftar Online</h4>
                    <p class="text-gray-600 text-sm">Isi formulir pendaftaran dengan data lengkap</p>
                </div>

                <div class="relative bg-white p-8 rounded-2xl shadow-lg card-hover fade-in-up delay-100 text-center">
                    <div
                        class="absolute -top-6 left-1/2 transform -translate-x-1/2 w-12 h-12 bg-gradient-to-br from-teal-700 to-teal-600 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg">
                        2
                    </div>
                    <div class="mt-8 mb-4">
                        <i data-feather="video" class="mx-auto text-teal-700" style="width: 48px; height: 48px;"></i>
                    </div>
                    <h4 class="font-bold text-lg mb-2">Trial Class</h4>
                    <p class="text-gray-600 text-sm">Ikuti kelas percobaan gratis untuk merasakan metode kami</p>
                </div>

                <div class="relative bg-white p-8 rounded-2xl shadow-lg card-hover fade-in-up delay-200 text-center">
                    <div
                        class="absolute -top-6 left-1/2 transform -translate-x-1/2 w-12 h-12 bg-gradient-to-br from-yellow-600 to-yellow-500 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg">
                        3
                    </div>
                    <div class="mt-8 mb-4">
                        <i data-feather="target" class="mx-auto text-yellow-600" style="width: 48px; height: 48px;"></i>
                    </div>
                    <h4 class="font-bold text-lg mb-2">Placement Test</h4>
                    <p class="text-gray-600 text-sm">Tes penempatan untuk menentukan level yang sesuai</p>
                </div>

                <div class="relative bg-white p-8 rounded-2xl shadow-lg card-hover fade-in-up delay-300 text-center">
                    <div
                        class="absolute -top-6 left-1/2 transform -translate-x-1/2 w-12 h-12 bg-gradient-to-br from-emerald-700 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold text-xl shadow-lg">
                        4
                    </div>
                    <div class="mt-8 mb-4">
                        <i data-feather="check-circle" class="mx-auto text-emerald-700"
                            style="width: 48px; height: 48px;"></i>
                    </div>
                    <h4 class="font-bold text-lg mb-2">Mulai Belajar</h4>
                    <p class="text-gray-600 text-sm">Bergabung dengan kelas dan mulai perjalanan Anda</p>
                </div>

            </div>

        </div>
    </section>

    <!-- TESTIMONI -->
    <section id="testimoni" class="py-24 bg-cream relative overflow-hidden">
        <div class="absolute top-0 left-0 w-96 h-96 bg-green-100 rounded-full filter blur-3xl opacity-50"></div>

        <div class="max-w-5xl mx-auto px-6 text-center relative z-10">

            <div class="mb-16 fade-in-up">
                <div class="inline-block bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                    Testimoni
                </div>
                <h2 class="text-4xl md:text-5xl font-black mb-4">
                    Apa Kata <span
                        class="bg-gradient-to-r from-green-800 to-green-600 bg-clip-text text-transparent">Mereka?</span>
                </h2>
                <p class="text-gray-600 text-lg">Dengarkan pengalaman siswa dan orang tua kami</p>
            </div>

            <div id="carousel" class="relative">

                <div class="carousel-item block">
                    <div class="testimonial-card max-w-3xl mx-auto">
                        <div class="mb-4">
                            <i data-feather="star" class="inline-block text-yellow-300"
                                style="width: 24px; height: 24px;"></i>
                            <i data-feather="star" class="inline-block text-yellow-300"
                                style="width: 24px; height: 24px;"></i>
                            <i data-feather="star" class="inline-block text-yellow-300"
                                style="width: 24px; height: 24px;"></i>
                            <i data-feather="star" class="inline-block text-yellow-300"
                                style="width: 24px; height: 24px;"></i>
                            <i data-feather="star" class="inline-block text-yellow-300"
                                style="width: 24px; height: 24px;"></i>
                        </div>
                        <p class="text-xl mb-6 leading-relaxed">
                            "Anak saya sangat berkembang pesat sejak bergabung. Sistem monitoring digitalnya memudahkan
                            saya memantau progress belajarnya setiap hari!"
                        </p>
                        <div class="flex items-center justify-center gap-3">
                            <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                                <i data-feather="user" style="width: 24px; height: 24px;"></i>
                            </div>
                            <div class="text-left">
                                <h4 class="font-bold">Ibu Sari</h4>
                                <p class="text-sm text-white/80">Orang Tua Siswa</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item hidden">
                    <div class="testimonial-card max-w-3xl mx-auto">
                        <div class="mb-4">
                            <i data-feather="star" class="inline-block text-yellow-300"
                                style="width: 24px; height: 24px;"></i>
                            <i data-feather="star" class="inline-block text-yellow-300"
                                style="width: 24px; height: 24px;"></i>
                            <i data-feather="star" class="inline-block text-yellow-300"
                                style="width: 24px; height: 24px;"></i>
                            <i data-feather="star" class="inline-block text-yellow-300"
                                style="width: 24px; height: 24px;"></i>
                            <i data-feather="star" class="inline-block text-yellow-300"
                                style="width: 24px; height: 24px;"></i>
                        </div>
                        <p class="text-xl mb-6 leading-relaxed">
                            "Sistemnya sangat rapi dan transparan. Saya bisa lihat rapor online dan update progress
                            langsung dari HP. Sangat recommended!"
                        </p>
                        <div class="flex items-center justify-center gap-3">
                            <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                                <i data-feather="user" style="width: 24px; height: 24px;"></i>
                            </div>
                            <div class="text-left">
                                <h4 class="font-bold">Bapak Andi</h4>
                                <p class="text-sm text-white/80">Wali Murid</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="carousel-item hidden">
                    <div class="testimonial-card max-w-3xl mx-auto">
                        <div class="mb-4">
                            <i data-feather="star" class="inline-block text-yellow-300"
                                style="width: 24px; height: 24px;"></i>
                            <i data-feather="star" class="inline-block text-yellow-300"
                                style="width: 24px; height: 24px;"></i>
                            <i data-feather="star" class="inline-block text-yellow-300"
                                style="width: 24px; height: 24px;"></i>
                            <i data-feather="star" class="inline-block text-yellow-300"
                                style="width: 24px; height: 24px;"></i>
                            <i data-feather="star" class="inline-block text-yellow-300"
                                style="width: 24px; height: 24px;"></i>
                        </div>
                        <p class="text-xl mb-6 leading-relaxed">
                            "Belajar jadi lebih terarah dan fun! Gurunya sabar dan materinya mudah dipahami. Nilai
                            bahasa Inggris saya di sekolah naik drastis!"
                        </p>
                        <div class="flex items-center justify-center gap-3">
                            <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                                <i data-feather="user" style="width: 24px; height: 24px;"></i>
                            </div>
                            <div class="text-left">
                                <h4 class="font-bold">Dina</h4>
                                <p class="text-sm text-white/80">Siswa Level Advanced</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Carousel Dots -->
            <div class="carousel-dots">
                <div class="dot active" data-index="0"></div>
                <div class="dot" data-index="1"></div>
                <div class="dot" data-index="2"></div>
            </div>

        </div>
    </section>

    <!-- CTA -->
    <section
        class="py-32 bg-gradient-to-br from-green-800 via-green-700 to-green-600 text-white relative overflow-hidden">
        <!-- Animated Background -->
        <div class="absolute inset-0">
            <div class="absolute top-20 left-20 w-72 h-72 bg-yellow-400/20 rounded-full filter blur-3xl animate-pulse">
            </div>
            <div class="absolute bottom-20 right-20 w-96 h-96 bg-white/10 rounded-full filter blur-3xl animate-pulse"
                style="animation-delay: 1s;"></div>
        </div>

        <div class="max-w-4xl mx-auto px-6 text-center relative z-10">

            <div class="fade-in-up">
                <div
                    class="inline-block bg-yellow-400/90 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-semibold mb-6 text-green-900">
                    🎉 Promo Terbatas!
                </div>

                <h2 class="text-4xl md:text-6xl font-black mb-6 leading-tight">
                    Siap Meningkatkan<br>Kemampuan Bahasa Inggris?
                </h2>

                <p class="mb-10 text-xl opacity-90 leading-relaxed max-w-2xl mx-auto">
                    Bergabunglah dengan ribuan siswa yang telah merasakan transformasi pembelajaran bersama kami
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('ppdb.create') }}"
                        class="btn-glow bg-yellow-400 text-green-900 font-bold px-12 py-5 rounded-full shadow-2xl text-lg inline-block hover:bg-yellow-300">
                        Daftar Sekarang - GRATIS Trial!
                    </a>
                    <a href="#tentang"
                        class="border-2 border-white text-white font-semibold px-12 py-5 rounded-full hover:bg-white hover:text-green-800 transition text-lg inline-block">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>

        </div>
    </section>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-gray-300 py-16">
        <div class="max-w-7xl mx-auto px-6">

            <div class="grid md:grid-cols-4 gap-12 mb-12">

                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-green-800 to-green-600 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-xl">NC</span>
                        </div>
                        <span class="font-bold text-white text-xl">New Concept</span>
                    </div>
                    <p class="text-sm text-gray-400 leading-relaxed">
                        Kursus Bahasa Inggris dengan Sistem Monitoring Digital Terpadu
                    </p>
                </div>

                <div>
                    <h4 class="font-bold text-white mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#tentang" class="hover:text-green-400 transition">Tentang Kami</a></li>
                        <li><a href="#program" class="hover:text-green-400 transition">Program</a></li>
                        <li><a href="#keunggulan" class="hover:text-green-400 transition">Keunggulan</a></li>
                        <li><a href="#testimoni" class="hover:text-green-400 transition">Testimoni</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-white mb-4">Kontak</h4>
                    <ul class="space-y-2 text-sm">
                        <li class="flex items-center gap-2">
                            <i data-feather="mail" style="width: 16px; height: 16px;"></i>
                            <span>newconceptpusat@gmail.com</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-feather="phone" style="width: 16px; height: 16px;"></i>
                            <span>081311251469</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-feather="map-pin" style="width: 16px; height: 16px;"></i>
                            <span>Jalan Kyai Telingsing No. 41, Kudus</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-white mb-4">Follow Us</h4>
                    <div class="flex gap-3">
                        <a href="https://www.facebook.com/newconcept.kudus/"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-green-600 transition">
                            <i data-feather="facebook" style="width: 18px; height: 18px;"></i>
                        </a>
                        <a href="https://www.instagram.com/newconcept.kudus?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-green-600 transition">
                            <i data-feather="instagram" style="width: 18px; height: 18px;"></i>
                        </a>
                        <a href="https://www.youtube.com/@nc-eec"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-green-600 transition">
                            <i data-feather="youtube" style="width: 18px; height: 18px;"></i>
                        </a>
                    </div>
                    <div class="mt-6">
                        <a href="{{ route('login') }}"
                            class="text-sm text-green-400 hover:text-green-300 transition font-semibold">
                            Login Portal →
                        </a>
                    </div>
                </div>

            </div>

            <div class="border-t border-gray-800 pt-8 text-center">
                <p class="text-sm text-gray-500">
                    © {{ date('Y') }} New Concept English Course. All rights reserved.
                </p>
            </div>

        </div>
    </footer>

    <script>
        // Initialize Feather Icons
        feather.replace();

        // Navbar Scroll Effect
        window.addEventListener('scroll', function () {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Carousel Functionality
        const items = document.querySelectorAll('.carousel-item');
        const dots = document.querySelectorAll('.dot');
        let currentIndex = 0;

        function showSlide(index) {
            items.forEach(item => {
                item.classList.remove('block');
                item.classList.add('hidden');
            });
            dots.forEach(dot => dot.classList.remove('active'));

            items[index].classList.remove('hidden');
            items[index].classList.add('block');
            dots[index].classList.add('active');

            // Re-initialize feather icons for the visible slide
            feather.replace();
        }

        // Auto-rotate carousel
        setInterval(() => {
            currentIndex = (currentIndex + 1) % items.length;
            showSlide(currentIndex);
        }, 5000);

        // Dot click handlers
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentIndex = index;
                showSlide(currentIndex);
            });
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Intersection Observer for fade-in animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in-up').forEach(el => {
            observer.observe(el);
        });
    </script>

</body>

</html>