<!DOCTYPE html>
<html lang="en">

<x-layout class="w-full">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @vite('resources/css/app.css')
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
        <link rel="stylesheet" href="css/about.css">
        <title>Document</title>
    </head>


    <body>
        <!-- Bagian Tentang -->
        <section class="about-section">
            <!-- Background Image -->
            <div class="background-image"></div>

            <!-- Konten Utama -->
            <div class="about-content container">
                <h1 class="title">Tentang Portal Alumni & Karier</h1>
                <p class="description">
                    Portal Alumni & Karier dirancang untuk menghubungkan alumni, mahasiswa, dan profesional.
                    Platform ini berfungsi sebagai jembatan untuk peluang karier, jaringan profesional, dan berbagi
                    sumber daya.
                    Baik Anda lulusan baru yang mencari pekerjaan pertama atau profesional berpengalaman yang ingin
                    membimbing orang lain,
                    Portal Alumni & Karier memberi Anda alat dan koneksi yang tepat untuk meraih kesuksesan.
                </p>

                <!-- Fitur Utama -->
                <div class="key-features">
                    <div class="feature">
                        <h3>Peluang Kerja</h3>
                        <p>Akses daftar pekerjaan dan magang eksklusif untuk alumni dan mahasiswa.</p>
                    </div>
                    <div class="feature">
                        <h3>Terhaubung dengan Alumni</h3>
                        <p>Hubungkan kembali dengan rekan seangkatan dan perluas jaringan profesional Anda.</p>
                    </div>
                    <div class="feature">
                        <h3>Resource Karier</h3>
                        <p>Akses panduan, alat, dan sumber daya untuk menavigasi perjalanan karier Anda.</p>
                    </div>
                    <div class="feature">
                        <h3>Bimbingan</h3>
                        <p>Cari bimbingan dari alumni berpengalaman atau tawarkan bimbingan kepada generasi berikutnya.
                        </p>
                    </div>
                </div>
            </div>
        </section>


        <!-- Tambahkan file JavaScript -->
        <script>
            // DOM Elements
            const features = document.querySelectorAll('.feature');
            const aboutTitle = document.querySelector('.title');
            const aboutDescription = document.querySelector('.description');

            // Scroll Animation: Memunculkan animasi ketika elemen muncul di viewport
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-in');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            // Tambahkan pengamatan ke elemen-elemen berikut
            observer.observe(aboutTitle);
            observer.observe(aboutDescription);
            features.forEach(feature => observer.observe(feature));

            // Efek Hover pada Fitur Utama
            features.forEach(feature => {
                feature.addEventListener('mouseover', () => {
                    feature.style.transform =
                    'scale(1.05) translateY(-5px)'; // Membesarkan ukuran kartu dan mengangkatnya ke atas
                });

                feature.addEventListener('mouseout', () => {
                    feature.style.transform = 'scale(1)'; // Mengembalikan ukuran semula
                });
            });

            // Animasi teks berjalan
            const texts = [
                'Jelajahi Peluang Karier',
                'Terhubung dengan Alumni',
                'Temukan Mentor Profesional',
                'Akses Resource Karier Eksklusif'
            ];

            let currentTextIndex = 0;

            function rotateText() {
                const titleElement = document.querySelector('.title');
                if (titleElement) {
                    titleElement.classList.remove('fade-in'); // Menghapus animasi sebelumnya
                    void titleElement.offsetWidth; // Memaksa reflow (memperbarui DOM)
                    titleElement.classList.add('fade-in'); // Menambahkan animasi fade-in
                    titleElement.textContent = texts[currentTextIndex]; // Ubah teks title
                }
                currentTextIndex = (currentTextIndex + 1) % texts.length; // Loop ke teks berikutnya
            }

            setInterval(rotateText, 4000); // Ganti teks setiap 4 detik

            // Scroll to top saat halaman di-refresh
            window.addEventListener('load', () => {
                window.scrollTo(0, 0);
            });
        </script>
    </body>
</x-layout>


</html>
