<x-layout>

    <head>
        <link rel="stylesheet" href="/css/home.css">
        <title>Home</title>
    </head>
    <!-- Main Content -->

    <body>
        <!-- Main Container -->
        <div class="container">
            <!-- Welcome Section -->
            <section class="welcome-section">
                <h1>Selamat Datang, {{ auth()->user()->name ?? 'Guest' }}!</h1>
                <p>Temukan pekerjaan impian Anda atau pantau lamaran Anda.</p>
            </section>

            <!-- Quick Actions -->
            <section class="quick-actions">
                <div class="action-card">
                    <i class="fas fa-search"></i>
                    <h3>Cari Pekerjaan</h3>
                    <p>Telusuri posisi yang tersedia.</p>
                    <a href="findjobs" class="btn">Cari Sekarang</a>
                </div>
                <div class="action-card">
                    <i class="fas fa-calendar-check"></i>
                    <h3>Event Terkini</h3>
                    <p>Ikuti acara dan seminar karier.</p>
                    <a href="events" class="btn">Lihat Event</a>
                </div>
                <div class="action-card">
                    <i class="fas fa-user-edit"></i>
                    <h3>Perbarui Profil</h3>
                    <p>Pastikan profil Anda selalu up-to-date.</p>
                    <a href="userprofile" class="btn">Edit Profil</a>
                </div>
            </section>
        </div>

        <script>
            // DOM Elements
            const actionCards = document.querySelectorAll('.action-card');
            const jobCards = document.querySelectorAll('.job-card');
            const scrollToTopButton = document.createElement('button');

            // Fungsi animasi hover untuk action card
            actionCards.forEach(card => {
                card.addEventListener('mouseover', () => {
                    card.style.transform = 'scale(1.05)';
                    card.style.boxShadow = '0 10px 20px rgba(0, 0, 0, 0.2)';
                });

                card.addEventListener('mouseout', () => {
                    card.style.transform = 'scale(1)';
                    card.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
                });
            });

            // Fungsi animasi hover untuk job card
            jobCards.forEach(card => {
                card.addEventListener('mouseover', () => {
                    card.style.transform = 'scale(1.03)';
                    card.style.boxShadow = '0 8px 16px rgba(0, 0, 0, 0.15)';
                });

                card.addEventListener('mouseout', () => {
                    card.style.transform = 'scale(1)';
                    card.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
                });
            });

            // Tombol Scroll ke Atas
            scrollToTopButton.textContent = '⬆️';
            scrollToTopButton.classList.add('scroll-to-top');
            document.body.appendChild(scrollToTopButton);

            // Tampilkan tombol ketika scroll lebih dari 500px
            window.addEventListener('scroll', () => {
                if (window.scrollY > 500) {
                    scrollToTopButton.style.display = 'block';
                } else {
                    scrollToTopButton.style.display = 'none';
                }
            });

            // Scroll ke atas saat tombol diklik
            scrollToTopButton.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });

            // Tambahkan gaya untuk tombol Scroll ke Atas
            const style = document.createElement('style');
            style.innerHTML = `
    .scroll-to-top {
        position: fixed;
        bottom: 20px;
        right: 20px;
        padding: 10px 15px;
        font-size: 16px;
        background-color: #4f46e5;
        color: #fff;
        border: none;
        border-radius: 50%;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        display: none;
        transition: all 0.3s ease;
    }

    .scroll-to-top:hover {
        background-color: #3730a3;
        transform: translateY(-3px);
    }
`;
            document.head.appendChild(style);

            // Efek bouncing pada ikon action card
            const bounceIcons = document.querySelectorAll('.action-card i');
            bounceIcons.forEach(icon => {
                let animationInterval = setInterval(() => {
                    icon.style.transform = 'translateY(-5px)';
                    setTimeout(() => {
                        icon.style.transform = 'translateY(0)';
                    }, 500);
                }, 1500);
            });
        </script>
    </body>
    </body>

    </html>
</x-layout>
