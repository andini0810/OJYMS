<!DOCTYPE html>
<html lang="id">

<x-layout class="w-full">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Portal Alumni & Karier</title>
        <!-- Tailwind CSS -->
        <link rel="stylesheet" href="/output.css">
        <link rel="stylesheet" href="css/overview.css">
    </head>

    <body class="relative">
        <div class="horizontal-scroll-container">
            <!-- Background Image Fullscreen -->
            <div class="full-width-section">
                <div class="background-image">
                    <div class="overlay"></div>
                    <div class="content">
                        <h1 class="main-title">Portal Alumni & Karier</h1>

                        <!-- Teks Bergerak -->
                        <div class="rotating-text-container">
                            <span class="rotating-text"></span>
                        </div>

                        <div class="btn-group">
                            <a href="register" class="btn-primary">Daftar Sekarang</a>
                            <a href="about" class="btn-secondary">Pelajari Lebih Lanjut</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bagian Fitur-Fitur -->
            <div class="full-width-section">
                <section class="features py-16 bg-gray-50">
                    <div class="container mx-auto px-6">
                        <h2 class="section__title text-3xl font-semibold text-gray-800 mb-8 text-center">Fitur-Fitur
                            Utama</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <div class="feature-card">
                                <h3 class="feature-title">Jaringan Alumni</h3>
                                <p>Hubungkan dengan alumni dari seluruh dunia dan perluas jaringan profesional Anda.</p>
                            </div>
                            <div class="feature-card">
                                <h3 class="feature-title">Peluang Karier</h3>
                                <p>Akses peluang pekerjaan terbaru dari mitra perusahaan terkemuka.</p>
                            </div>
                            <div class="feature-card">
                                <h3 class="feature-title">Mentorship</h3>
                                <p>Dapatkan bimbingan dari mentor yang berpengalaman di bidang Anda.</p>
                            </div>
                            <div class="feature-card">
                                <h3 class="feature-title">Pusat Sumber Daya</h3>
                                <p>Akses sumber daya, panduan, dan materi pembelajaran gratis.</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Bagian Peluang Karier -->
            <div class="full-width-section">
                <section class="jobs py-16 bg-white">
                    <div class="container mx-auto px-6">
                        <h2 class="section__title text-3xl font-semibold text-gray-800 mb-8 text-center">Peluang Karier
                            Terkini</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <div class="job-card">
                                <h3>Software Engineer</h3>
                                <p>PT Teknologi Masa Depan</p>
                            </div>
                            <div class="job-card">
                                <h3>Product Manager</h3>
                                <p>PT Inovasi Kreatif</p>
                            </div>
                            <div class="job-card">
                                <h3>UX Designer</h3>
                                <p>Studio Desain Kreatif</p>
                            </div>
                            <div class="job-card">
                                <h3>Marketing Manager</h3>
                                <p>Agensi Pemasaran Global</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <div class="nav-dots"></div>

        <script>
            const rotatingText = document.querySelector('.rotating-text');
            const messages = [
                'Bangun karier Anda bersama alumni terbaik.',
                'Jaringan global yang membuka banyak peluang.',
                'Peluang karier dari perusahaan ternama.',
                'Kesuksesan dimulai dari sini!'
            ];

            let messageIndex = 0;

            function changeMessage() {
                rotatingText.classList.remove('fade-in');
                setTimeout(() => {
                    rotatingText.textContent = messages[messageIndex];
                    rotatingText.classList.add('fade-in');
                    messageIndex = (messageIndex + 1) % messages.length;
                }, 500);
            }

            setInterval(changeMessage, 4000);
            changeMessage();

            document.addEventListener('DOMContentLoaded', function() {
                const container = document.body;
                const sections = document.querySelectorAll('.full-width-section');
                const navDots = document.querySelector('.nav-dots');

                // Create navigation dots
                sections.forEach((_, index) => {
                    const dot = document.createElement('div');
                    dot.className = 'nav-dot';
                    dot.addEventListener('click', () => scrollToSection(index));
                    navDots.appendChild(dot);
                });

                function updateActiveDot() {
                    const scrollPosition = window.innerWidth > 1024 ? container.scrollLeft : window.scrollY;
                    const activeIndex = Math.round(scrollPosition / window.innerWidth);
                    document.querySelectorAll('.nav-dot').forEach((dot, index) => {
                        dot.classList.toggle('active', index === activeIndex);
                    });
                }

                function scrollToSection(index) {
                    const targetPosition = index * window.innerWidth;
                    if (window.innerWidth > 1024) {
                        container.scrollTo({
                            left: targetPosition,
                            behavior: 'smooth'
                        });
                    } else {
                        window.scrollTo({
                            top: targetPosition,
                            behavior: 'smooth'
                        });
                    }
                }

                // Horizontal smooth scrolling for desktop
                if (window.innerWidth > 1024) {
                    container.addEventListener('wheel', (e) => {
                        e.preventDefault();
                        container.scrollLeft += e.deltaY;
                        updateActiveDot();
                    });
                }

                // Update active dot on scroll
                container.addEventListener('scroll', updateActiveDot);
                window.addEventListener('scroll', updateActiveDot);

                // Initial update
                updateActiveDot();
            });
        </script>

        <script src="overview.js"></script>
    </body>


</x-layout>



</html>
