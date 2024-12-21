<x-layout>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Portal Alumni & Karier</title>
        <!-- Tailwind CSS -->
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/jobs.css">
        </head>

    <body>
        <!-- Background Image -->
        <div class="background-image"></div>

        <!-- Bagian Lowongan Pekerjaan -->
        <section class="jobs">
            <div class="container">
                <!-- Judul Utama -->
                <h2 class="section__title">Daftar Lowongan Pekerjaan Tersedia</h2>
                <p class="section__subtitle">
                    Temukan peluang kerja terbaik sesuai dengan keterampilan dan minat Anda.
                </p>

                <!-- Grid Lowongan Pekerjaan -->
                <div class="jobs__grid">
                    <!-- Kartu Pekerjaan 1 -->
                    <div class="job-card">
                        <img src="assets/images/placeholder.svg" alt="Gambar Pekerjaan" class="job-card__image">
                        <h3 class="job-card__title">Software Engineer</h3>
                        <p class="job-card__company">Perusahaan Teknologi A</p>
                        <p class="job-card__location">Jakarta, Indonesia</p>
                    </div>
                    <!-- Kartu Pekerjaan 2 -->
                    <div class="job-card">
                        <img src="assets/images/placeholder.svg" alt="Gambar Pekerjaan" class="job-card__image">
                        <h3 class="job-card__title">Manajer Produk</h3>
                        <p class="job-card__company">Perusahaan Teknologi B</p>
                        <p class="job-card__location">Bandung, Indonesia</p>
                    </div>
                    <!-- Kartu Pekerjaan 3 -->
                    <div class="job-card">
                        <img src="assets/images/placeholder.svg" alt="Gambar Pekerjaan" class="job-card__image">
                        <h3 class="job-card__title">Desainer UX</h3>
                        <p class="job-card__company">Studio Desain C</p>
                        <p class="job-card__location">Yogyakarta, Indonesia</p>
                    </div>
                    <!-- Kartu Pekerjaan 4 -->
                    <div class="job-card">
                        <img src="assets/images/placeholder.svg" alt="Gambar Pekerjaan" class="job-card__image">
                        <h3 class="job-card__title">Manajer Pemasaran</h3>
                        <p class="job-card__company">Agensi D</p>
                        <p class="job-card__location">Surabaya, Indonesia</p>
                    </div>
                    <!-- Kartu Pekerjaan Tambahan -->
                    <div class="job-card">
                        <img src="assets/images/placeholder.svg" alt="Gambar Pekerjaan" class="job-card__image">
                        <h3 class="job-card__title">Analis Data</h3>
                        <p class="job-card__company">Bank XYZ</p>
                        <p class="job-card__location">Medan, Indonesia</p>
                    </div>
                    <div class="job-card">
                        <img src="assets/images/placeholder.svg" alt="Gambar Pekerjaan" class="job-card__image">
                        <h3 class="job-card__title">Administrasi</h3>
                        <p class="job-card__company">PT. Maju Terus</p>
                        <p class="job-card__location">Bali, Indonesia</p>
                    </div>
                    <div class="job-card">
                        <img src="assets/images/placeholder.svg" alt="Gambar Pekerjaan" class="job-card__image">
                        <h3 class="job-card__title">Teknisi IT</h3>
                        <p class="job-card__company">Kantor Pemerintah</p>
                        <p class="job-card__location">Malang, Indonesia</p>
                    </div>
                    <div class="job-card">
                        <img src="assets/images/placeholder.svg" alt="Gambar Pekerjaan" class="job-card__image">
                        <h3 class="job-card__title">Akuntan</h3>
                        <p class="job-card__company">Firma Akuntansi</p>
                        <p class="job-card__location">Semarang, Indonesia</p>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="jobs__actions">
                    <button class="button button--secondary">Muat Lebih Banyak Lowongan</button>
                </div>
            </div>
        </section>

        <script>
            // DOM Elements
            const jobCards = document.querySelectorAll('.job-card');
            const loadMoreButton = document.querySelector('.button--secondary');
            const jobsGrid = document.querySelector('.jobs__grid');

            // Fungsi animasi hover untuk job card
            jobCards.forEach(card => {
                card.addEventListener('mouseover', () => {
                    card.style.transform = 'scale(1.05)';
                    card.style.boxShadow = '0 10px 20px rgba(0, 0, 0, 0.2)';
                });

                card.addEventListener('mouseout', () => {
                    card.style.transform = 'scale(1)';
                    card.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
                });
            });

            // Fungsi untuk memuat lebih banyak lowongan pekerjaan
            loadMoreButton.addEventListener('click', () => {
                // Simulasi data baru yang dimuat (Data bisa dari API)
                const newJobs = [{
                        title: 'Desainer Grafis',
                        company: 'Creative Studio Z',
                        location: 'Bali, Indonesia',
                        image: 'assets/images/placeholder.svg'
                    },
                    {
                        title: 'IT Support',
                        company: 'Tech Support Indonesia',
                        location: 'Jakarta, Indonesia',
                        image: 'assets/images/placeholder.svg'
                    },
                    {
                        title: 'Manajer Keuangan',
                        company: 'Perusahaan Finansial',
                        location: 'Makassar, Indonesia',
                        image: 'assets/images/placeholder.svg'
                    },
                    {
                        title: 'Spesialis SEO',
                        company: 'Agensi Digital E',
                        location: 'Surabaya, Indonesia',
                        image: 'assets/images/placeholder.svg'
                    }
                ];

                // Loop untuk menambahkan data ke dalam grid
                newJobs.forEach(job => {
                    const jobCard = document.createElement('div');
                    jobCard.classList.add('job-card');
                    jobCard.innerHTML = `
            <img src="${job.image}" alt="Gambar Pekerjaan" class="job-card__image">
            <h3 class="job-card__title">${job.title}</h3>
            <p class="job-card__company">${job.company}</p>
            <p class="job-card__location">${job.location}</p>
        `;

                    // Tambahkan efek hover pada kartu lowongan yang baru dimuat
                    jobCard.addEventListener('mouseover', () => {
                        jobCard.style.transform = 'scale(1.05)';
                        jobCard.style.boxShadow = '0 10px 20px rgba(0, 0, 0, 0.2)';
                    });

                    jobCard.addEventListener('mouseout', () => {
                        jobCard.style.transform = 'scale(1)';
                        jobCard.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
                    });

                    jobsGrid.appendChild(jobCard);
                });
            });

            // Fungsi pencarian pekerjaan berdasarkan nama perusahaan atau lokasi
            const searchInput = document.querySelector('.search-bar input');
            searchInput.addEventListener('input', function() {
                const searchValue = searchInput.value.toLowerCase();

                jobCards.forEach(card => {
                    const title = card.querySelector('.job-card__title').textContent.toLowerCase();
                    const company = card.querySelector('.job-card__company').textContent.toLowerCase();
                    const location = card.querySelector('.job-card__location').textContent.toLowerCase();

                    if (title.includes(searchValue) || company.includes(searchValue) || location.includes(
                            searchValue)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });

            // Fungsi scroll smooth ke bagian job yang baru dimuat
            loadMoreButton.addEventListener('click', () => {
                setTimeout(() => {
                    const lastJobCard = jobsGrid.lastElementChild;
                    lastJobCard.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }, 500);
            });
        </script>
    </body>

</x-layout>
