<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Stockify</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
        
        * {
            font-family: 'Poppins', sans-serif;
        }

        /* Enhanced animations */
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-50px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.8); }
            to { opacity: 1; transform: scale(1); }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .animate-fade-in-down {
            animation: fadeInDown 1s ease-out forwards;
        }

        .animate-fade-in-up {
            animation: fadeInUp 1s ease-out forwards;
            animation-delay: 0.3s;
        }

        .animate-fade-in {
            animation: fadeIn 1s ease-out forwards;
            animation-delay: 0.6s;
        }

        .animate-slide-in-left {
            animation: slideInLeft 1s ease-out forwards;
            animation-delay: 0.8s;
        }

        .animate-slide-in-right {
            animation: slideInRight 1s ease-out forwards;
            animation-delay: 0.8s;
        }

        .animate-scale-in {
            animation: scaleIn 1s ease-out forwards;
            animation-delay: 1s;
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .animate-pulse-custom {
            animation: pulse 2s ease-in-out infinite;
        }

        /* Custom gradient backgrounds */
        .bg-gradient-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .bg-gradient-card {
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
        }

        /* Glass morphism effect */
        .glass {
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.2);
        }

        /* Floating elements */
        .floating-element {
            position: absolute;
            opacity: 0.1;
            animation: float 4s ease-in-out infinite;
        }

        .floating-element:nth-child(even) {
            animation-delay: 2s;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.1);
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(255,255,255,0.5);
        }
    </style>
</head>
<body class="overflow-x-hidden">
    <div class="min-h-screen relative bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-900">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="floating-element top-20 left-20">
                <i class="fas fa-box text-white text-6xl"></i>
            </div>
            <div class="floating-element top-40 right-32">
                <i class="fas fa-chart-line text-white text-4xl"></i>
            </div>
            <div class="floating-element bottom-40 left-16">
                <i class="fas fa-warehouse text-white text-5xl"></i>
            </div>
            <div class="floating-element bottom-20 right-20">
                <i class="fas fa-truck text-white text-4xl"></i>
            </div>
            <div class="floating-element top-60 left-1/2">
                <i class="fas fa-tags text-white text-3xl"></i>
            </div>
        </div>

        <!-- Main Content -->
        <div class="relative z-10 min-h-screen flex flex-col items-center justify-center text-white text-center px-6">
            <!-- Hero Section -->
            <div class="max-w-4xl mx-auto">
                <!-- Logo/Brand -->
                <div class="animate-fade-in-down mb-8">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full shadow-2xl mb-4 animate-pulse-custom">
                        <i class="fas fa-cube text-white text-3xl"></i>
                    </div>
                </div>

                <!-- Main Title -->
                <h1 class="text-5xl md:text-7xl font-extrabold mb-6 animate-fade-in-down">
                    <span class="bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">
                        Selamat Datang di
                    </span>
                    <br>
                    <span class="text-white drop-shadow-2xl">Stockify</span>
                </h1>

                <!-- Subtitle -->
                <p class="text-xl md:text-2xl mb-8 animate-fade-in-up text-gray-200 max-w-2xl mx-auto leading-relaxed">
                    Kelola stok barangmu dengan mudah dan cepat. 
                    <span class="text-blue-300">Solusi inventory management</span> 
                    terdepan untuk bisnis modern.
                </p>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row justify-center gap-4 animate-fade-in mb-12">
                   <!-- Tombol Login -->
                    <a href="{{ route('login') }}"
                        class="group bg-white text-indigo-600 font-semibold px-8 py-4 rounded-full shadow-2xl hover:shadow-white/25 transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-white focus:ring-offset-2 focus:ring-offset-indigo-600 relative overflow-hidden">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            <i class="fas fa-sign-in-alt"></i>
                            Login
                        </span>
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-blue-500 to-purple-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        </div>
                    </a>
                    
                    <!-- Tombol Register -->
                    <a href="{{ route('register') }}"
                        class="group bg-transparent border-2 border-white text-white font-semibold px-8 py-4 rounded-full shadow-2xl hover:bg-white hover:text-indigo-600 transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-white focus:ring-offset-2 focus:ring-offset-indigo-600 relative overflow-hidden">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            <i class="fas fa-user-plus"></i>
                            Register
                        </span>
                    </a>
                </div>
            </div>

            <!-- Features Section -->
            <div class="animate-scale-in mt-16 max-w-6xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="animate-slide-in-left glass bg-gradient-card rounded-2xl p-6 shadow-2xl hover:shadow-white/10 transition-all duration-300 hover:-translate-y-2 group">
                        <div class="bg-gradient-to-r from-blue-500 to-cyan-500 w-16 h-16 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-chart-bar text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Real-time Analytics</h3>
                        <p class="text-gray-300">Monitor stok dan performa bisnis secara real-time dengan dashboard yang interaktif.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="animate-scale-in glass bg-gradient-card rounded-2xl p-6 shadow-2xl hover:shadow-white/10 transition-all duration-300 hover:-translate-y-2 group">
                        <div class="bg-gradient-to-r from-purple-500 to-pink-500 w-16 h-16 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-shield-alt text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Keamanan Terjamin</h3>
                        <p class="text-gray-300">Data bisnis Anda aman dengan enkripsi tingkat enterprise dan backup otomatis.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="animate-slide-in-right glass bg-gradient-card rounded-2xl p-6 shadow-2xl hover:shadow-white/10 transition-all duration-300 hover:-translate-y-2 group">
                        <div class="bg-gradient-to-r from-green-500 to-teal-500 w-16 h-16 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                            <i class="fas fa-mobile-alt text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Mobile Friendly</h3>
                        <p class="text-gray-300">Akses dari mana saja dengan interface yang responsif dan mudah digunakan.</p>
                    </div>
                </div>
            </div>

            <!-- Statistics Section -->
            <div class="animate-fade-in mt-16 max-w-4xl mx-auto">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div class="text-center group">
                        <div class="text-3xl md:text-4xl font-bold text-blue-400 mb-2 group-hover:scale-110 transition-transform duration-300">1000+</div>
                        <div class="text-gray-300">Pengguna Aktif</div>
                    </div>
                    <div class="text-center group">
                        <div class="text-3xl md:text-4xl font-bold text-purple-400 mb-2 group-hover:scale-110 transition-transform duration-300">50K+</div>
                        <div class="text-gray-300">Produk Dikelola</div>
                    </div>
                    <div class="text-center group">
                        <div class="text-3xl md:text-4xl font-bold text-pink-400 mb-2 group-hover:scale-110 transition-transform duration-300">99.9%</div>
                        <div class="text-gray-300">Uptime Server</div>
                    </div>
                    <div class="text-center group">
                        <div class="text-3xl md:text-4xl font-bold text-green-400 mb-2 group-hover:scale-110 transition-transform duration-300">24/7</div>
                        <div class="text-gray-300">Support</div>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="animate-fade-in-up mt-16 text-center">
                <p class="text-gray-300 mb-4">Siap untuk memulai perjalanan inventory management yang lebih baik?</p>
                <a href="#" onclick="alert('Get Started functionality')"
                   class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-semibold px-8 py-3 rounded-full shadow-2xl transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 focus:outline-none focus:ring-4 focus:ring-blue-300">
                    <span>Mulai Sekarang</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="relative z-10 text-center py-8 border-t border-white/10">
            <p class="text-gray-400">© 2025 Stockify. All rights reserved.</p>
        </div>
    </div>

    <script>
        // Add some interactive elements
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scrolling for any anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Add parallax effect to floating elements
            window.addEventListener('scroll', function() {
                const scrolled = window.pageYOffset;
                const parallax = document.querySelectorAll('.floating-element');
                const speed = 0.5;

                parallax.forEach(element => {
                    const yPos = -(scrolled * speed);
                    element.style.transform = `translateY(${yPos}px)`;
                });
            });

            // Add mouse move effect for enhanced interactivity
            document.addEventListener('mousemove', function(e) {
                const mouseX = e.clientX / window.innerWidth;
                const mouseY = e.clientY / window.innerHeight;
                
                const elements = document.querySelectorAll('.floating-element');
                elements.forEach((element, index) => {
                    const speed = (index + 1) * 10;
                    const x = (mouseX - 0.5) * speed;
                    const y = (mouseY - 0.5) * speed;
                    
                    element.style.transform += ` translate(${x}px, ${y}px)`;
                });
            });
        });
    </script>
</body>
</html>